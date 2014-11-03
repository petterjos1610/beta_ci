<?php
class StudentType extends my_model
{


    public function getStudentType()
    {

        $result = $this->db->query("SELECT id,name,enabled FROM StudentTypes ORDER BY name ASC LOCK IN SHARE MODE");
        return $result->result();


    }

    public function getStudentTypeById($id)
    {

       return $result = $this->getById('StudentTypes', 'id', $id);



    }
    function createStudentType($name,$enabled) {

        $insert=array('name'=>$name,'enabled'=>$enabled);
        $studentType_id=$this->create('StudentTypes',$insert);
        if ($studentType_id>0) {
            //logAction("CREATE_STUTYPE",$name.','.$enabled);

            return $studentType_id;
        }

    }

    function updateStudentType($name,$enabled,$id) {

        $insert=array('name'=>$name,'enabled'=>$enabled);
        $studentType_id=$this->update('StudentTypes','id',$id,$insert);


            return $studentType_id;


    }
}