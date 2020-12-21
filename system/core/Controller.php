<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . "/libraries/ResponseMessage.php";

class CI_Controller
{

    /**
     * Reference to the CI singleton
     *
     * @var    object
     */
    private static $instance;

    /**
     * Class constructor
     *
     * @return    void
     */
    public function __construct()
    {
        self::$instance = &$this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var = &load_class($class);
        }

        $this->load = &load_class('Loader', 'core');
        $this->load->initialize();

        // log_message('info', 'Controller Class Initialized');

        //Mabuya stuff
        $this->load->helper(['form', 'url', 'mabuya']);
        $this->load->library(["session", "form_validation", "cart"]);

        $this->response = new ResponseMessage();
        $this->load_language();

        date_default_timezone_set("America/Guayaquil");

        set_error_handler(function ($errno, $errstr, $errfile, $errline, $errcontext) {
            // error was suppressed with the @-operator
            if (0 === error_reporting()) {
                return false;
            }

            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
    }

    function check_user_logged()
    {
        if ($this->session->userdata('user_id') === null) {
            redirect("Login/index");
        }
    }


    function init_form_validation()
    {
        $this->form_validation->set_message('required', translate('required'));
        $this->form_validation->set_message('min_length', translate('min_length'));
        $this->form_validation->set_message('max_length', translate('max_length'));
        $this->form_validation->set_message('valid_email', translate('valid_email'));
        $this->form_validation->set_message('matches', translate('matches'));
        $this->form_validation->set_message('is_unique', translate('is_unique'));
        $this->form_validation->set_message('numeric', translate('numeric'));
        $this->form_validation->set_message('exact_length', translate('exact_length'));
        $this->form_validation->set_message('greater_than', translate('greater_than'));
        $this->form_validation->set_message('less_than', translate('less_than'));
        $this->form_validation->set_message('alpha', translate('alpha'));
        $this->form_validation->set_message('alpha_numeric', translate('alpha_numeric'));
        $this->form_validation->set_message('alpha_dash', translate('alpha_dash'));
        $this->form_validation->set_message('integer', translate('integer'));
        $this->form_validation->set_message('decimal', translate('decimal'));
        $this->form_validation->set_message('is_natural', translate('is_natural'));
        $this->form_validation->set_message('is_natural_no_zero', translate('is_natural_no_zero'));
        $this->form_validation->set_message('valid_emails', translate('valid_emails'));
        $this->form_validation->set_message('valid_ip', translate('valid_ip'));
        $this->form_validation->set_message('valid_base64', translate('valid_base64'));
        $this->form_validation->set_message('alpha_numeric_space', translate('alpha_numeric_space'));
        $this->form_validation->set_message('valid_url', translate('valid_url'));
    }

    // --------------------------------------------------------------------

    /**
     * Get the CI singleton
     *
     * @static
     * @return    object
     */
    public static function &get_instance()
    {
        return self::$instance;
    }

    public function login($session_data)
    {
        $this->session->set_userdata($session_data);
    }

    public function is_logged($session_variables, $redirect_to = "")
    {
        $all_ok = TRUE;
        foreach ($session_variables as $key => $data) {
            if ($this->session->userdata($key) != $data) {
                $all_ok = FALSE;
                break;
            }
        }
        return $all_ok;
    }

    public function log_out()
    {
        foreach ($this->session->userdata() as $key => $data) {
            $this->session->unset_userdata($key);
        }
    }



    public function load_view_front($url = "", $data = [], $like_file = 0, $data_seo = null)
    {
        $data_header = [];
        $data_footer = [];
        if ($data_seo != null)
            $data_header['data_seo'] = $data_seo;

        $this->load->model('company_model', 'empresa');
        $data_header['empresa_object'] = $this->empresa->get_by_id(1);
        $data_footer['empresa_object'] = $data_header['empresa_object'];
        $this->load->model('Categoria_model', 'categoria');
        $data_header['all_categorias'] = $this->categoria->get_all(['is_active' => 1]);

        $this->load->view("front_template/header", $data_header);
        $this->load->view($url, $data, $like_file);

        // $data_footer['categories_footer'] = $this->cat->get_all();
        $this->load->view("front_template/footer", $data_footer);
    }


    public function load_view_admin_g($url = "", $data = [], $like_file = 0)
    {

        $this->load->view("admin/header_g");


        $this->load->view("admin/left_g");
        $this->load->view($url, $data, $like_file);

        $this->load->view("admin/footer_g");
    }

    protected function load_language()
    {
        if (isset($_SESSION['lang'])) {
            switch ($_SESSION['lang']) {
                case "es": {
                        $this->config->load('es_lang'); // cargo el idioma espanniol
                        break;
                    }
                case "en": {
                        $this->config->load('en_lang');   // cargo el idioma ingles
                        break;
                    }
                case "por": {
                        $this->config->load("por_lang");
                        break;
                    }
                default: {
                        $this->config->load('es_lang'); // si me pasan otro que no sean los predefinidos, escojo espanniol por defecto
                    }
            }
        } else {
            $this->config->load('es_lang'); // si no hay ninguno seteado, tomo espanniol por defecto
        }
    }


    public function array_from_post($fields)
    {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function validate_rol($roles)
    {
        if (!in_array($this->session->userdata('role_id'), $roles)) {
            $this->log_out();
            $this->response->set_message(translate('not_access'), ResponseMessage::ERROR);
            redirect("Login/index");
        }
    }
}
