<?php

class Front extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //$this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        // Load the library
        $this->load->library('recaptcha');
        $this->load->library('pagination');
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {
        $data = [];

        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $data_header = array($e, $title = "Luxus", $desc = substr(strip_tags("Las mejores flores del Ecuador"), 0, 250), $imgurl = base_url('assets/img/imagen-no-found.png'), $url = base_url('portada'));
        $this->load_view_front('front/index', $data, 0, $data_header);
    }
    public function colecciones($id)
    {

        $this->load_view_front('front/colecciones');
    }
    public function single_coleccion($coleccion_id)
    {
        $this->load->model('Coleccion_model', 'coleccion');
        $this->load->model('Favorito_model', 'favorito');
        $user_id = $this->session->userdata('user_id');
        $all_favoritos = $this->favorito->get_by_user_id_coleccion($user_id);
        $all_likes = $this->favorito->get_all_favorito_coleccion_like($coleccion_id);


        $coleccion_object = $this->coleccion->get_by_id($coleccion_id);
        if ($coleccion_object) {
            // $foto_coleccion = $this->coleccion->get_by_coleccion_id($coleccion_id);
            $all_productos = $this->coleccion->get_all_productos_by_colecciones($coleccion_id);

            //  $data['foto_coleccion'] = $foto_coleccion;

            $data['all_productos'] = $all_productos;
            $data['all_favoritos'] = $all_favoritos;
            $data['all_likes'] = $all_likes;

            $data['coleccion_object'] = $coleccion_object;
            $this->load_view_front('front/single_coleccion', $data);
        } else {
            show_404();
        }
    }

    public function favoritos()
    {
        $this->load->model('Favorito_model', 'favorito');
        $user_id = $this->session->userdata('user_id');
        $all_productos = $this->favorito->get_all_productos($user_id);

        $all_colecciones = $this->favorito->get_all_colecciones($user_id);

        $data['all_colecciones'] = $all_colecciones;
        $data['all_productos'] = $all_productos;

        $this->load_view_front('front/favoritos', $data);
    }

    public function cart()
    {
        $this->session->set_userdata('cart', true);
        $this->load_view_front('front/cart');
    }

    public function single_producto($producto_id)
    {
        $this->load->model('Product_model', 'product');
        $this->load->model('Categoria_model', 'category');
        //$user_id = $this->session->userdata('user_id');

        $producto_object = $this->product->get_by_id($producto_id);
        $long = strlen($producto_object->description);
        if ($long > 99) {
            $producto_object->corta = substr($producto_object->description, 0, 96) . "...";
        } else {
            $producto_object->corta = $producto_object->description;
        }
        if ($producto_object) {
            $all_fotos = $this->product->get_all_fotos(['product_id' => $producto_id]);
            $relacionados = $this->product->get_all(['categorie_id' => $producto_object->categorie_id]);
            $categoria = $this->category->get_by_id($producto_object->categorie_id);
            $array = [];
            foreach ($relacionados as $item) {
                if ($item->_id != $producto_id) {
                    array_push($array, $item);
                }
            }
            $data['category'] = $categoria;
            $data['relacionados'] = $array;
            $data['all_fotos'] = $all_fotos;
            $data['producto_object'] = $producto_object;
            $e = array(
                'general' => true, //description
                'og' => true,
                'twitter' => true,
                'robot' => true
            );
            $data_header = array($e, $title = $producto_object->name, $desc = substr(strip_tags($producto_object->description), 0, 250), $imgurl = base_url($producto_object->main_photo), $url = base_url(strtolower(seo_url($producto_object->name)) . '-' . strtolower(seo_url($producto_object->codigo))));
            $this->load_view_front('front/single_producto', $data, 0, $data_header);
        } else {
            show_404();
        }
    }
    public function contacto()
    {
        $this->load->model('Company_model', 'empresa');
        $data['empresa_object'] = $this->empresa->get_by_id(1);
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $data_header = array($e, $title = "Ranic contacto", $desc = substr(strip_tags("Ranic está aquí para brindarle más información, responder cualquier pregunta que pueda tener con respecto a nuestros implementos deportivos."), 0, 250), $imgurl = base_url('assets/ranic.png'), $url = base_url('contacto'));
        $this->load_view_front('front/contact', $data, 0, $data_header);
    }
    public function registrar()
    {
        /*  $this->load->model('Empresa_model', 'empresa');
        $data['empresa_object'] = $this->empresa->get_by_id(1); */
        $data = [];

        $this->load_view_front('front/registrar', $data);
    }
    public function about()
    {
        $this->load->model('Company_model', 'empresa');
        $data['empresa_object'] = $this->empresa->get_by_id(1);
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $data_header = array($e, $title = "Ranic información", $desc = substr(strip_tags("Ranic está aquí para brindarle más información, responder cualquier pregunta que pueda tener con respecto a nuestros implementos deportivos."), 0, 250), $imgurl = base_url('assets/ranic.png'), $url = base_url('about'));
        $this->load_view_front('front/about', $data, 0, $data_header);
    }
    public function shop()
    {
        $this->load->model('Company_model', 'empresa');
        $this->load->model('Mongodb_model', 'mongodb');
        $this->load->model('Categoria_model', 'categoria');
        $this->load->model('Product_model', 'producto');
        $categorias = $this->categoria->get_all(['is_active' => 1]);
        if (isset($_GET['search'])) {
            $text = $_GET['search'];
            if ($text == "buscar por productos") {
                $text = NULL;
            }
        } else {
            $text = NULL;
        }
        if (isset($_GET['cat'])) {
            $category = $_GET['cat'];
        } else {
            $category = NULL;
        }
        if (isset($_GET['min'])) {
            $min = (float)$_GET['min'];
        } else {
            $min = -1;
        }
        if (isset($_GET['max'])) {
            $max = (float) $_GET['max'];
        } else {
            $max = 0;
        }

        foreach ($categorias as $item) {

            $productos = $this->producto->get_all(['categoria._id' => $item->_id, 'is_active' => 1]);
            if ($productos) {
                $item->cantidad_productos = count($productos);
            } else {
                $item->cantidad_productos = 0;
            }
        }
        $data['categorias'] = $categorias;

        $productos =  $this->producto->filter_avanzados($text, $category, 0, 0, $min, $max);

        if (!$text && !$category &&  $min == -1 && $max == 0) {
            $config['base_url'] = site_url('shop');
        }
        if ($text != "" && !$category && $min == -1 && $max == 0) {

            $config['base_url'] = site_url('shop?search=' . $_GET['search']);
        }
        if ($text != "" && !$category &&  $min >= 0 && $max > 0) {
            $config['base_url'] = site_url('shop?search=' . $_GET['search'] . '&min=' . $_GET['min'] . '&max=' . $_GET['max']);
        }
        if (!$text && $category != "" && $min == -1 && $max == 0) {

            $config['base_url'] = site_url('shop?search=' . $_GET['search'] . '&cat=' . $_GET['cat']);
        }
        if (!$text && $category != "" && $min >= 0 && $max > 0) {

            $config['base_url'] = site_url('shop?search=' . $_GET['search'] . '&cat=' . $_GET['cat'] . '&min=' . $_GET['min'] . '&max=' . $_GET['max']);
        }
        if ($text != "" && $category != "" && $min >= 0 && $max > 0) {

            $config['base_url'] = site_url('shop?search=' . $_GET['search'] . '&cat=' . $_GET['cat'] . '&min=' . $_GET['min'] . '&max=' . $_GET['max']);
        }
        if (!$text && !$category &&  $min >= 0 && $max > 0) {
            $config['base_url'] = site_url('shop?search=' . $_GET['search']  . '&min=' . $_GET['min'] . '&max=' . $_GET['max']);
        }
        if ($text != "" && $category != "" && $min == -1 && $max == 0) {

            $config['base_url'] = site_url('shop?search=' . $_GET['search'] . '&cat=' . $_GET['cat']);
        }


        $config['page_query_string'] = true;
        $config['total_rows'] = count($productos);
        /*Obtiene el numero de registros a mostrar por pagina */
        $config['per_page'] = '9';
        //  $config['uri_segment'] = 3;
        /*Se personaliza la paginaciÃ³n para que se adapte a bootstrap*/
        $config['cur_tag_open'] = '<a class="current-page" href="#">';
        $config['cur_tag_close'] = '</a>';

        $config['last_link'] = FALSE;
        $config['first_link'] = FALSE;
        $config['next_link'] = '&raquo;';

        $config['prev_link'] = '&laquo;';

        /* Se inicializa la paginacion*/
        $this->pagination->initialize($config);
        if (isset($_GET['per_page'])) {
            $page = $_GET['per_page'];
        } else {
            $page = 0;
        }
        $pagination = $this->pagination->create_links();
        $offset = !$page ? 0 : $page;
        $limit =  $config['per_page'];
        /*   array_push($tuberia, array('$skip' => (int) $offset));
        array_push($tuberia, array('$limit' => (int) $limit)); */

        if ($category) {
            $obj_categoria = $this->categoria->get_all(['name' => $category], true);
            if ($obj_categoria) {
                $category_id = $obj_categoria->_id;
            } else {
                $category_id = NULL;
            }
        } else {
            $category_id = NULL;
        }
        $productos_filter =  $this->producto->filter_avanzados($text, $category, (int)$limit, (int)$offset, (float)$min, (float)$max);

        // $productos_filter = $this->mongodb->filter_avanzado('products', $tuberia);
        $data['text_search'] = $text;
        $data['category'] = $category;
        $data['min'] = $min;
        $data['max'] = $max;
        $data['category_id'] = $category_id;
        $data['productos'] = $productos_filter;
        $data['pagination'] = $pagination;
        $data['empresa_object'] = $this->empresa->get_by_id(1);
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $data_header = array($e, $title = "Shop Ranic", $desc = substr(strip_tags("Tienda deportiva ranic, implementos deportivos"), 0, 250), $imgurl = base_url('assets/ranic.png'), $url = base_url('shop'));
        $this->load_view_front('front/shop', $data, 0, $data_header);
    }
    public function search_product()
    {

        $this->load->model('Product_model', 'product');
        $this->load->model('Coleccion_model', 'coleccion');

        $name = $this->input->post('name');

        $result_productos = $this->product->search_by_name($name);
        $result_colecciones = $this->coleccion->search_by_name($name);

        if ($result_productos) {
            $data['all_productos'] = $result_productos;
            $this->load_view_front('front/productos', $data);
        } else if ($result_colecciones) {
            $data['all_colecciones'] = $result_colecciones;
            $this->load_view_front('front/colecciones', $data);
        } else if (!$result_colecciones && !$result_productos) {

            $this->load_view_front('front/buscar');
        }
    }
    public function filtro_order()
    {
        $this->load->model('Product_model', 'product');
        $this->load->model('Coleccion_model', 'coleccion');
        $id = $this->input->post('id');
        if ($id == 0) {
            $result = $this->coleccion->get_all(['is_active' => 1]);
            foreach ($result as $item) {
                $item->productos = $this->product->get_producto_by_coleccion_id($item->coleccion_id);
            }
        } else {
            $result = $this->product->get_producto_by_categoria_id($id);
        }

        echo json_encode($result);
        exit();
    }


    public function add()
    {
        $this->load->model('User_model', 'user');

        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $repeat_password = $this->input->post('repetir_contraseña');

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('fullname_lang'), 'required');

        // $this->form_validation->set_rules('password', "Contraseña", 'required|matches[repetir_contraseña]');

        if ($this->user->get_by_email($email) == $email) {

            $this->form_validation->set_rules('email', translate('email_lang'), 'required');
        }
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("login-register");
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,
                'email' => $email,
                'surname' => $surname,
                'password' => md5($password),
                'role_id' => 2,
                'is_active' => 1
            ];
            $id = $this->user->create($data_user);
            $user = $this->user->get_by_id($id);
            if ($user) {
                $session_data = object_to_array($user);
                $this->session->set_userdata($session_data);
                $cart = $this->session->userdata('cart');
                if ($cart) {
                    redirect("cart-shopping");
                } else {
                    $this->response->set_message("Bienvenido " . $name, ResponseMessage::SUCCESS);
                    redirect("perfil");
                }
            }
        }
    }
    public function contacto_mensaje()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mensaje_text = $this->input->post('mensaje');
        $phone = $this->input->post('phone');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', "Nombres", 'required');
        $this->form_validation->set_rules('email', "Email", 'required');
        $this->form_validation->set_rules('phone', "Teléfono", 'required');
        $this->form_validation->set_rules('mensaje', "Mensaje", 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("front/contacto");
        } else {
            $this->load->model("Mensaje_model", "mensaje");
            $data = [
                'names' => $name,
                'email' => $email,
                'mensaje' => $mensaje_text,
                'phone' => $phone,
                'is_active' => 1,
                'fecha_creacion' => date("Y-m-d H:i:s")
            ];

            $this->mensaje->create($data);
            $asunto = "Notificación";
            $motivo = "Ranic info";
            $fecha = date('Y-m-d H:i:s');
            $mensaje = "<h5>Fecha: " . $fecha . "</h5>" . "<h5>Email: " . $email . "</h5>" . "<h5>Nombre: " . $name . "</h5>" . "<br>Mensaje: " . $mensaje_text;

            $this->load->model('Correo_model', 'correo');
            $this->correo->sent($email, $mensaje, $asunto, $motivo);

            $this->response->set_message("Mensaje enviado correctamente. Ranic se pondrá en contacto con usted de inmediato. Muchas gracias", ResponseMessage::SUCCESS);
            redirect("front/contacto");
        }
    }

    public function add_favorito($coleccion_id = 0, $producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Favorito_model', 'favorito');

        $user_id = $this->session->userdata('user_id');

        $data = ['user_id' => $user_id, 'coleccion_id' => $coleccion_id, 'producto_id' => $producto_id];
        $this->favorito->create($data);
        if ($coleccion_id != 0) {
            $this->response->set_message("Coleccion agregada a tus favoritos", ResponseMessage::SUCCESS);
            redirect("front/colecciones", "location", 301);
        } else if ($producto_id != 0) {
            $this->response->set_message("Producto agregado a tus favoritos", ResponseMessage::SUCCESS);
            redirect("front/productos", "location", 301);
        }
    }
    public function quitar_favorito($coleccion_id = 0, $producto_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Favorito_model', 'favorito');

        $user_id = $this->session->userdata('user_id');

        if ($coleccion_id != 0) {
            $this->favorito->delete_coleccion($user_id, $coleccion_id);

            $this->response->set_message("Coleccion eliminada de tus favoritos", ResponseMessage::SUCCESS);
            redirect("front/favoritos", "location", 301);
        } else if ($producto_id != 0) {
            $this->favorito->delete_producto($user_id, $producto_id);

            $this->response->set_message("Producto eliminado de tus favoritos", ResponseMessage::SUCCESS);
            redirect("front/favoritos", "location", 301);
        }
    }

    public function get_producto()
    {
        $this->load->model('Product_model', 'product');
        $id = $this->input->post('id');
        $result = $this->product->get_by_id($id);
        if ($result) {
            echo json_encode(['status' => 200, 'product' => $result]);
        } else {
            echo json_encode(['status' => 404]);
        }
        exit();
    }

    public function perfil()
    {
        $this->load->model('User_model', 'user');
        $this->load->model('Pedido_model', 'pedido');

        $user_id = $this->session->userdata('_id');

        $user_object = $this->user->get_by_id($user_id);

        $pedidos = $this->pedido->get_by_pedido_user($user_object);

        $data['user_object'] = $user_object;
        $data['pedidos'] = $pedidos;

        $this->load_view_front('front/perfil_cliente', $data);
    }

    public function create_pedido()
    {
        $this->load->model('User_model', 'user');
        $this->load->model('Pedido_model', 'pedido');
        $user_id = $this->session->userdata('_id');
        $pedido = json_decode($this->input->post('pedido'));
        $subtotal = $this->input->post('subtotal');
        $iva = $this->input->post('iva');
        $total = $this->input->post('total');
        $user_object = $this->user->get_by_id($user_id);
        if ($user_object) {
            $data = [
                'pedido_id' => 'PR-' . uniqid(),
                'lista_pedidos' => $pedido,
                'user' => $user_object,
                'subtotal' => (float) number_format((float)$subtotal, 2),
                'iva' => (float) number_format((float)$iva, 2),
                'total' => (float) number_format((float)$total, 2),
                'fecha_pedido' => date('Y-m-d'),
                'status' => 0
            ];
            $result = $this->pedido->create($data);
            if ($result) {
                $this->session->unset_userdata('cart');
                echo json_encode(['status' => 200]);
            } else {
                echo json_encode(['status' => 404]);
            }
        } else {
            echo json_encode(['status' => 404]);
        }
        exit();
    }

    public function update_perfil()
    {
        $this->load->model('User_model', 'user');

        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $user_id = $this->input->post('user_id');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('fullname_lang'), 'required');

        // $this->form_validation->set_rules('password', "Contraseña", 'required|matches[repetir_contraseña]');

        if ($this->user->get_by_email($email) == $email) {

            $this->form_validation->set_rules('email', translate('email_lang'), 'required');
        }
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("front/registrar");
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,
                'email' => $email,
                'surname' => $surname,
                'password' => md5($password),
                'address' => $address,
                'phone' => $phone,
                'is_active' => 1


            ];
            $this->user->update($user_id, $data_user);
            $this->response->set_message('Sus Datos han Sido Modificados Correctamente', ResponseMessage::SUCCESS);
            redirect("front/perfil");
        }
    }

    public function checkout()
    {
        $this->load_view_front('front/checkout');
    }
}
