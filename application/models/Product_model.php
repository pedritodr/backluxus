<?php

class Product_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
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
    function create($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('product', $data);
        /*      $myfile         = '';
        $myfile     = fopen(APPPATH . "config/routes.php", "a+") or die("Unable to open file!");
        $txt        = '$route["' . strtolower($this->seo_url($data['name']))  . '-' . strtolower($this->seo_url($data['codigo'])) . '"] = "front/single_producto/' . $newId . '";' . PHP_EOL . '';
        fwrite($myfile, $txt);
        fclose($myfile); */
        return $newId;
    }
    function get_by_id($id)
    {
        $result = $this->mongo_db->where(['product_id' => $id])->get('product');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('product');
        } else {
            $result = $this->mongo_db->get('product');
        }
        if ($get_as_row) {
            if (count($result) > 0) {
                return (object) $result[0];
            } else {
                return false;
            }
        } else {
            return ($result);
        }
    }
    function update($id, $data)
    {
        $result = $this->mongo_db->where('product_id', $id)->set($data)->update('product');
        return $result;
    }
    function update_categories($id, $data)
    {
        $result = $this->mongo_db->where('categoria.category_id', $id)->set(['categoria' => $data])->updateAll('product');
        return $result;
    }
    function update_categories_type($id, $data)
    {
        $result = $this->mongo_db->where('categoria.type_box.box_id', $id)->set(['categoria.type_box' => $data])->updateAll('product');
        return $result;
    }
    function delete($id)
    {
        $result = $this->mongo_db->where(['product_id' => $id])->delete('product');
        return $result;
    }
    function get_all_fotos($conditions = [], $get_as_row = FALSE)
    {
        if (count($conditions) > 0) {
            $result = $this->mongo_db->where($conditions)->get('photos_products');
        } else {
            $result = $this->mongo_db->get('photos_products');
        }
        if ($get_as_row) {
            if (count($result) > 0) {
                return (object) $result[0];
            } else {
                return false;
            }
        } else {
            return ($result) ? array_to_object($result) : FALSE;
        }
    }
    function create_foto_producto($data)
    {
        $data['_id'] = $this->mongo_db->create_document_id();
        $newId = $this->mongo_db->insert('photos_products', $data);
        return $newId;
    }
    function delete_foto_producto($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->delete('photos_products');
        return $result;
    }
    function get_foto_producto_by_id($id)
    {
        $objecId = $this->mongo_db->create_document_id($id);
        $result = $this->mongo_db->where(['_id' => $objecId])->get('photos_products');
        return (count($result) > 0) ? (object) $result[0] : false;
    }
    function filter_avanzados($text, $category, $limit, $offset, $min, $max)
    {
        if ($text) {
            $this->mongo_db->where_text($text)->textScore('score', TRUE);
        }
        if ($category) {
            $this->mongo_db->where(['categoria.name' => $category, 'is_active' => 1]);
        } else {
            $this->mongo_db->where(['is_active' => 1]);
        }
        //  $result = $this->mongo_db->limit($limit)->offset($offset)->get("tienda");

        if ($min >= 0) {
            $this->mongo_db->where_gte('price', $min);
        }
        if ($max > 0) {
            $this->mongo_db->where_lte('price', $max);
        }
        if ($limit > 0 && $offset >= 0) {;
            $this->mongo_db->limit($limit)->offset($offset);
        }
        $result = $this->mongo_db->get('products');
        return $result;
    }
    function search($producto)
    {
        return $this->mongo_db->like('name', $producto)->get('product');
    }
}
