<?php

class User extends CI_Controller
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
    }
    public function index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_users = $this->user->get_all_users();
        $data['all_users'] = $all_users;

        $this->load_view_admin_g("user/index", $data);
    }
    public function index_client()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Country_model', 'country');
        $this->load->model('role_model', 'rol');
        $this->load->model('Carguera_model', 'carguera');
        $roles = $this->rol->get_all(['is_active' => 1]);
        $all_users = $this->user->get_all(['role_id' => 9, 'is_delete' => 0]);
        $users_luxus = $this->user->get_all_users();
        $cargueras = $this->carguera->get_all(['is_active' => 1]);
        $data['cargueras'] = $cargueras;
        $data['countrys'] = $this->country->get_all_countrys();
        $data['all_users'] = $all_users;
        $data['users_luxus'] = $users_luxus;
        $data['roles'] = $roles;
        $this->load_view_admin_g("user/index_client", $data);
    }
    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('role_model', 'rol');
        $roles =  $this->rol->get_all_roles();
        $this->load_view_admin_g('user/add', ['roles' => $roles]);
    }
    public function add_index_client()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('role_model', 'rol');
        $roles = $this->rol->get_all(['is_active' => 1]);
        $data['roles'] = $roles;
        $this->load_view_admin_g('user/add_client', $data);
    }
    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('fullname');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $surname = $this->input->post('surname');
        $password = $this->input->post('password');
        $repeat_password = $this->input->post('repeat_password');
        $role = $this->input->post('role');
        $validaEmail = $this->user->get_by_email($email);
        if ($validaEmail) {
            $this->response->set_message(translate('email_already_exist_lang'), ResponseMessage::ERROR);
            redirect("user/add_index");
        }
        if ($password != $repeat_password) {
            $this->response->set_message("El campo contraseña no coincide con el repetir contraseña", ResponseMessage::ERROR);
        }
        $fecha_create =  date('Y-m-d h:i:s');
        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('surname', "Apellido", 'required');
        $this->form_validation->set_rules('address', "Dirección", 'required');
        $this->form_validation->set_rules('phone', "Teléfono", 'required');
        $this->form_validation->set_rules('role', "Seleccione un rol", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/add_index");
        } else { //en caso de que todo este bien
            $data_user = [
                'user_id' => 'user_' . uniqid(),
                'name' => $name,
                'email' => $email,
                'password' => md5($password),
                'role_id' => (int)$role,
                'address' => $address,
                'phone' => $phone,
                'surname' => $surname,
                'is_active' => 1,
                'date_create' => $fecha_create,
                'is_delete' => 0
            ];
            $this->user->create($data_user);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("user/index");
        }
    }
    public function add_client()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }

        $name_company = $this->input->post('name_company');
        $email = $this->input->post('email');
        $name_commercial = $this->input->post('name_commercial');
        $password = $this->input->post('password');
        $desc = $this->input->post('desc');
        $phone = $this->input->post('phone');
        $comision = (float)$this->input->post('comision');
        $validaEmail = $this->user->get_by_email($email);
        if ($validaEmail) {
            $this->response->set_message(translate('email_already_exist_lang'), ResponseMessage::ERROR);
            redirect("user/add_index_client");
        }
        $fecha_create =  date('Y-m-d h:i:s');
        //establecer reglas de validacion
        $this->form_validation->set_rules('email', translate('email_lang'), 'required');
        $this->form_validation->set_rules('password', translate('password_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/add_index_client");
        } else { //en caso de que todo este bien
            $data_user = [
                'user_id' => 'user_' . uniqid(),
                'name_company' => $name_company,
                'name_commercial' => $name_commercial,
                'email' => $email,
                'password' => md5($password),
                'role_id' => 9,
                'is_active' => 1,
                'date_create' => $fecha_create,
                'is_delete' => 0,
                'observations' => $desc,
                'phone' => $phone,
                'comision' => $comision
            ];
            $this->user->create($data_user);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("user/index_client");
        }
    }
    public  function update_index($user_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $user_object = $this->user->get_by_id($user_id);

        if ($user_object) {
            $this->load->model('role_model', 'rol');
            $data['roles'] =  $this->rol->get_all_roles();
            $data['user_object'] = $user_object;
            $this->load_view_admin_g('user/update', $data);
        } else {
            show_404();
        }
    }
    public function update_index_client($user_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }

        $user_object = $this->user->get_by_id($user_id);

        if ($user_object) {
            $data['user_object'] = $user_object;
            $this->load_view_admin_g('user/update_client', $data);
        } else {
            show_404();
        }
    }
    public function profile_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $user_id = $this->session->userdata('_id');
        $user_object = $this->user->get_by_id($user_id);

        if ($user_object) {
            $data['user_object'] = $user_object;
            $this->load_view_admin_g('user/update', $data);
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

        $name = $this->input->post('fullname');
        $role = $this->input->post('role');
        $user_id = $this->input->post('user_id');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $surname = $this->input->post('surname');
        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('surname', "Apellido", 'required');
        $this->form_validation->set_rules('address', "Dirección", 'required');
        $this->form_validation->set_rules('phone', "Teléfono", 'required');
        $this->form_validation->set_rules('role', "Seleccione un rol", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/update_index/" . $user_id);
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,
                'surname' => $surname,
                'role_id' => (int)$role,
                'address' => $address,
                'phone' => $phone,
                'is_active' => 1,
                'is_delete' => 0
            ];
            $this->user->update($user_id, $data_user);
            if ($role != 3) {
                $this->user->update_user_person($user_id, $data_user);
                $this->load->model('Farm_model', 'farm');
                $this->farm->update_user_person($user_id, $data_user);
            }
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("user/index");
        }
    }
    public function update_client()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }

        $name_company = $this->input->post('name_company');
        $name_commercial = $this->input->post('name_commercial');
        $desc = $this->input->post('desc');
        $user_id = $this->input->post('user_id');
        $phone = $this->input->post('phone');
        $comision = (float)$this->input->post('comision');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name_company', translate('name_company_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/update_index_client");
        } else { //en caso de que todo este bien
            $data_user = [
                'name_company' => $name_company,
                'name_commercial' => $name_commercial,
                'observations' =>  $desc,
                'phone' => $phone,
                'comision' => $comision
            ];
            $this->user->update($user_id, $data_user);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("user/index_client");
        }
    }
    public function delete($user_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $user_object = $this->user->get_by_id($user_id);


        if ($user_object) {
            $this->user->update($user_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("user/index");
        } else {
            show_404();
        }
    }
    public function delete_cliente($user_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login/index');
        }

        $user_object = $this->user->get_by_id($user_id);


        if ($user_object) {
            $this->user->update($user_id, ['is_delete' => 1]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("user/index_client");
        } else {
            show_404();
        }
    }
    public function execute_edit_profile()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('fullname');
        $role = $this->input->post('role');
        $user_id = $this->input->post('user_id');

        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('fullname_lang'), 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/update_index/" . $user_id);
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,
            ];
            $this->user->update($user_id, $data_user);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("dashboard/index");
        }
    }
    public function credenciales_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $user_id = $this->session->userdata('_id');
        $user_object = $this->user->get_by_id($user_id);
        if ($user_object) {
            $data['user_object'] = $user_object;
            $this->load_view_admin_g('user/credenciales', $data);
        } else {
            show_404();
        }
    }
    public function change_status($user_id)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $user_object = $this->user->get_by_id($user_id);
        if ($user_object) {
            if ($user_object->is_active == 1) {
                $this->user->update($user_id, ['is_active' => 2]);
            } else if ($user_object->is_active == 2) {
                $this->user->update($user_id, ['is_active' => 0]);
            } else {
                $this->user->update($user_id, ['is_active' => 1]);
            }
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("user/index_client");
        } else {
            show_404();
        }
    }
    public function execute_edit_credencial()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $password = $this->input->post("password");
        $user_id = $this->input->post("user_id");
        $password_new = $this->input->post("password_new");
        $user_object =  $this->user->get_by_id($user_id);

        $this->form_validation->set_rules('password', "Contraseña anterior", 'required');
        $this->form_validation->set_rules('password_new', "Contraseña nueva", 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/credenciales_index");
        } else {
            if (md5($password) != $user_object->password) {
                $this->response->set_message("La contraseña anterior no coincide con la almacenada", ResponseMessage::ERROR);
                redirect("user/credenciales_index");
            }
            $data_user = [
                "password" => md5($password_new)
            ];
            $this->user->update($user_id, $data_user);
            $this->response->set_message('La contraseña se actualizo correctamente', ResponseMessage::SUCCESS);
            redirect("user/index");
        }
    }
    public function add_address()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $address = $this->input->post('objectCountry');
        $user_id = $this->input->post('userIdAdd');
        $response =  $this->user->update($user_id, ['address' => $address]);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function add_marking()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $nameMarking = $this->input->post('nameMarking');
        $userIdAdd = $this->input->post('userIdAdd');
        $objectCountry = $this->input->post('objectCountry');
        $comment = $this->input->post('comment');
        $carguera = $this->input->post('carguera');
        $marking = 'mk_' . uniqid();
        $data = ['marking_id' => $marking, 'name_marking' => $nameMarking, 'is_active' => 1, 'comment' => $comment, 'country' => $objectCountry, 'carguera' => $carguera];
        $response = $this->user->create_marking($userIdAdd, $data);
        $user_object = $this->user->get_by_id($userIdAdd);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'markings' => $user_object->markings]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function edit_marking()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $nameMarking = $this->input->post('nameMarking');
        $userIdAdd = $this->input->post('userIdAdd');
        $objectCountry = $this->input->post('objectCountry');
        $comment = $this->input->post('comment');
        $marking =  $this->input->post('markingId');
        $carguera = $this->input->post('carguera');
        $data = ['markings.$.name_marking' => $nameMarking, 'markings.$.comment' => $comment, 'markings.$.country' => $objectCountry, 'markings.$.carguera' => $carguera];
        $response = $this->user->update_marking($marking, $data);
        $user_object = $this->user->get_by_id($userIdAdd);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'markings' => $user_object->markings]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function delete_marking()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $userIdAdd = $this->input->post('userIdAdd');
        $marking =  $this->input->post('markingId');
        $response = $this->user->delete_marking($userIdAdd, $marking);
        $user_object = $this->user->get_by_id($userIdAdd);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'markings' => $user_object->markings]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function add_manager()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('Role_model', 'rol');
        $name = $this->input->post('name');
        $userId = $this->input->post('userId');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $function = $this->input->post('functions');
        $objFuction = $this->rol->get_by_id($function);
        $manager_id = 'mg_' . uniqid();
        $data = ['manager_id' => $manager_id, 'name' => $name, 'is_active' => 1, 'phone' => $phone, 'email' => $email, 'function' => $objFuction];
        $response = $this->user->create_manager($userId, $data);
        $user_object = $this->user->get_by_id($userId);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'managers' => $user_object->managers]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function update_manager()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $this->load->model('Role_model', 'rol');
        $name = $this->input->post('name');
        $userId = $this->input->post('userId');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $function = $this->input->post('functions');
        $objFuction = $this->rol->get_by_id($function);
        $managerId =  $this->input->post('managerId');
        $data = ['managers.$.name' => $name, 'managers.$.email' => $email, 'managers.$.phone' => $phone, 'managers.$.function' => $objFuction];

        $response = $this->user->update_manager($managerId, $data);
        $user_object = $this->user->get_by_id($userId);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'managers' => $user_object->managers]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function delete_manager()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $userId = $this->input->post('userId');
        $managerId =  $this->input->post('managerId');
        $response = $this->user->delete_manager($userId, $managerId);
        $user_object = $this->user->get_by_id($userId);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'managers' => $user_object->managers]);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
    public function add_person_luxus()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
            exit();
        }
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
            exit();
        }
        $personLuxus = (object)$this->input->post('personLuxus');
        $userId = $this->input->post('userId');
        $person_id = 'pl_' . uniqid();
        $personLuxus->person_luxus_id = $person_id;
        $personLuxus->person_is_active = 1;
        $response = $this->user->update($userId, ['person_luxus' => $personLuxus]);
        if ($response) {
            echo json_encode(['status' => 200, 'msj' => 'correcto']);
            exit();
        } else {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
            exit();
        }
    }
}
