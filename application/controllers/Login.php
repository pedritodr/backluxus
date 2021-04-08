<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
        header('Access-Control-Allow-Origin: *');
    }



    public function index()
    {
        $this->load->view("login");
    }

    public function auth()
    {
        $email = trim(strtolower($this->input->post('email')));
        $password = md5(trim($this->input->post('password')));
        $user = $this->user->get_by_email($email);
        if ($user) {
            if ($user->password == $password) {
                $session_data = object_to_array($user);
                $this->session->set_userdata($session_data);
                echo json_encode(['status' => 200, 'msj' => 'correcto', 'user' => $this->session->userdata()]);
            } else {
                echo json_encode(['status' => 500, 'msj' => 'La contraseña no coincide con la registrada en la base de datos']);
            }
        } else {
            echo json_encode(['status' => 500, 'msj' => 'El email no esta registrado']);
        }
        exit();
    }

    public function facebook_auth()
    {
    }

    public function logout()
    {
        parent::log_out();
        redirect(site_url());
    }

    public function recover_password_index()
    {
        $this->load->view("recover_password");
    }

    public function recover_password()
    {
        $email = $this->input->post("email");

        $this->load->model("User_model", "user");

        $user_object = true;
        if ($user_object) {
            $new_password = time();

            $this->user->update_user($email, ['password' => md5($new_password)]);


            $this->load->library('email');

            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.zoho.com';
            $config['smtp_user'] = 'luxus@luxus.com';
            $config['smtp_pass'] = "ranic1234";
            $config['smtp_port'] = '465';
            //$config['smtp_timeout'] = '5';
            //$config['smtp_keepalive'] = TRUE;
            $config['smtp_crypto'] = 'ssl';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from('luxus@luxus.com', 'Recuperación de Contraseña');

            $this->email->to($email);

            $this->email->subject("Recuperación de Contraseña");
            $mensaje = "Estimado usuario: <br /> La contraseña ha sido generada satisfactoriamente.  <br /> Su nueva contraseña es: <b>" . $new_password . "</b>. <br /> Muchas gracias";
            $this->email->message($mensaje);

            $this->email->send();

            $this->response->set_message("Su Nueva Contraseña ha sido enviado a su correo", ResponseMessage::SUCCESS);
            redirect("login-register");
        } else {
            $this->response->set_message("El correo electrónico no existe", ResponseMessage::ERROR);
            redirect("login-register");
        }
    }
}
