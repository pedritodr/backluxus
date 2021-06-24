<?php

class Country extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Country_model', 'country');
    $this->load->library(array('session'));
    $this->load->helper("mabuya");

    @session_start();
    $this->load_language();
    $this->init_form_validation();
  }

  public function index()
  {

    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      $this->log_out();
      redirect('login/index');
    }
    $all_countrys = $this->country->get_all_countrys();
    $data['all_countrys'] = $all_countrys;
    $this->load_view_admin_g("country/index", $data);
  }

  public function add_index()
  {
    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      $this->log_out();
      redirect('login/index');
    }
    $this->load_view_admin_g('country/add');
  }

  public function add()
  {
    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      $this->log_out();
      redirect('login/index');
    }

    $name = $this->input->post('name');

    $this->form_validation->set_rules('name', "Nombre", 'required');

    if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
      $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
      redirect("country/add_index");
    } else {
      $country_id = 'country_' . uniqid();
      $data = ['country_id' => $country_id, 'name' => $name, 'is_active' => 1, 'citys' => []];
      $this->country->create($data);
      $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
      redirect("country/index", "location", 301);
    }
  }
  public function add_city()
  {
    if (!$this->session->userdata('user_id')) {
      echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
      exit();
    }
    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
      exit();
    }
    $name = $this->input->post('nameCityAdd');
    $country_id = $this->input->post('countryId');
    $city_id = 'city_' . uniqid();
    $data = ['city_id' => $city_id, 'name' => $name, 'is_active' => 1, 'country_id' => $country_id];
    $response =  $this->country->create_city($country_id, $data);
    $citys = $this->country->get_all_citys($country_id);
    if ($response) {
      echo json_encode(['status' => 200, 'msj' => 'correcto', 'citys' => $citys]);
      exit();
    } else {
      echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
      exit();
    }
  }

  public function update_city()
  {
    if (!$this->session->userdata('user_id')) {
      echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
      exit();
    }
    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
      exit();
    }
    $name = $this->input->post('nameCityEdit');
    $city_id = $this->input->post('cityId');
    $country_id = $this->input->post('countryId');
    $response =  $this->country->update_city($city_id, $name);
    $this->country->update_city_user($city_id, $name);
    $this->country->update_city_user_marking($city_id, $name);
    $citys = $this->country->get_all_citys($country_id);
    if ($response) {
      echo json_encode(['status' => 200, 'msj' => 'correcto', 'citys' => $citys]);
      exit();
    } else {
      echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
      exit();
    }
  }

  public function delete_city()
  {
    if (!$this->session->userdata('user_id')) {
      echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los usuarios autenticados']);
      exit();
    }
    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      echo json_encode(['status' => 500, 'msj' => 'Esta opción solo esta disponible para los administradores']);
      exit();
    }
    $city_id = $this->input->post('cityId');
    $country_id = $this->input->post('countryId');
    $response =  $this->country->update_status_city($city_id);

    $citys = $this->country->get_all_citys($country_id);
    if ($response) {
      echo json_encode(['status' => 200, 'msj' => 'correcto', 'citys' => $citys]);
      exit();
    } else {
      echo json_encode(['status' => 404, 'msj' => 'Ocurrió un error vuelva a intentarlo']);
      exit();
    }
  }

  function update_index($id = 0)
  {
    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      $this->log_out();
      redirect('login/index');
    }

    $country_object = $this->country->get_by_id($id);

    if ($country_object) {
      $data['country_object'] = $country_object;
      $this->load_view_admin_g('country/update', $data);
    } else {
      show_404();
    }
  }

  public function update()
  {
    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      $this->log_out();
      redirect('login/index');
    }
    $name = $this->input->post('name');
    $country_id = $this->input->post('country_id');
    $this->form_validation->set_rules('name', "Nombre", 'required');
    if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
      $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
      redirect("country/update_index/" . $country_id);
    } else {
      $data = ['name' => $name];
      $row =  $this->country->update($country_id, $data);
      $this->country->update_country_user($country_id, (object)$data);
      $this->country->update_country_user_marking($country_id, (object)$data);
      $this->country->update_city_user_markets($country_id, $name);
      $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
      redirect("country/index", "location", 301);
    }
  }

  public function delete($id = 0)
  {
    if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
      $this->log_out();
      redirect('login/index');
    }

    $country_object = $this->country->get_by_id($id);

    if ($country_object) {
      $this->country->update($id, ['is_active' => 0]);
      $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
      redirect("country/index");
    } else {
      show_404();
    }
  }
  public function crear_citys()
  {

    $json_ciudades = '[
            {
              "codigo": 20100101901,
              "nombre": "AMBATO",
              "trayecto": "TP"
            },
            {
              "codigo": 20100101902,
              "nombre": "BAÑOS DE AGUA SANTA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001001,
              "nombre": "QUITO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001002,
              "nombre": "CAYAMBE",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001003,
              "nombre": "TABACUNDO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001004,
              "nombre": "SANTO DOMINGO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001005,
              "nombre": "SANGOLQUI",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001006,
              "nombre": "SAN RAFAEL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001007,
              "nombre": "EL QUINCHE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001008,
              "nombre": "MACHACHI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001009,
              "nombre": "CUMBAYA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001010,
              "nombre": "SAN MIGUEL DE LOS BANCOS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001011,
              "nombre": "LA CONCORDIA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001012,
              "nombre": "PEDRO V. MALDONADO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001013,
              "nombre": "PUERTO QUITO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001014,
              "nombre": "GUAYLLABAMBA",
              "trayecto": "TA"
            },
            {
              "codigo": 201001001017,
              "nombre": "LA INDEPENDENCIA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001018,
              "nombre": "AMAGUAÑA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001019,
              "nombre": "ALOAG",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001020,
              "nombre": "TUMBACO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001021,
              "nombre": "MITAD DEL MUNDO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001022,
              "nombre": "CALACALI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001024,
              "nombre": "CALDERON",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001025,
              "nombre": "PIFO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001026,
              "nombre": "PUEMBO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001027,
              "nombre": "SAN ANTONIO IBARRA",
              "trayecto": "TI"
            },
            {
              "codigo": 201001001028,
              "nombre": "POMASQUI",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001029,
              "nombre": "NANEGALITO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001030,
              "nombre": "MARCELINO MARIDUEÑA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001031,
              "nombre": "ALANGASI",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001032,
              "nombre": "24 DE MAYO",
              "trayecto": "TJ"
            },
            {
              "codigo": 201001001033,
              "nombre": "CONOCOTO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001035,
              "nombre": "PEDRO MONCAYO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001036,
              "nombre": "PINTAG",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001037,
              "nombre": "YARUQUI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001038,
              "nombre": "EL TINGO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001039,
              "nombre": "VALLE DE LOS CHILLOS",
              "trayecto": "TP"
            },
            {
              "codigo": 201001001040,
              "nombre": "VALLE HERMOSO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001041,
              "nombre": "PUSUQUI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001042,
              "nombre": "AYORA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001043,
              "nombre": "AZCASUBI VIA AL QUINCHE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001044,
              "nombre": "CUSUBAMBA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001045,
              "nombre": "JUAN MONTALVO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001046,
              "nombre": "ALOASI",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001047,
              "nombre": "LA ARMENIA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001048,
              "nombre": "LLANO CHICO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001049,
              "nombre": "LLANO GRANDE",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001050,
              "nombre": "MARIANA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001051,
              "nombre": "MIRAVALLE",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001052,
              "nombre": "ORQUIDEAS",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001053,
              "nombre": "SAN ANTONIO DE PICHINCHA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001054,
              "nombre": "SAN JOSE DE MORAN",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001055,
              "nombre": "SAN JUAN DE CALDERON",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001056,
              "nombre": "TABABELA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001057,
              "nombre": "UYUMBICHO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001058,
              "nombre": "ZAMBISA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001001059,
              "nombre": "MONTERREY",
              "trayecto": "TE"
            },
            {
              "codigo": 201001001060,
              "nombre": "LAS VILLEGAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002001,
              "nombre": "GUAYAQUIL",
              "trayecto": "TP"
            },
            {
              "codigo": 201001002002,
              "nombre": "DURAN",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002003,
              "nombre": "MILAGRO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002004,
              "nombre": "SALINAS",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002005,
              "nombre": "PLAYAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002006,
              "nombre": "YAGUACHI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002007,
              "nombre": "EL TRIUNFO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002009,
              "nombre": "DAULE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002010,
              "nombre": "SANTA ELENA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002011,
              "nombre": "EL EMPALME",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002013,
              "nombre": "LA LIBERTAD",
              "trayecto": "TP"
            },
            {
              "codigo": 201001002014,
              "nombre": "BALAO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002015,
              "nombre": "NARANJAL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002016,
              "nombre": "BALZAR",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002017,
              "nombre": "TENGUEL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002018,
              "nombre": "JUJAN",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002019,
              "nombre": "SAMBORONDON",
              "trayecto": "TP"
            },
            {
              "codigo": 201001002021,
              "nombre": "NOBOL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002022,
              "nombre": "PALESTINA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002023,
              "nombre": "SANTA LUCIA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002024,
              "nombre": "LOMAS DE SARGENTILLO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002025,
              "nombre": "ISIDRO AYORA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002027,
              "nombre": "CERECITA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002028,
              "nombre": "PUERTO INCA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002029,
              "nombre": "COLIMES",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002030,
              "nombre": "LAUREL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002031,
              "nombre": "SALITRE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002032,
              "nombre": "CHONGON",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002033,
              "nombre": "NARANJITO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002034,
              "nombre": "ANCON",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002035,
              "nombre": "POSORJA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002036,
              "nombre": "PALENQUE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002037,
              "nombre": "BUCAY",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002038,
              "nombre": "SIMON BOLIVAR",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002039,
              "nombre": "KM 26",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002040,
              "nombre": "PEDRO CARBO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002041,
              "nombre": "JULIO ANDRADE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002042,
              "nombre": "PROGRESO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002043,
              "nombre": "MONJAS",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002046,
              "nombre": "ANCONCITO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002047,
              "nombre": "TAURA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002048,
              "nombre": "BASE TAURA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002049,
              "nombre": "EL DESEO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002050,
              "nombre": "LORENZO DE GARAICOA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002051,
              "nombre": "MARISCAL SUCRE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002052,
              "nombre": "ROBERTO ASTUDILLO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002053,
              "nombre": "MANUEL J. CALLE",
              "trayecto": "TS"
            },
            {
              "codigo": 201001002054,
              "nombre": "CHIVERIA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002055,
              "nombre": "COLORADAL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002056,
              "nombre": "GENERAL VERNAZA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002057,
              "nombre": "LA MARAVILLA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002058,
              "nombre": "LAS ANIMAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002059,
              "nombre": "LOS TINTOS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002060,
              "nombre": "PETRILLO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002061,
              "nombre": "PUENTE LUCIA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002062,
              "nombre": "SABANILLA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002063,
              "nombre": "TARIFA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001002064,
              "nombre": "MATILDE ESTHER",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003002,
              "nombre": "GIRON",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003003,
              "nombre": "GUALACEO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003004,
              "nombre": "PAUTE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003005,
              "nombre": "SANTA ISABEL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003006,
              "nombre": "CHORDELEG",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003007,
              "nombre": "SIG SIG",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003008,
              "nombre": "PATATE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003009,
              "nombre": "EL TAMBO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003011,
              "nombre": "CUENCA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001003014,
              "nombre": "YUNGILLA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003016,
              "nombre": "CHAULLABAMBA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003017,
              "nombre": "CUMBE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003018,
              "nombre": "YUNGUILLA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001003019,
              "nombre": "ZONA FRANCA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001004001,
              "nombre": "GUARANDA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001004002,
              "nombre": "ECHEANDIA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001004003,
              "nombre": "CHIMBO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001004005,
              "nombre": "CHILLANES",
              "trayecto": "TE"
            },
            {
              "codigo": 201001004006,
              "nombre": "SAN MIGUEL DE BOLIVAR",
              "trayecto": "TS"
            },
            {
              "codigo": 201001004007,
              "nombre": "CALUMA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001004008,
              "nombre": "CHAMBO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001004010,
              "nombre": "SAN PEDRO DE GUANUJO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001004011,
              "nombre": "SALINAS DE GUARANDA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001005001,
              "nombre": "AZOGUES",
              "trayecto": "TP"
            },
            {
              "codigo": 201001005002,
              "nombre": "LA TRONCAL",
              "trayecto": "TP"
            },
            {
              "codigo": 201001005003,
              "nombre": "CAÑAR",
              "trayecto": "TP"
            },
            {
              "codigo": 201001005004,
              "nombre": "BIBLIAN",
              "trayecto": "TE"
            },
            {
              "codigo": 201001005005,
              "nombre": "TAMBO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001005006,
              "nombre": "DELEG",
              "trayecto": "TE"
            },
            {
              "codigo": 201001005007,
              "nombre": "COJITAMBO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001006001,
              "nombre": "TULCAN",
              "trayecto": "TP"
            },
            {
              "codigo": 201001006002,
              "nombre": "MIRA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001006003,
              "nombre": "EL ANGEL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001006004,
              "nombre": "SAN GABRIEL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001006005,
              "nombre": "HUACA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001006006,
              "nombre": "BOLIVAR",
              "trayecto": "TE"
            },
            {
              "codigo": 201001007001,
              "nombre": "LATACUNGA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001007002,
              "nombre": "SALCEDO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001007003,
              "nombre": "SAQUISILI",
              "trayecto": "TS"
            },
            {
              "codigo": 201001007004,
              "nombre": "PUJILI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001007005,
              "nombre": "LA MANA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001007007,
              "nombre": "LASSO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001007008,
              "nombre": "PASTOCALLE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001007009,
              "nombre": "GUAYTACAMA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001007010,
              "nombre": "MULALO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001007011,
              "nombre": "TANICUCHI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001007012,
              "nombre": "BELISARIO QUEVEDO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001008001,
              "nombre": "RIOBAMBA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001008002,
              "nombre": "ALAUSI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001008003,
              "nombre": "CHUNCHI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001008004,
              "nombre": "GUANO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001008005,
              "nombre": "CAJABAMBA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001008007,
              "nombre": "GUAMOTE",
              "trayecto": "TS"
            },
            {
              "codigo": 201001008008,
              "nombre": "COLTA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001008010,
              "nombre": "LICAN",
              "trayecto": "TP"
            },
            {
              "codigo": 201001009001,
              "nombre": "MACHALA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001009002,
              "nombre": "PASAJE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009003,
              "nombre": "PORTOVELO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009004,
              "nombre": "PIÑAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009005,
              "nombre": "ZARUMA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009006,
              "nombre": "ARENILLAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009007,
              "nombre": "HUAQUILLAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009008,
              "nombre": "EL GUABO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009009,
              "nombre": "SANTA ROSA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009010,
              "nombre": "PUERTO BOLIVAR",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009011,
              "nombre": "EL CAMBIO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009012,
              "nombre": "LA IBERIA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009013,
              "nombre": "PONCE ENRIQUEZ",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009014,
              "nombre": "BALSAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001009015,
              "nombre": "MARCABELI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010001,
              "nombre": "ESMERALDAS",
              "trayecto": "TP"
            },
            {
              "codigo": 201001010003,
              "nombre": "ATACAMES",
              "trayecto": "TP"
            },
            {
              "codigo": 201001010004,
              "nombre": "TONSUPA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001010005,
              "nombre": "SUA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001010006,
              "nombre": "SAME",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010007,
              "nombre": "MUISNE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010008,
              "nombre": "QUININDE",
              "trayecto": "TP"
            },
            {
              "codigo": 201001010009,
              "nombre": "PEDERNALES",
              "trayecto": "TP"
            },
            {
              "codigo": 201001010010,
              "nombre": "CUMANDA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010011,
              "nombre": "LA UNION",
              "trayecto": "TS"
            },
            {
              "codigo": 201001010012,
              "nombre": "TONCHIGUE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010013,
              "nombre": "VICHE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010014,
              "nombre": "EL SALTO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010015,
              "nombre": "LA PRADERA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010016,
              "nombre": "TACHINA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010017,
              "nombre": "LAS GOLONDRINAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001010018,
              "nombre": "MOMPICHE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001011001,
              "nombre": "ATUNTAQUI",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011002,
              "nombre": "OTAVALO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001011003,
              "nombre": "PIMAMPIRO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011004,
              "nombre": "URCUQUI",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011005,
              "nombre": "IBARRA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001011006,
              "nombre": "COTACACHI",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011007,
              "nombre": "SAN PEDRO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001011010,
              "nombre": "SAN PABLO IMBABURA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001011011,
              "nombre": "SAN ROQUE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001011012,
              "nombre": "GONZALEZ SUAREZ",
              "trayecto": "TE"
            },
            {
              "codigo": 201001011013,
              "nombre": "PEGUCHE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001011014,
              "nombre": "QUIROGA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011015,
              "nombre": "ADUANA(YAGUARCOCHA)",
              "trayecto": "TP"
            },
            {
              "codigo": 201001011016,
              "nombre": "ESPERANZA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001011017,
              "nombre": "ZULETA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001011018,
              "nombre": "CARANQUI",
              "trayecto": "TP"
            },
            {
              "codigo": 201001011019,
              "nombre": "YAGUARCOCHA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001011020,
              "nombre": "CHORLAVI",
              "trayecto": "TP"
            },
            {
              "codigo": 201001011021,
              "nombre": "ANDRADE MARIN",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011022,
              "nombre": "ANTONIO ANTE",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011023,
              "nombre": "CHALTURA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011024,
              "nombre": "LA MERCED",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011025,
              "nombre": "NATABUELA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011026,
              "nombre": "SAN JOSE",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011027,
              "nombre": "SAN LUIS",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011028,
              "nombre": "SANTA BERTHA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011029,
              "nombre": "TIERRA BLANCA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001011030,
              "nombre": "PERUGACHI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001012001,
              "nombre": "LOJA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001012002,
              "nombre": "CATAMAYO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001012003,
              "nombre": "CATARAMA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001012004,
              "nombre": "CARIAMANGA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001012005,
              "nombre": "CATACOCHA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001012007,
              "nombre": "VILCABAMBA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001012009,
              "nombre": "SARAGURO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001012010,
              "nombre": "GONZANAMA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001012011,
              "nombre": "CELICA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013001,
              "nombre": "BABAHOYO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001013002,
              "nombre": "QUEVEDO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001013003,
              "nombre": "VENTANAS",
              "trayecto": "TS"
            },
            {
              "codigo": 201001013004,
              "nombre": "VALENCIA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013005,
              "nombre": "BUENA FE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013006,
              "nombre": "VINCES",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013007,
              "nombre": "MOCACHE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013008,
              "nombre": "SAN JUAN",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013009,
              "nombre": "MONTALVO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001013010,
              "nombre": "PATRICIA PILAR",
              "trayecto": "TS"
            },
            {
              "codigo": 201001013012,
              "nombre": "PUEBLO VIEJO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013013,
              "nombre": "BABA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001013014,
              "nombre": "SAN CAMILO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013015,
              "nombre": "SAN CARLOS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013016,
              "nombre": "RICAURTE LOS RIOS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013017,
              "nombre": "ZAPOTILLO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013019,
              "nombre": "QUINSALOMA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001013020,
              "nombre": "TRES POSTES",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014001,
              "nombre": "MANTA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001014002,
              "nombre": "PORTOVIEJO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001014003,
              "nombre": "BAHIA DE CARAQUEZ",
              "trayecto": "TP"
            },
            {
              "codigo": 201001014004,
              "nombre": "CHONE",
              "trayecto": "TP"
            },
            {
              "codigo": 201001014005,
              "nombre": "EL CARMEN",
              "trayecto": "TP"
            },
            {
              "codigo": 201001014006,
              "nombre": "JIPIJAPA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001014007,
              "nombre": "PICHINCHA MANABI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014008,
              "nombre": "SANTA ANA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014009,
              "nombre": "JUNIN",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014010,
              "nombre": "CRUCITA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001014011,
              "nombre": "COLON",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014012,
              "nombre": "ROCAFUERTE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014013,
              "nombre": "JARAMIJO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014014,
              "nombre": "PAJAN",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014015,
              "nombre": "CHARAPOTO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014016,
              "nombre": "CALCETA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001014017,
              "nombre": "TOSAGUA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001014018,
              "nombre": "SAN VICENTE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014019,
              "nombre": "OLMEDO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014020,
              "nombre": "MONTECRISTI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014021,
              "nombre": "FLAVIO ALFARO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014022,
              "nombre": "PUERTO LOPEZ",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014023,
              "nombre": "BALLENITA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014024,
              "nombre": "JAMA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014026,
              "nombre": "TARQUI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014027,
              "nombre": "LEONIDAS PLAZA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014029,
              "nombre": "PUERTO CAYO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014030,
              "nombre": "CRUZITA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001014031,
              "nombre": "CALDERON DE PORTOVIEJO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014032,
              "nombre": "CANUTO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014033,
              "nombre": "ESTANCILLA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014034,
              "nombre": "SAN ANTONIO DE CHONE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014035,
              "nombre": "LA DELICIA KM. 29",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014036,
              "nombre": "ALAHUELA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014037,
              "nombre": "PICOAZA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014038,
              "nombre": "SAN PLACIDO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001014039,
              "nombre": "RIO CHICO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001015001,
              "nombre": "MACAS",
              "trayecto": "TP"
            },
            {
              "codigo": 201001015002,
              "nombre": "GUALAQUIZA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001015003,
              "nombre": "YANTZAZA",
              "trayecto": "TO"
            },
            {
              "codigo": 201001015004,
              "nombre": "MENDEZ",
              "trayecto": "TE"
            },
            {
              "codigo": 201001015005,
              "nombre": "GUANUJO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001015006,
              "nombre": "LIMON",
              "trayecto": "TS"
            },
            {
              "codigo": 201001016001,
              "nombre": "TENA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001016002,
              "nombre": "OÑA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001016003,
              "nombre": "ARCHIDONA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001016004,
              "nombre": "PTO. NAPO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001016005,
              "nombre": "MISAHUALLI",
              "trayecto": "TE"
            },
            {
              "codigo": 201001016006,
              "nombre": "AROSEMENA TOLA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017002,
              "nombre": "EL COCA",
              "trayecto": "TO"
            },
            {
              "codigo": 201001017003,
              "nombre": "LAGO AGRIO",
              "trayecto": "TO"
            },
            {
              "codigo": 201001017004,
              "nombre": "SHELL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017006,
              "nombre": "LA JOYA DE LOS SACHAS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017007,
              "nombre": "SUCUA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017008,
              "nombre": "ALAMOR",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017009,
              "nombre": "NUEVO ISRAEL",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017012,
              "nombre": "EL CHACO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017013,
              "nombre": "CASCALES",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017016,
              "nombre": "LORETO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001017017,
              "nombre": "LUMBAQUI",
              "trayecto": "TO"
            },
            {
              "codigo": 201001018001,
              "nombre": "PUYO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001018002,
              "nombre": "PALORA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001018003,
              "nombre": "COCHANCAY",
              "trayecto": "TE"
            },
            {
              "codigo": 201001018004,
              "nombre": "MERA",
              "trayecto": "TS"
            },
            {
              "codigo": 201001018005,
              "nombre": "SANTA CLARA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001019003,
              "nombre": "MACARA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001019004,
              "nombre": "PELILEO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001019005,
              "nombre": "CEVALLOS",
              "trayecto": "TS"
            },
            {
              "codigo": 201001019006,
              "nombre": "PILLARO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001019007,
              "nombre": "MOCHA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001019008,
              "nombre": "QUERO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001019009,
              "nombre": "TISALEO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001020001,
              "nombre": "PUERTO BAQUERIZO MORENO",
              "trayecto": "TP"
            },
            {
              "codigo": 201001020002,
              "nombre": "SANTA CRUZ",
              "trayecto": "TP"
            },
            {
              "codigo": 201001020003,
              "nombre": "SAN CRISTOBAL",
              "trayecto": "TP"
            },
            {
              "codigo": 201001020004,
              "nombre": "PUERTO AYORA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001020006,
              "nombre": "ISABELA",
              "trayecto": "TG"
            },
            {
              "codigo": 201001021001,
              "nombre": "ZAMORA",
              "trayecto": "TP"
            },
            {
              "codigo": 201001021003,
              "nombre": "TAMBILLO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001021006,
              "nombre": "CENTINELA DEL CONDOR",
              "trayecto": "TS"
            },
            {
              "codigo": 201001021007,
              "nombre": "CUMBARATZA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001022002,
              "nombre": "SHUSHUFINDI",
              "trayecto": "TO"
            },
            {
              "codigo": 201001022003,
              "nombre": "SUCUMBIOS",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023001,
              "nombre": "PUNTA CARNERO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023002,
              "nombre": "PUNTA BLANCA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023003,
              "nombre": "MONTAÑITA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023004,
              "nombre": "MAR BRAVO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023005,
              "nombre": "MUEY",
              "trayecto": "TS"
            },
            {
              "codigo": 201001023006,
              "nombre": "OLON",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023007,
              "nombre": "PUERTO SANTA ROSA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023008,
              "nombre": "CADEATE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023009,
              "nombre": "CAPAES",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023010,
              "nombre": "LIBERTADOR BOLIVAR",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023011,
              "nombre": "MANGLARALTO",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023012,
              "nombre": "MONTEVERDE",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023013,
              "nombre": "PALMAR",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023014,
              "nombre": "PROSPERIDAD",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023015,
              "nombre": "PUNTA BARANDUA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023016,
              "nombre": "VALDIVIA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001023017,
              "nombre": "SAN PABLO SANTA ELENA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001024001,
              "nombre": "PUERTO LIMON",
              "trayecto": "TS"
            },
            {
              "codigo": 201001024002,
              "nombre": "ALLURIQUIN",
              "trayecto": "TE"
            },
            {
              "codigo": 201001024003,
              "nombre": "SAN JACINTO DEL BUA",
              "trayecto": "TE"
            },
            {
              "codigo": 201001024004,
              "nombre": "KM 14-QUEVEDO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001024005,
              "nombre": "KM 24-QUEVEDO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001024006,
              "nombre": "KM 38.5-QUEVEDO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001024007,
              "nombre": "KM 41-QUEVEDO",
              "trayecto": "TS"
            },
            {
              "codigo": 201001024008,
              "nombre": "LUZ DE AMERICA",
              "trayecto": "TS"
            }
          ]';

    $country_id = 'country_5fe0e59bdfb97';
    $json_citys = json_decode($json_ciudades);
    foreach ($json_citys as $item) {
      $name = $item->nombre;
      $city_id = 'city_' . uniqid();
      $data = ['city_id' => $city_id, 'name' => $name, 'is_active' => 1, 'country_id' => $country_id];
      $response =  $this->country->create_city($country_id, $data);
    }
    exit;
  }
}
