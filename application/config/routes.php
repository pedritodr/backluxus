<?php
defined('BASEPATH') or exit('No direct script access allowed');
function seo_url($text, $limit = 75)
{

    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    // trim
    $text = trim($text, '-');

    // lowercase
    $text = strtolower($text);

    $unwanted_array = array(
        'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
        'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
        'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'
    );
    $text = strtr($text, $unwanted_array);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    if (strlen($text) > 70) {
        $text = substr($text, 0, 70);
    }

    if (empty($text)) {
        //return 'n-a';
        return time();
    }

    return $text;
}
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['portada'] = 'front/index';
$route['login-register'] = 'front/registrar';
$route['shop'] = 'front/shop';
$route['perfil'] = 'front/perfil';
$route['about'] = 'front/about';
$route['contacto'] = 'front/contacto';
$route['cart-shopping'] = 'front/cart';
//$mongo = new \MongoDB\Driver\Manager("mongodb://localhost:27017");

/* $filter = ['$text' => ['$search' => "prueba"]];
$options = [];
$query = new MongoDB\Driver\Query($filter, $options);
$documents = $mongo->executeQuery('ranic.products', $query);

foreach ($documents as $item) {
    var_dump($item);
    echo "<hr>";
}
die();  */

/* $tuberia = [
    ['$match' => ['$text' => ['$search' => "prueba"]]],
    ['$sort' => ['score' => ['$meta' => "textScore"]]],
    ['$match' => ['is_active' => 1]],
    ['$match' => array('price' => array('$gte' => "0", '$lte' => '6'))],
    ['$limit' => 1],
    ['$skip' => 0],
];
$command = new MongoDB\Driver\Command([
    'aggregate' => 'products',
    'pipeline' => $tuberia,
    'cursor' => new stdClass,
]);

$cursor = $mongo->executeCommand('ranic', $command);

foreach ($cursor as $document) {
    var_dump($document);
    echo "<hr>";
}
die(); */
