<?php

class Activelog_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)    {

        $this->db->insert('activelog', $data);
        return $this->db->insert_id();
    }

    function get_all_fecha($date){
        $this->db->like("creationdate",$date);
        $query = $this->db->get("activelog");
        return $query->result();
    }


    function get_by_id($id)
    {
        $this->db->where('log_id', $id);
        $query = $this->db->get('activelog');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('activelog');

        return ($get_as_row) ? $query->row() : $query->result();
    }
//
//    function update($id, $data)
//    {
//        $this->db->where('log_id', $id);
//        foreach ($data as $key => $value) {
//            $this->db->set($key, $value);
//        }
//        $this->db->update('activelog');
//        return $this->db->affected_rows();
//    }
//
//    function delete($id)
//    {
//        $this->db->where('log_id', $id);
//        $this->db->delete('activelog');
//        return $this->db->affected_rows();
//    }


 
    public function afterSave($array)
    {
            $log = new Activelog_model();
            $data_log = [
                'description'=>'Usuario ' . $this->session->userdata('user_id')
                                    . ' inserta ' . $array->model 
                                    . '[' . $array->idModel.'].',
                'action'=>'Inserta',
                'model'=>$array->model,
                'idModel'=>$array->idModel,
                'field'=>$array->field,
                'creationdate'=> date("Y-m-d H:i:s"),
                'userid'=>$this->session->userdata('user_id').'('.$this->session->userdata('email').')'
            ];
            $this->activelog->create($data_log);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
    }
    
    public function afterUpdate($array, $newattributes,$oldattributes)
    {   
       
        $newattributes = (array)$newattributes;
        $oldattributes = (array)$oldattributes;
       
            // compare old and new
            foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                } else {
                    $old = '';
                }
 
                if ($value != $old) {
                    $changes = $name . ' ('.$old.') => ('.$value.'), ';
 
                    $log=new Activelog_model();
                    $data_log = [
                        'description'=>'Usuario ' . $this->session->userdata('user_id')
                                            . ' modifica ' . $array->model 
                                            . '[' . $array->idModel.'] variando ['.$changes.']',
                        'action'=>'Modifica',
                        'model'=>$array->model,
                        'idModel'=>$array->idModel,
                        'field'=>$changes,
                        'creationdate'=> date("Y-m-d H:i:s"),
                        'userid'=>$this->session->userdata('user_id').'('.$this->session->userdata('email').')'
                    ];
                    $this->activelog->create($data_log);
                    //$this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
                }
            }
       
    }
 
    public function afterDelete($array)
    {
        $log = new Activelog_model();
            $data_log = [
                'description'=>'Usuario ' . $this->session->userdata('user_id')
                                    . ' elimina ' . $array->model 
                                    . '[' . $array->idModel.'].',
                'action'=>'Elimina',
                'model'=>$array->model,
                'idModel'=>$array->idModel,
                'field'=>$array->field,
                'creationdate'=> date("Y-m-d H:i:s"),
                'userid'=>$this->session->userdata('user_id').'('.$this->session->userdata('email').')'
            ];
            $this->activelog->create($data_log); 
    }
 
    public function afterFind($event)
    {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }


    
    


    //------------------------------------------------------------------------------------------------------------------------------------------
}

