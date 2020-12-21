<?php

class Empresa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Company_model', 'empresa');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index($empresa_id = 1)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $empresa_object = $this->empresa->get_by_id($empresa_id);

        if ($empresa_object) {
            $data['empresa_object'] = $empresa_object;
            $this->load_view_admin_g('empresa/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }
        $nombre = $this->input->post('nombre');
        $desc = $this->input->post('desc');
        $mision = $this->input->post('mision');
        $vision = $this->input->post('vision');
        $telef = $this->input->post('telef');
        $email = $this->input->post('email');
        $direccion = $this->input->post('direccion');
        $facebook = $this->input->post('face');
        $youtube = $this->input->post('you');
        $instagram = $this->input->post('instagram');
        $url_video = $this->input->post('url_video');
        $whatsapp = $this->input->post('whatsapp');


        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        /* $this->form_validation->set_rules('desc', "Sobre nosotros", 'required');
        $this->form_validation->set_rules('mision', translate('mision_lang'), 'required');
        $this->form_validation->set_rules('vision', translate('vision_lang'), 'required');
        $this->form_validation->set_rules('telef', translate('phone_lang'), 'required');
        $this->form_validation->set_rules('email', translate('email_lang'), 'required');
        $this->form_validation->set_rules('direccion', translate('direccion_lang'), 'required');*/

        $empresa_id = $this->input->post('empresa_id');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("empresa/index");
        } else { //en caso de que todo este bien
            $empresa_object = $this->empresa->get_by_id($empresa_id);

            if ($empresa_object) {
                $data = [

                    'name' => $nombre,
                    'about' => $desc,
                    'mision' => $mision,
                    'vision' => $vision,
                    'address' => $direccion,
                    'phone' => $telef,
                    'email' => $email,
                    'facebook' => $facebook,
                    'instagram' => $instagram,
                    'youtube' => $youtube,
                    'video_url' => $url_video,
                    'whatsapp' => $whatsapp

                ];

                $this->empresa->update($empresa_id, $data);

                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("empresa/index", "location", 301);
            } else {
                show_404();
            }
        }
    }


    function update_foto_opinion()
    {
        if (!in_array($this->session->userdata('rol_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }


        $w = 985;
        $h = 661;

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {

            $this->load->model("Opinion_model", "opinion");
            $empresa_object = $this->empresa->get_by_id(1);
            $result = save_image_from_post('archivo', './uploads/banner', time(), $w, $h);
            if ($result[0]) {
                if (file_exists($empresa_object->foto_opinion))
                    unlink($empresa_object->foto_opinion);

                $data = ['foto_opinion' => $result[1]];
                $this->opinion->set_foto_section($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("opinion/index", "location", 301);
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("opinion/index", "location", 301);
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("opinion/index", "location", 301);
        }
    }

    function about()
    {
        if (!in_array($this->session->userdata('rol_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('empresa_model', 'empresa');
        $data['empresa_object'] = $this->empresa->get_by_id(1);
        $this->load_view_admin_g("empresa/about", $data);
    }

    function update_historia()
    {
        $historia = $this->input->post('historia');

        $w = 975;
        $h = 483;

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($_FILES['archivo']['error'] == 4) {
                $data = [
                    'historia' => $historia
                ];

                $this->empresa->update(1, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("empresa/about", "location", 301);
            } else {

                $empresa_object = $this->empresa->get_by_id(1);

                if ($empresa_object) {

                    $result = save_image_from_post('archivo', './uploads/about', time(), $w, $h);
                    if ($result[0]) {
                        if (file_exists($empresa_object->imagen_historia))
                            unlink($empresa_object->imagen_historia);

                        $data = [
                            'historia' => $historia,
                            'imagen_historia' => $result[1]
                        ];
                        $this->empresa->update(1, $data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("empresa/about", "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("empresa/about", "location", 301);
                    }
                } else {
                    show_404();
                }
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("empresa/about", "location", 301);
        }
    }

    function update_vision()
    {
        $vision = $this->input->post('vision');

        $w = 975;
        $h = 483;

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($_FILES['archivo']['error'] == 4) {
                $data = [
                    'vision' => $vision
                ];

                $this->empresa->update(1, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("empresa/about", "location", 301);
            } else {

                $empresa_object = $this->empresa->get_by_id(1);

                if ($empresa_object) {

                    $result = save_image_from_post('archivo', './uploads/about', time(), $w, $h);
                    if ($result[0]) {
                        if (file_exists($empresa_object->imagen_vision))
                            unlink($empresa_object->imagen_vision);

                        $data = [
                            'vision' => $vision,
                            'imagen_vision' => $result[1]
                        ];
                        $this->empresa->update(1, $data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("empresa/about", "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("empresa/about", "location", 301);
                    }
                } else {
                    show_404();
                }
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("empresa/about", "location", 301);
        }
    }

    function update_mision()
    {

        $mision = $this->input->post('mision');

        $w = 975;
        $h = 483;

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($_FILES['archivo']['error'] == 4) {
                $data = [
                    'mision' => $mision
                ];

                $this->empresa->update(1, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("empresa/about", "location", 301);
            } else {

                $empresa_object = $this->empresa->get_by_id(1);

                if ($empresa_object) {

                    $result = save_image_from_post('archivo', './uploads/about', time(), $w, $h);
                    if ($result[0]) {
                        if (file_exists($empresa_object->imagen_mision))
                            unlink($empresa_object->imagen_mision);

                        $data = [
                            'mision' => $mision,
                            'imagen_mision' => $result[1]
                        ];
                        $this->empresa->update(1, $data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("empresa/about", "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("empresa/about", "location", 301);
                    }
                } else {
                    show_404();
                }
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("empresa/about", "location", 301);
        }
    }

    function update_presentacion()
    {
        $titulo = $this->input->post('titulo');
        $firmante = $this->input->post('firmante');
        $presentacion = $this->input->post('presentacion');

        $w = 555;
        $h = 365;

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($_FILES['archivo']['error'] == 4) {
                $data = [
                    'titulo_seccion_about' => $titulo,
                    'firmante' => $firmante,
                    'descripcion' => $presentacion
                ];

                $this->empresa->update(1, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("empresa/about", "location", 301);
            } else {

                $empresa_object = $this->empresa->get_by_id(1);

                if ($empresa_object) {

                    $result = save_image_from_post('archivo', './uploads/about', time(), $w, $h);
                    if ($result[0]) {
                        if (file_exists($empresa_object->imagen_presentacion))
                            unlink($empresa_object->imagen_presentacion);

                        $data = [
                            'titulo_seccion_about' => $titulo,
                            'firmante' => $firmante,
                            'descripcion' => $presentacion,
                            'imagen_presentacion' => $result[1]
                        ];
                        $this->empresa->update(1, $data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("empresa/about", "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("empresa/about", "location", 301);
                    }
                } else {
                    show_404();
                }
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("empresa/about", "location", 301);
        }
    }

    /*
    public function delete($empresa_id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $empresa_object = $this->empresa->get_by_id($empresa_id);

        if($empresa_object){
            $this->empresa->update($empresa_id,['is_active'=>0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("empresa/index");
        }else{
            show_404();
        }
    }
*/
}
