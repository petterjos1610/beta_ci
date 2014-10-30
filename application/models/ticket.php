<?php
class Ticket extends my_model
{


    public function getTicketSubjects()
    {

        $result = $this->db->query("

SELECT ticketsubjects.*, usertypes.name FROM ticketsubjects inner join usertypes on ticketsubjects.userTypeId=usertypes.id ORDER BY TicketSubjects.id ASC LOCK IN SHARE MODE");
        return $result->result();


    }
}