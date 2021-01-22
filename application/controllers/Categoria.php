<?php

class Categoria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Categoria_model', 'categoria');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_categorias = $this->categoria->get_all(['is_active' => 1]);
        $data['all_categorias'] = $all_categorias;
        $this->load_view_admin_g("categoria/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Box_model', 'box');
        $data['boxs_type'] = $this->box->get_all(['is_active' => 1]);
        $this->load_view_admin_g('categoria/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $type_box =  $this->input->post('typeBox');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("categoria/add_index");
        } else {
            $name_file = $_FILES['archivo']['name'];
            $category_id = 'category_' . uniqid();
            $this->load->model('Box_model', 'box');
            $objBox = $this->box->get_by_id($type_box);
            if ($name_file != "") {
                $w = 390;
                $h = 510;
                $separado = explode('.', $name_file);
                $ext = end($separado); // me quedo con la extension
                $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                $allow_extension = in_array($ext, $allow_extension_array);
                if ($allow_extension) {
                    $result = save_image_from_post('archivo', './uploads/categoria', time(), $w, $h);
                    if ($result[0]) {
                        $data = ['category_id' => $category_id, 'name' => $name, 'is_active' => 1, 'photo' => $result[1], 'type_box' => $objBox];
                        $this->categoria->create($data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("categoria/index", "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("categoria/add_index");
                    }
                } else {
                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("categoria/add_index");
                }
            } else {
                $data = ['category_id' => $category_id, 'name' => $name, 'is_active' => 1, 'photo' => null, 'type_box' => $objBox];
                $this->categoria->create($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("categoria/index", "location", 301);
            }
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $categoria_object = $this->categoria->get_by_id($id);
        if ($categoria_object) {
            $this->load->model('Box_model', 'box');
            $data['boxs_type'] = $this->box->get_all(['is_active' => 1]);
            $data['categoria_object'] = $categoria_object;
            $this->load_view_admin_g('categoria/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_model', 'product');
        $name = $this->input->post('name');
        $type_box =  $this->input->post('typeBox');
        $categoria_id = $this->input->post('categoria_id');
        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("categoria/update_index/" . $categoria_id);
        } else {
            $w = 390;
            $h = 510;
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {
                if ($_FILES['archivo']['error'] == 4) {
                    $this->load->model('Box_model', 'box');
                    $objBox = $this->box->get_by_id($type_box);
                    $data = ['name' => $name,'type_box'=>$objBox];
                    $row =  $this->categoria->update($categoria_id, $data);
                    $categoria_object = $this->categoria->get_by_id($categoria_id);
                    $this->product->update_categories($categoria_id,$categoria_object);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("categoria/index", "location", 301);
                } else {
                    $categoria_object = $this->categoria->get_by_id($categoria_id);
                        $result = save_image_from_post('archivo', './uploads/categoria', time(), $w, $h);
                        if ($result[0]) {
                            if (file_exists($categoria_object->photo))
                                unlink($categoria_object->photo);
                                $this->load->model('Box_model', 'box');
                                $objBox = $this->box->get_by_id($type_box);
                            $data = ['name' => $name, 'photo' => $result[1],'type_box'=>$objBox];
                            $row =  $this->categoria->update($categoria_id, $data);
                            $categoria_object = $this->categoria->get_by_id($categoria_id);
                            $this->product->update_categories($categoria_id,$categoria_object);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("categoria/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("categoria/update_index/" . $categoria_id);
                        }
                }
            } else {
                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("categoria/update_index/" . $categoria_id);
            }
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $categorie_object = $this->categoria->get_by_id($id);

        if ($categorie_object) {
            $this->categoria->update($id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("categoria/index");
        } else {
            show_404();
        }
    }
    public function destacar($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $categorie_object = $this->categoria->get_by_id($id);

        if ($categorie_object) {
            if ($categorie_object->destacado == 0) {
                $this->categoria->update($id, ['destacado' => 1]);
            } else {
                $this->categoria->update($id, ['destacado' => 0]);
            }

            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("categoria/index");
        } else {
            show_404();
        }
    }
}
