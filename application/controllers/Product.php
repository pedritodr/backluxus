<?php

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model', 'product');
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
        $all_productos = $this->product->get_all(['is_active' => 1]);
        $data['all_productos'] = $all_productos;
        $this->load_view_admin_g("product/index", $data);
    }


    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Categoria_model', 'categoria');
        $all_categorias = $this->categoria->get_all(['is_active' => 1]);
        $data['all_categorias'] = $all_categorias;
        $this->load_view_admin_g('product/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Categoria_model', 'categoria');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $categoria = $this->input->post('categoria');
        $color = $this->input->post('color');
        $stems_bunch = (int)$this->input->post('stems_bunch');
        $obj_categoria = $this->categoria->get_by_id($categoria);
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('categoria', translate('categorie_lang'), 'required');
        $this->form_validation->set_rules('stems_bunch', translate('stems_bunch_lang'), 'required|numeric');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product/add_index", "location", 301);
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            if ($name_file != "") {
                $separado = explode('.', $name_file);
                $ext = end($separado); // me quedo con la extension
                $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                $allow_extension = in_array($ext, $allow_extension_array);
                if ($allow_extension) {
                    $result = save_image_from_post('archivo', './uploads/product', time(), 600, 600);
                    if ($result[0]) {
                        $data = ['product_id' => 'product_' . uniqid(), 'name' => $name, 'description' => $desc, 'photo' => $result[1], 'stems_bunch' => $stems_bunch, 'categorie_id' => $categoria, 'is_active' => 1, 'color' => $color, 'categoria' => $obj_categoria];
                        $this->product->create($data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("product/index");
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("product/add_index", "location", 301);
                    }
                } else {
                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("product/add_index", "location", 301);
                }
            } else {
                $data = ['product_id' => 'product_' . uniqid(), 'name' => $name, 'description' => $desc, 'photo' => null, 'stems_bunch' => $stems_bunch, 'categorie_id' => $categoria, 'is_active' => 1, 'color' => $color, 'categoria' => $obj_categoria];
                $this->product->create($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("product/index");
            }
        }
    }


    function update_index($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Categoria_model', 'categoria');

        $producto_object = $this->product->get_by_id($producto_id);

        if ($producto_object) {
            $producto_object->categoria = $this->categoria->get_by_id($producto_object->categorie_id);
            $all_categorias = $this->categoria->get_all(['is_active' => 1]);
            $data['all_categorias'] = $all_categorias;
            $data['producto_object'] = $producto_object;
            $this->load_view_admin_g('product/update', $data);
        } else {
            show_404();
        }
    }

    function update_foto_coleccion_index($foto_producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_producto_object = $this->product->get_by_foto_producto_id($foto_producto_id);

        if ($foto_producto_object) {
            $data['foto_producto_object'] = $foto_producto_object;
            $this->load_view_admin_g('product/foto_producto_update', $data);
        } else {
            show_404();
        }
    }

    function foto_coleccion($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_fotos = $this->product->get_all_fotos(['product_id' => $producto_id]);
        $data['all_fotos'] = $all_fotos;
        $data['producto_id'] = $producto_id;

        $this->load_view_admin_g('product/foto_producto', $data);
    }
    function foto_coleccion_add($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $data['producto_id'] = $producto_id;

        $this->load_view_admin_g('product/add_foto', $data);
    }


    public function add_foto()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $producto_id = $this->input->post('producto_id');
        //en caso de que todo este bien
        $name_file = $_FILES['archivo']['name'];

        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {
            $result = save_image_from_post('archivo', './uploads/fotos_productos', time(), 600, 600);
            if ($result[0]) {
                $data = ['photo' => $result[1], 'product_id' => $producto_id];
                $this->product->create_foto_producto($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("product/foto_coleccion/" . $producto_id);
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("product/foto_coleccion/" . $producto_id, "location", 301);
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("product/foto_coleccion/" . $producto_id, "location", 301);
        }
    }
    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Categoria_model', 'categoria');
        $name = $this->input->post('name');
        $desc = $this->input->post('desc');
        $categoria = $this->input->post('categoria');
        $color = $this->input->post('color');
        $stems_bunch = (int)$this->input->post('stems_bunch');
        $producto_id = $this->input->post('producto_id');
        $producto_object = $this->product->get_by_id($producto_id);
        $obj_categoria = $this->categoria->get_by_id($categoria);
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('desc', translate('descripcion_lang'), 'required');
        $this->form_validation->set_rules('categoria', translate('categorie_lang'), 'required');
        $this->form_validation->set_rules('stems_bunch', translate('stems_bunch_lang'), 'required|numeric');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product/update_index/" . $producto_id);
        } else { //en caso de que todo este bien

            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['name' => $name, 'description' => $desc, 'stems_bunch' => $stems_bunch, 'color' => $color, 'categorie_id' => $categoria, 'categoria' => $obj_categoria];
                    $this->product->update($producto_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("product/index");
                } else {

                    if ($producto_object) {

                        $result = save_image_from_post('archivo', './uploads/product', time(), 600, 600);
                        if ($result[0]) {
                            if (file_exists($producto_object->main_photo))
                                unlink($producto_object->main_photo);

                            $data = ['name' => $name, 'main_photo' => $result[1], 'description' => $desc, 'stems_bunch' => $stems_bunch, 'color' => $color, 'categorie_id' => $categoria, 'categoria' => $obj_categoria];
                            $this->product->update($producto_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("product/index");
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("product/update_index/" . $producto_id);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("product/update_index/" . $producto_id);
            }
        }
    }
    public function update_foto_coleccion()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_producto_id = $this->input->post('foto_producto_id');
        $foto_producto_object = $this->product->get_by_foto_producto_id($foto_producto_id);

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($foto_producto_object) {

                $result = save_image_from_post('archivo', './uploads/product', time(), 600, 600);
                if ($result[0]) {
                    if (file_exists($foto_producto_object->photo))
                        unlink($foto_producto_object->photo);

                    $data = ['photo' => $result[1]];
                    $this->product->update_foto_coleccion($foto_producto_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("product/foto_coleccion/" . $foto_producto_object->product_id);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("product/update_foto_coleccion_index/" . $foto_producto_id);
                }
            } else {
                show_404();
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("product/update_foto_coleccion_index/" . $foto_producto_id);
        }
    }

    public function delete($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $producto_object = $this->product->get_by_id($producto_id);

        if ($producto_object) {

            $this->product->update($producto_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("product/index");
        } else {
            show_404();
        }
    }

    public function delete_foto($foto_producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_producto_object = $this->product->get_foto_producto_by_id($foto_producto_id);

        if ($foto_producto_object) {
            unlink($foto_producto_object->photo);
            $this->product->delete_foto_producto($foto_producto_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("product/foto_coleccion/" . $foto_producto_object->product_id, "location", 301);
        } else {
            show_404();
        }
    }

    public function change($producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $producto_object = $this->product->get_by_id($producto_id);

        if ($producto_object) {
            if ($producto_object->is_active == 1)
                $this->product->update($producto_id, ['is_active' => 0]);
            if ($producto_object->is_active == 0)
                $this->product->update($producto_id, ['is_active' => 1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("product/index");
        } else {
            show_404();
        }
    }
    public function scriptProductos()
    {

        $productos = $this->product->get_all();

        if ($productos) {
            foreach ($productos as $item) {
                if (!isset($item->codigo)) {
                    $this->product->update2($item->_id, ['codigo' => 'CP-' . uniqid()]);
                }
            }
        } else {
            show_404();
        }
    }
}
