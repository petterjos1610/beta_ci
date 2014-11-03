<?php
class Ethnicity extends my_model
{


    public function getEthnicities()
    {

        $result = $this->db->query("SELECT id,code,ethnicity,enabled FROM Ethnicities ORDER BY id ASC");
        return $result->result();


    }

    public function getEthnicityById($id)
    {

       return $result = $this->getById('Ethnicities', 'id', $id);



    }
    function createEthnicity($code,$ethnicity,$enabled) {

        $insert=array('code'=>$code,'ethnicity'=>$ethnicity,'enabled'=>$enabled);
        $etnicity_id=$this->create('Ethnicities',$insert);
        if ($etnicity_id>0) {

            return $etnicity_id;
        }

    }

    function updateEthnicity($code,$ethnicity,$enabled,$id) {

        $insert=array('code'=>$code,'ethnicity'=>$ethnicity,'enabled'=>$enabled);
        $etnicity_id=$this->update('Ethnicities','id',$id,$insert);


            return $etnicity_id;


    }
}