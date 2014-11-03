<?php
class Religion extends my_model
{


    public function getReligions()
    {

        $result = $this->db->query("SELECT id,code,religion,enabled FROM Religions ORDER BY religion ASC LOCK IN SHARE MODE");
        return $result->result();


    }

    public function getReligionById($id)
    {

       return $result = $this->getById('Religions', 'id', $id);



    }
    function createReligion($code,$religion,$enabled) {

        $insert=array('code'=>$code,'religion'=>$religion,'enabled'=>$enabled);
        $religion_id=$this->create('Religions',$insert);
        if ($religion_id>0) {

            return $religion_id;
        }

    }

    function updateReligion($code,$religion,$enabled,$id) {

        $insert=array('code'=>$code,'religion'=>$religion,'enabled'=>$enabled);
        $religion_id=$this->update('Religions','id',$id,$insert);


            return $religion_id;


    }
}