<?php
include_once("Resources/DBconnect.php");
include_once("Resources/Functions/function.php");

class Catagories{
	
	public $db;
 	public $nfsite;

 	public function __construct(){
 		$this->db = new DBconnect();
 		$this->nfsite = new NFwebsite();
 	}

	function addCategory(){
		if (empty($_POST['category'])) {
			$this->nfsite->HandleError("Category cannot be empty!!");
		}
		
		$cate = trim($_POST['category']);
		
		
		$sql= "INSERT INTO category SET catename = '$cate'";
		$result=$this->db->sql_Query($sql);
		
		if(!isset($_SESSION)){
			session_start();
		}
		
		if($result)
		{
			$this->nfsite->RedirectToURL('add_admin_post.php?id='.$_SESSION['userid']);
		}
		else{
			$this->nfsite->RedirectToURL('add_admin_post.php?id='.$_SESSION['userid']);
		}
	}

	function getCategories(){
				
		$sql = "SELECT * FROM category ORDER BY catename ASC";
		$result = $this->db->sql_Query($sql);
		
		$rows = array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$rows[] = $row;
		}
		
		return $rows;
	}

	

	function deleteCategories(){
			
		$categ = $_POST['category'];
		$sql = "DELETE FROM category WHERE cateId = '$categ'";
		$result = $this->db->sql_Query($sql);
		
		if(!isset($_SESSION)){
			session_start();
		}
		
		if($result)
		{
			$this->nfsite->RedirectToURL('add_admin_post.php?id='.$_SESSION['userid']);
		}
		else{
			$this->nfsite->RedirectToURL('add_admin_post.php?id='.$_SESSION['userid']);
		}
	
	}
	
}
?>