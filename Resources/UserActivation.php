<?php
include_once("Resources/Functions/function.php");
include_once("Resources/DBconnect.php");
include_once("Resources/Cookie.php");
class UserActivation {

	public $username;
	private $email;
	private $pass;
	private $cookie;
	public $db;
	public $nfsite;


	public function __construct($user=null, $Email=null, $passwd=null){
		$this->username = $user;
		$this->email = $Email;
		$this->pass = $passwd;
		$this->db = new DBconnect;
		$this->nfsite = new NFwebsite;
		$this->cookie = new Cookie;
	}

	public function Registration(){
		$error = array();
		if (empty($_POST['fname'])) {
			$error[]="Please Enter your name";
		}
		else{
			$this->username = $this->db->cleanText($_POST['fname']);
		}

		if (empty($_POST['email'])) {
			$error[]="Please Enter your Email";
		}
		elseif (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
			$this->email=$_POST['email'];
		}
		else{
			$error[]="Your email address is not valid";
		}

		if (empty($_POST['passwd'])) {
			$error[]="Please Enter your Password";
		}else{
			$this->pass = $_POST['passwd'];
			$this->pass = $this->nfsite->hashWithSalt($this->pass);
		}

		if (empty($error)) {
			if ($this->emailVerification($this->email) == true){
				$activation = md5(uniqid(rand(), true));
				$sql = "INSERT INTO user(fullname,email, password, Activation ) VALUES ('$this->username', '$this->email', '$this->pass', '$activation')";
				$result= $this->db->sql_Query($sql);

				if ($this->db->changeInDatabase()) {
					$message="To activate your account, please click on this link:\n\n";
					$message.=WEBSITE_URL.'/activate.php?email='.urlencode($this->email)."&key=$activation";
					mail($this->email,'Registration confirmation', $message,'From:'.EMAIL);
					echo 'Thank you for registrating! A confirmation email has been sent to '.$this->email.
						'. Please click on the Activation link to Activate your account. :) ';
				}

				else{
					echo 'Oops! You could not be registered due to a system error. We apologize for any inconvience.';
				}
			}
			else{
				echo'This email address has already been registered.';
			}
		}
		else{
			echo'<ol>';
			foreach ($error as $key => $values) {
				echo'<li>'.$values.'</li>';
			}
			echo'</ol>';
		}
	}

	public function emailVerification($em){
		$verifyEmail = "SELECT * FROM user WHERE email = '$em' LIMIT 1";
		$result=$this->db->sql_Query($verifyEmail);

		if($this->db->numberOfRows($result)){ //if no email exist
			return true;
		}
		return false;
	}

	public function resetConfirmation(){		

		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
			
			$this->email=$_POST['email'];
			$activation = md5(uniqid(rand(), true));
			
			$sql = "UPDATE user SET Activation ='$activation' WHERE email='$this->email'";
			$result= $this->db->sql_Query($sql);
			
			if ($this->db->changeInDatabase()) {
  				$message="To reset your password, please click on this link:\n\n";
				$message.=WEBSITE_URL.'/resetpassword.php?email='.urlencode($this->email)."&key=$activation";
				mail($this->email,'Registration confirmation', $message,'From:'.EMAIL);
				echo 'Thank you for your time! A reset email has been sent to '.$this->email.
					'. Please click on the link to reset your password. :) ';
			}
			else{
				echo 'Oops! Your request could not be processed due to a system error. We apologize for any inconvience.';
			}
		}	
		
		else{
			$error="Your email address is not valid";
		}	
			
	}

	public function emailActivation($em, $key){
		$sql = "UPDATE user SET Activation = NULL WHERE email = '$em' AND Activation = '$key' LIMIT 1";
		$result = $this->db->sql_Query($sql);
		if($this->db->changeInDatabase()){
			return true;
		}
		return false;

	}

	public function changePassword($newpaswd, $em){
		$this->pass = $newpaswd;
		$this->email = $this->db->cleanText($em);
		$pwdmd5 = $this->nfsite->hashWithSalt($this->pass);
        if($this->email && $pwdmd5){
        	$qry = "UPDATE user SET password = '$pwdmd5' WHERE email = '$this->email'";
        	$result = $this->db->sql_Query($qry);
        	if ($this->db->changeInDatabase()) {
        		$this->nfsite->RedirectToURL('passwordchange.php'); 
        	}
        	else echo"sorry there is some technical error in the page. Please contact the system administrator. Thank you!";
        }	
	}

	
	public function UserLogin(){


		$this->email= $this->db->cleanText($_POST['email']);
		$this->pass = $_POST['password'];
		$rememberme = $_POST['remember'];

		if(!isset($_SESSION)){
			session_start();
		}

        $pwdmd5 = $this->nfsite->hashWithSalt($this->pass);
        if($this->email && $pwdmd5){
	        $qry = "SELECT userId, fullname, admin FROM user WHERE email='$this->email' and password='$pwdmd5' LIMIT 1";
	        $result = $this->db->sql_Query($qry);

			$count = 0;
			$count = mysqli_num_rows($result);
	        if($count == 1)
	        {
	        	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);				
				if($rememberme =="on"){
					$this->cookie->set('username', $this->email, 7200 );
					$_SESSION['loggedIn'] = true;
					$_SESSION['username'] = $row['fullname'];					
					$_SESSION['admin'] = $row['admin'];
					$_SESSION['userid'] = $row['userId'];
				}
				elseif ($rememberme == "") {						
					$_SESSION['loggedIn'] = true;
					$_SESSION['username'] = $row['fullname'];
					$_SESSION['admin'] = $row['admin'];
					$_SESSION['userid'] = $row['userId'];
				}
				$this->nfsite->RedirectToURL("admin_index.php?page=1");							
			}
			else{
					$_SESSION['loggedIn']= false;
					$this->cookie->remove('username');
					$this->nfsite->RedirectToURL("login.php?msg=unsuccessfulLogin");
			}
		}	
    }

    public function check_Login(){
		if(isset($_SESSION['username']) || isset($_COOKIE['username'])){
			$loggedIn = True;
			return $loggedIn;
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
    	$this->cookie->remove('username');
    	$this->nfsite->RedirectToURL('index.php');
    }
}

?>