<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Handle common image manipulation using the CI image_lib class.
 *
 * @category   Webcoding.CMS
 * @package    Webcoding_Library
 * @name Images .php
 * @version 1.0
 * @author Jarolewski Piotr
 * @copyright Webcoding Jarolewski Piotr
 * @created: 13.01.2011
 * @buf fixed: Ernesto Redonet Herrera
 */
class Images
{

    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        //esta linea estaba en la funcion resize
        $this->CI->load->library('image_lib');
    }

    /**
     * Resize Images and Crop width and height
     *
     * @param $oldFile Full path and filename of original image
     * @param $newFile The full destination path and filename
     * @param $width The new width new image
     * @param $height The new height new image
     * @return void
     */
    public function resize($oldFile, $newFile, $width, $height)
    {
        /*
         *    Resie image
         */

        $o_size = $this->_get_size($oldFile);

        $master_dim = ($o_size['width'] - $width < $o_size['height'] - $height ? 'width' : 'height');

        $perc = max((100 * $width) / $o_size['width'], (100 * $height) / $o_size['height']);

        $perc = round($perc, 0);

        $w_d = round(($perc * $o_size['width']) / 100, 0);
        $h_d = round(($perc * $o_size['height']) / 100, 0);

        $config['image_library'] = 'gd2';
        $config['source_image'] = $oldFile;
        $config['new_image'] = $newFile;
        $config['maintain_ratio'] = TRUE;
        $config['master_dim'] = $master_dim;
        $config['width'] = $w_d + 1;
        $config['height'] = $h_d + 1;


        //agregar la linea initialize
        //asi no da error streaming cuando se redimensiona
        //una misma imagen multiples veces
        $this->CI->image_lib->initialize($config);

        $this->CI->image_lib->resize();

        $size = $this->_get_size($newFile);

        unset($config); // clear $config

        /*
         *    Crop image  in weight, height
         */

        $config['image_library'] = 'gd2';
        $config['source_image'] = $newFile;
        $config['new_image'] = $newFile;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = $width;
        $config['height'] = $height;
        $config['y_axis'] = round(($size['height'] - $height) / 2);
        $config['x_axis'] = 0;

        $this->CI->image_lib->clear();

        $this->CI->image_lib->initialize($config);
        if (!$this->CI->image_lib->crop()) {
            echo $this->CI->image_lib->display_errors();
        }
    }

    private function _get_size($image)
    {
        $img = getimagesize($image);
        return Array('width' => $img['0'], 'height' => $img['1']);
    }

}
