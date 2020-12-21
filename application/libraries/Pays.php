<?php

class Pays
{

    const AFFILIATION_PRICE = 1000;
    const PURCHASE_PRICE = 150;

    function __construct()
    {
        $this->ci = &get_instance();

        $this->ci->load->model('user_model', 'user');
        $this->ci->load->model('empresa_model', 'emp');
        $this->ci->load->model("notification_model", "not");
        $this->ci->load->model("transaction_model", "trans");
        $this->ci->load->model("wallet_model", "wallet");
    }


    //Pagar de una empresa al usuario
    function pay_to_user($user_id, $amount, $message)
    {
        $user = $this->ci->user->get_by_id($user_id);
        if (!$user) {
            return;
        }

        $empresa = $this->ci->emp->get_by_id(1);
        $empresa->billetera -= $amount;

        if ($empresa->billetera < 0) {
            return;
        }


        $this->ci->emp->update($empresa->empresa_id, ['billetera' => $empresa->billetera]);
        $user->wallet = $this->ci->wallet->get_by_user_id($user->user_id);

        $user->wallet->real_amount += $amount;
        $this->ci->wallet->update($user->wallet->wallet_id, ['virtual_amount' => $user->wallet->virtual_amount, 'real_amount' => $user->wallet->real_amount]);


        $data_notification = ["texto" => $message, "fecha" => date("Y-m-d"), "usuario_destino" => $user_id];
        $this->ci->not->create($data_notification);

        //Transacciones
        $data_transaction = ["type" => 0, "description" => $message, "date" => date('Y-m-d'), 'user_id' => 0, "valor" => $amount];
        $this->ci->trans->create($data_transaction);

        $data_transaction = ["type" => 1, "description" => $message, "date" => date('Y-m-d'), 'user_id' => $user->user_id, "valor" => $amount];
        $this->ci->trans->create($data_transaction);

    }

    //Pagar de un usuario a la empresa
    function pay_to_enterprise($user_id, $amount, $message, $from_virtual = FALSE)
    {
        $user = $this->ci->user->get_by_id($user_id);
        $data_notification = ["texto" => $message, "fecha" => date("Y-m-d"), "usuario_destino" => 0];
        $this->ci->not->create($data_notification);

        $user->wallet = $this->ci->wallet->get_by_user_id($user->user_id);


        if ($from_virtual == FALSE && $user->wallet->real_amount < $amount) {
            return FALSE;
        } elseif ($from_virtual == TRUE && $user->wallet->virtual_amount < $amount) {
            return FALSE;
        }

        if ($from_virtual) {
            $user->wallet->virtual_amount -= $amount;
        } else {
            $user->wallet->real_amount -= $amount;
        }


        $this->ci->wallet->update($user->wallet->wallet_id,
            ['virtual_amount' => $user->wallet->virtual_amount, 'real_amount' => $user->wallet->real_amount]
        );

        //Transacciones
        $empresa = $this->ci->emp->get_by_id(1);

        if ($from_virtual == FALSE) {
            $billetera = $empresa->billetera + $amount;
            $this->ci->emp->update($empresa->empresa_id, ['billetera' => $billetera]);

            $data_transaction = ["type" => 1, "description" => $message, "date" => date('Y-m-d'), 'user_id' => 0, "valor" => $amount];
            $this->ci->trans->create($data_transaction);
        }

        $data_transaction = ["type" => 0, "description" => $message, "date" => date('Y-m-d'), 'user_id' => $user->user_id, "valor" => $amount];
        $this->ci->trans->create($data_transaction);
    }

    function pay_user_to_user($from_user_id, $to_user_id, $amount, $from_real)
    {
        $father = $this->ci->user->get_by_id($from_user_id);
        $user = $this->ci->user->get_by_id($to_user_id);

        $father->wallet = $this->ci->wallet->get_by_user_id($father->user_id);
        $user->wallet = $this->ci->wallet->get_by_user_id($user->user_id);

        if ($from_real && $father->wallet->real_amount < $amount) {
            return FALSE;
        } else if ($from_real == FALSE && $father->wallet->virtual_amount < $amount) {
            return FALSE;
        }

        $data_notification = ["texto" => translate('transfer_between_users'), "fecha" => date("Y-m-d"), "usuario_destino" => $user->user_id];
        $this->ci->not->create($data_notification);

        if ($from_real) {
            $father->wallet->real_amount -= $amount;
            $user->wallet->real_amount += $amount;
        } else {
            $father->wallet->virtual_amount -= $amount;
            $user->wallet->virtual_amount += $amount * 0.9; //Descuento del 10% en transacciones
        }

        $this->ci->wallet->update($father->wallet->wallet_id, ['virtual_amount' => $father->wallet->virtual_amount,
            'real_amount' => $father->wallet->real_amount]);

        $this->ci->wallet->update($user->wallet->wallet_id, ['virtual_amount' => $user->wallet->virtual_amount,
            'real_amount' => $user->wallet->real_amount]);

        $data_transaction = ["type" => 1, "description" => sprintf(translate('transfer_clients'), $user->email, $amount), "date" => date('Y-m-d'), 'user_id' => $user->user_id, "valor" => $amount];
        $this->ci->trans->create($data_transaction);

        $data_transaction = ["type" => 0, "description" => sprintf(translate('transfer_clients'), $user->email, $amount), "date" => date('Y-m-d'), 'user_id' => $father->user_id, "valor" => $amount];
        $this->ci->trans->create($data_transaction);

        return TRUE;
    }

}
