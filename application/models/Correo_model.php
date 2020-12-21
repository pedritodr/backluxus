<?php
class Correo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function sent($email, $mensaje, $asunto, $motivo)
    {
        $this->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.zoho.com';
        $config['smtp_user'] = 'info@ranicsport.com';
        $config['smtp_pass'] = "ranic1234";

        /*  $config['smtp_user'] = 'pedro@datalabcenter.com';
        $config['smtp_pass'] = "01420109811";*/
        $config['smtp_port'] = '465';
        //$config['smtp_timeout'] = '5';
        //$config['smtp_keepalive'] = TRUE;
        $config['smtp_crypto'] = 'ssl';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from('info@ranicsport.com', $motivo);
        $this->email->to($email);
        $this->email->subject($asunto);
        $this->email->message($mensaje);
        $this->email->send();
    }
}
