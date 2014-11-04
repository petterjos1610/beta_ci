<?php
class Career extends my_model
{


    public function getCareers()
    {

        $result = $this->db->query("SELECT id,career,enabled FROM CareerTypes LOCK IN SHARE MODE");
        return $result->result();


    }

    public function getCareerById($id)
    {

       return $result = $this->getById('CareerTypes', 'id', $id);



    }
    function createCareer($career,$enabled) {

        $insert=array('career'=>$career,'enabled'=>$enabled);
        $career_id=$this->create('CareerTypes',$insert);
        if ($career_id>0) {

            return $career_id;
        }

    }

    function updateCareer($career,$enabled,$id) {

        $insert=array('career'=>$career,'enabled'=>$enabled);
        $career_id=$this->update('CareerTypes','id',$id,$insert);


            return $career_id;


    }
}