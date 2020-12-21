<?php

class Mongodb_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function filter_avanzado($coleccion, $tuberia)
    {
        $mongo = new \MongoDB\Driver\Manager("mongodb://localhost:27017");
        $command = new MongoDB\Driver\Command([
            'aggregate' => $coleccion,
            'pipeline' => $tuberia,
            'cursor' => new stdClass,
        ]);

        $cursor = $mongo->executeCommand('ranic', $command);
        return (isset($cursor)) ? $cursor->toArray() : false;
    }


    //------------------------------------------------------------------------------------------------------------------------------------------
}
