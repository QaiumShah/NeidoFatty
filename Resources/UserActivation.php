<?php
include_once("Resources/Functions/function.php");
include_once("Resources/DBconnect.php");
class UserActivation {
	
	public $username;
	private $email;
	private $pass;
	public $db;
	public $nfsite;
	

	public function __construct($user=null, $Email=null, $passwd=null){
		$this->username = $user;
		$this->email = $Email;
		$this->pass = $passwd;		
		$this->db = new DBconnect;
		$this->nfsite = new NFwebsite;
	}

	public function Registration(){
		$this->username = $this->db->cleanText($_POST['fname']);
		$this->email=$this->db->cleanText($_POST['email']);
		$this->pass = $_POST['passwd'];
		$this->pass = $this->nfsite->hashWithSalt($this->pass);

			
		$sql = "INSERT INTO user(fullname,email, password) VALUES ('$this->username', '$this->email', '$this->pass')";
		$result= $this->db->sql_Query($sql);
			
		if($result){
			$this->nfsite->RedirectToURL('login.php');
		}		
	}


	public function UserLogin($em, $password){
		

		$this->email= $this->db->cleanText($em);
		$this->pass = $password;
		
		
		if(!isset($_SESSION)){
			session_start();
		}
		
        $pwdmd5 = $this->nfsite->hashWithSalt($this->pass);
		
        $qry = "SELECT userId, fullname, admin FROM user WHERE email='$this->email' and password='$pwdmd5' LIMIT 1";        
        $result = $this->db->sql_Query($qry);
   
		$count = 0;
		$count = mysqli_num_rows($result);
        if($count == 1)
        {
        	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$_SESSION['loggedIn'] = true;
			$_SESSION['username'] = $row['fullname'];
			$_SESSION['userid']=$row['userId'];
			$_SESSION['admin'] = $row['admin'];

			$this->nfsite->RedirectToURL("admin_index.php?page=1");
		}
		else{
				$_SESSION['loggedIn']= false;
				$this->nfsite->RedirectToURL("login.php?msg=unsuccessfulLogin");
		}	
    }	

    public function getUserInfo(){  	
    		
		$sql = "SELECT userId, fullname, email, admin FROM user ORDER BY userId ASC";
		$result=$this->db->sql_Query($sql);
		
		$rows = array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$rows[] = $row;
		}
		
		return $rows;
		}

	public function getUserName(){
		return $_SESSION['username'];
	}	

	public function logout(){
    	session_start();
    	session_destroy();
    	$this->nfsite->RedirectToURL('index.php');
    }
}

?>