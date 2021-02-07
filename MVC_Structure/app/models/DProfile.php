<?php

class DProfile {
	private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function info(){

    	$this->db->query('SELECT * FROM donorreg WHERE id=:id');
        $this->db->bind(':id',$_SESSION['user_id']);
    	return $this->db->resultSet();	
	
    }

    public function habit($data){
        $this->db->query('INSERT INTO history (user_id,Smoke,TakeDrugs) VALUES (:user_id,:Smoke,:TakeDrugs)');

        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':Smoke',$data['Smoke']);
        $this->db->bind(':TakeDrugs',$data['TakeDrugs']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}

?>