<?php

require_once(APPPATH . "/libraries/Pays.php");

class Bonus
{

    function __construct()
    {
        $this->ci = &get_instance();

        $this->ci->load->model('user_model', 'user');
        $this->ci->load->model("notification_model", "not");
        $this->ci->load->model("transaction_model", "trans");
        $this->ci->load->model("wallet_model", "wallet");
        $this->ci->load->model("tree_node_model", "tree_node");
        $this->ci->load->model("affiliation_model", "affiliation");
    }

    private function get_just_active_parents_general($user_id, $levels)
    {
        $parents = [];
        $curr_user = $this->ci->user->get_by_id($user_id);

        while ($levels && $curr_user) {
            $curr_user = $this->ci->user->get_by_id($curr_user->brought_by);
            if ($curr_user == NULL) {
                break;
            }

            if ($curr_user->is_active == 1) {
                $parents[] = $curr_user;
                $levels = $levels - 1;
            }
        }
        return $parents;
    }

    private function get_just_active_parents_binary($user_id, $levels)
    {
        $parents = [];
        $curr_node = $this->ci->tree_node->get_father($user_id);

        while ($levels && $curr_node) {
            $curr_node = $this->ci->tree_node->get_father($curr_node->user_id);
            if ($curr_node == NULL) {
                break;
            }

            $user = $this->ci->user->get_by_id($curr_node->user_id);
            if ($user->is_active == 1) {
                $user->tree_node_id = $curr_node->tree_node_id;
                $user->tree_node_left = $curr_node->tree_node_left;
                $user->tree_node_right = $curr_node->tree_node_right;

                $parents[] = $user;
                $levels = $levels - 1;
            }
        }
        return $parents;
    }

    //inicio rapido 10%, un solo nivel, afiliacion
    function quick_start($user_id, $amount)
    {
        $user = $this->ci->user->get_by_id($user_id);

        if ($user) {
            $father = $this->ci->user->get_by_id($user->brought_by);

            if ($father && $father->is_active) {
                $pays = new Pays();
                $pays->pay_to_user($father->user_id, ($amount * 0.1), translate('pago_bono_referido'));
            }

            //Reparticion de puntos para el Binario
            $parents = $this->get_just_active_parents_binary($user_id, 100000);


            $points = $amount * 0.1;

            $level = 0;
            foreach ($parents as $p) {
                //Bono Liderazgo
                $this->ci->user->update($p->user_id, ['leadership_points' => $p->leadership_points + $amount * 0.1]);


                if ($level >= 12) {
                    $points = $points * 0.1;
                }

                $level = $level + 1;

                //TODO: DOUBLE (10, 2) left_points, right_points
                $father = $this->ci->user->get_by_id($p->user_id);
                if ($this->ci->tree_node->in_which_side($p->user_id, $user_id, TRUE)) {
                    $this->ci->user->update($p->user_id, ['left_points' => $p->left_points + $points]);
                } else {
                    $this->ci->user->update($p->user_id, ['right_points' => $p->right_points + $points]);
                }
            }
        }
    }

    //residual, reparte 2% en 5 niveles, recompra
    function residual($user_id, $amount)
    {
        $parents = $this->get_just_active_parents_general($user_id, 5);
        $pays = new Pays();

        foreach ($parents as $p) {
            $pays->pay_to_user($p->user_id, $amount * 0.02, translate('pago_bono_residual'));
        }
    }

    //Binario, reparte el 10%, a partir del 10 empieza a repartir el 2%
    //Por cada afiliado que este debajo de ti te da el 10% de lo que pago en su afiliacion
    function binary()
    {
        //debe tener 2 hijos activos
        //coge la menor de las puntuaciones, izquierda, derecha, da la menor y quita esa parte de ambas(derecha e izquierda).
        $users = $this->ci->user->get_all();
        foreach ($users as $user) {
            if ($user->is_active) {
                //ver si tiene 2 hijos traidos por el a ambos lados
                if ($this->ci->tree_node->has_2_direct_child($user->user_id)) {
                    $min_points = min([$user->left_points, $user->right_points]);
                    $max_available = $this->ci->affiliation->get_max_affiliation($user->user_id);

                    if ($max_available && ($max_available->price - 50) > 50 && $min_points > 0) {
                        $min_points = min([($max_available->price - 50), $min_points]);

                        $user->left_points -= $min_points;
                        $user->right_points -= $min_points;

                        $this->ci->user->update($user->user_id, ['left_points' => $user->left_points, 'right_points' => $user->right_points]);

                        $pays = new Pays();
                        $pays->pay_to_user($user->user_id, $min_points, translate('pago_bono_binario'));
                    }
                }
            }
        }
    }

    function passive()
    {
        $users = $this->ci->user->get_all();
        foreach ($users as $user) {
            if ($user->is_active) {
                $affiliation = $this->ci->affiliation->get_max_affiliation($user->user_id);
                if ($affiliation) {
                    switch ($affiliation->affiliation_id) {
                        case 1:
                            $this->ci->user->update($user->user_id, ['leadership_points' => $user->passive_points + 10]);
                            break;
                        case 2:
                            $this->ci->user->update($user->user_id, ['leadership_points' => $user->passive_points + 30]);
                            break;
                        case 3:
                            $this->ci->user->update($user->user_id, ['leadership_points' => $user->passive_points + 60]);
                            break;
                        case 4:
                            $this->ci->user->update($user->user_id, ['leadership_points' => $user->passive_points + 100]);
                            break;
                    }
                }
            }
        }
    }

}
