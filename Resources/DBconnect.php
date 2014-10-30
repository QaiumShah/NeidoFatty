<?php

class DBconnect{
	
	public $connection = null;

	public function __construct(){
		
		include_once("Resources/DBconfig.php");

		$this->connection = new mysqli(DB_HOST,DB_USER, DB_PASSWORD, DB_NAME);

		if($this->connection->connect_errno){
			echo "Error MySqli: ("&nbsp.$this->connection->connect_errno.")".$this->connection->connect_error;
			exit();
		}

		$this->connection->set_charset("utf8");
	}	

	public function __destruct() {
   		$this->db_Close();
 	}
 

    public function sql_Query($qry) {
        $result = $this->connection->query($qry);
        return $result;
    }
 

    public function sql_Multi_Queries($qry) {
        $result = $this->connection->multi_query($qry);
        return $result;
    }
 

    public function db_Close() {
        $this->connection->close();
    }
 
    public function cleanText($text) {
	    $text = trim($text);
	    $text = stripslashes($text);
        return $this->connection->real_escape_string($text);
    }
 
    public function lastInsertID() {
        return $this->connection->insert_id;
    }
 
	public function totalCount($fieldname, $tablename, $where = "") 
	{
	$q = "SELECT count(".$fieldname.") FROM "
	. $tablename . " " . $where;
	         
	$result = $this->connection->query($q);
	$count = 0;
	if ($result) {
	    while ($row = mysqli_fetch_array($result)) {
	    $count = $row[0];
	   }
	  }
	  return $count;
	}
}

?>