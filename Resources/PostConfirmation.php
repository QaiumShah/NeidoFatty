<?php

include_once("Resources/DBconnect.php");
include_once("Resources/Functions/function.php");
 
 class PostConfirmation{

 	public $db;
 	public $nfsite;

 	public function __construct(){
 		$this->db = new DBconnect();
 		$this->nfsite = new NFwebsite();
 	}

 	public function addPost(){
		if(empty($_POST['titlepost'])){
			$this->nfsite->HandleError('Sorry title is empty.');
		}
		
		if(empty($_FILES['imagefile']['name']) && $_FILES['imagefile']['size'] > 0){
			$this->nfsite->HandleError('Please insert image.');
		}
		
		$posttitle = trim($_POST['titlepost']);
		$description = trim($_POST['description']);
		$source = trim($_POST['source']);
		$category = $_POST['category'];
		$uid = $_POST['submitted'];
		
		$image =  $_FILES['imagefile']['tmp_name'];
		$image_type = $_FILES['imagefile']['type'];
		$image_size = intval($_FILES['imagefile']['size']);
		
		$fp = fopen($image, 'rb');	
		$image_file= fread($fp, filesize($image));
		$image_file=addslashes($image_file);
		fclose($fp);	
		
		$sql = "INSERT INTO post (title, description, source, image_type, content, image_size, postdate, cateId, userId) 
					VALUES ('$posttitle', '$description', '$source', '$image_type', '$image_file', '$image_size', NOW(), '$category', '$uid')";
		$result= $this->db->sql_Query($sql);
		$post_Id = $this->db->lastInsertID();

		if(!empty($post_Id)){
			$sql1 = "INSERT INTO views (postId) VALUES($post_Id)";
			$result1 = $this->db->sql_Query($sql1);
		}
		
		if(!isset($_SESSION)){
			session_start();
		}

			if ($result) {
				if($_SESSION['admin']=='1'){
					$this->nfsite->RedirectToURL('add_admin_post.php?id='.$_SESSION['userid']);
				}
				elseif($_SESSION['admin']=='0'){
					$this->nfsite->RedirectToURL('add_user_post.php?id='.$_SESSION['userid']);
				}
			}
		
		$this->db->connection->close();
	}


	public function getPosts(){
		

        if (isset($_GET["page"])) { 
        	$page  = $_GET["page"]; 
        } else {
        	$page = 1; 
        } 
			$starting = ($page-1) * 5;
		
		$sql = "SELECT post.postId, post.title, post.description, post.source, post.image_type, post.content, post.image_size, post.postdate, category.catename, user.fullname FROM post LEFT JOIN user ON user.userId = post.userId LEFT JOIN category on category.cateId = post.cateId ORDER BY post.postId ASC LIMIT $starting, 5";
		$result= $this->db->sql_Query($sql);
		
		$rows = array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
			$rows[] = $row;
		}
		
		return $rows;
	}

	public function postNumber(){

        $sql ="SELECT COUNT(postId) FROM post";
        $result =  $this->db->sql_Query($sql); 
		$row = mysqli_fetch_row($result);
		$total_records = $row[0]; 
		$total_pages = ceil($total_records / 5);

		return $total_pages; 
	}
	
	public function getOnePost($pid){
		
		$sql = "SELECT post.postId, post.title, post.description, post.source, post.image_type, post.content, post.image_size, post.postdate, category.catename, user.fullname FROM post LEFT JOIN user ON user.userId = post.userId LEFT JOIN category on category.cateId = post.cateId WHERE post.postId = '$pid' LIMIT 1" ;
		$result=$this->db->sql_Query($sql);
		
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		return $row;

	}
	
	function getGroupCatPost($cid){
		$sql = "SELECT post.postId, post.title, post.description, post.source, post.content, post.postdate, category.catename, user.fullname FROM post LEFT JOIN user ON user.userId = post.userId LEFT JOIN category on category.cateId = post.cateId WHERE post.cateId = '$cid'";
		$result = $this->db->sql_Query($sql);

		$rows = array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
			$rows[] = $row;
		}
		
		return $rows;

	}

	public function getGroupPost(){
				
		$sql = "SELECT post.postId, post.title, post.description, post.source, post.image_type, post.content, post.image_size, post.postdate, category.catename, user.fullname FROM post LEFT JOIN user ON user.userId = post.userId LEFT JOIN category on category.cateId = post.cateId ";
		$result= $this->db->sql_Query($sql);
		
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		return $row;
	}

	public function countPost($pid){
		if(!empty($pid)){
			 $sql="UPDATE views SET viewcount = viewcount+1 WHERE postId = '$pid'";
			 $result = $this->db->sql_Query($sql);
			 return $this->getOnePost($pid);
		}

	}

	public function viewCountPost($pid){
		$sql="SELECT * FROM views LEFT Join post ON views.postId = post.postId WHERE views.postId = '$pid'";
		$result = $this->db->sql_Query($sql);

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}

	public function getPopularPost(){
		if (isset($_GET["page"])) { 
        	$page  = $_GET["page"]; 
        } else {
        	$page = 1; 
        } 
			$starting = ($page-1) * 5;

		$sql="SELECT views.postId, views.viewcount, post.postId, post.title, post.description, post.source, post.content, post.postdate, user.fullname 
				From views INNER JOIN post ON views.postId= post.postId
						   INNER JOIN user ON post.userId = user.userId
						   ORDER BY views.viewcount DESC LIMIT $starting, 5";
		$result = $this->db->sql_Query($sql);

		$rows = array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
			$rows[] = $row;
		}
		
		return $rows;
	}

	public function getPostByDates(){
		if (isset($_GET["page"])) { 
        	$page  = $_GET["page"]; 
        } else {
        	$page = 1; 
        } 
			$starting = ($page-1) * 5;

		$sql="SELECT views.postId, views.viewcount, post.postId, post.title, post.description, post.source, post.content, post.postdate, user.fullname 
				From views INNER JOIN post ON views.postId= post.postId
						   INNER JOIN user ON post.userId = user.userId
						   ORDER BY post.postdate DESC LIMIT $starting, 5";
		$result = $this->db->sql_Query($sql);

		$rows = array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			
			$rows[] = $row;
		}
		
		return $rows;
	}

	public function updatePost(){
	
	}

	function deletePost($postid){
		$sql="DELETE FROM post WHERE postId = '$postid'" or die(mysql_error());
		$result = $this->db->sql_Query($sql);
		if(!isset($_SESSION)){
			session_start();
		}
		$this->nfsite->RedirectToURL("admin_all_post.php?id=".$_SESSION['userid']);
	}
 }

?>