<?php

class NFwebsite{

	
	private $rand_key;
	public $error_message;	

	function __construct(){
		$this->rand_key = "0sBqsAb7ai";
		$this->error_message = "";
	}
	
	function paginate($reload, $page, $tpages) {
	    $adjacents = 2;
	    $prevlabel = "&lsaquo;";
	    $nextlabel = "&rsaquo;";
	    $out = "";
	    // previous
	    if ($page == 1) {
	        $out.= "<span>".$prevlabel."</span>\n";
	    } elseif ($page == 2) {
	        $out.="<li><a href=\"".$reload."\">".$prevlabel."</a>\n</li>";
	    } else {
	        $out.="<li><a href=\"".$reload."&amp;page=".($page - 1)."\">".$prevlabel."</a>\n</li>";
	    }
	    $pmin=($page>$adjacents)?($page - $adjacents):1;
	    $pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
	    for ($i = $pmin; $i <= $pmax; $i++) {
	        if ($i == $page) {
	            $out.= "<li class=\"active\"><a href=''>".$i."</a></li>\n";
	        } elseif ($i == 1) {
	            $out.= "<li><a href=\"".$reload."\">".$i."</a>\n</li>";
	        } else {
	            $out.= "<li><a href=\"".$reload. "&amp;page=".$i."\">".$i. "</a>\n</li>";
	        }
	    }
	    
	    if ($page<($tpages - $adjacents)) {
	        $out.= "<a style='font-size:11px' href=\"" . $reload."&amp;page=".$tpages."\">" .$tpages."</a>\n";
	    }
	    // next
	    if ($page < $tpages) {
	        $out.= "<li><a href=\"".$reload."&amp;page=".($page + 1)."\">".$nextlabel."</a>\n</li>";
	    } else {
	        $out.= "<span style='font-size:11px'>".$nextlabel."</span>\n";
	    }
	    $out.= "";
	    return $out;
	}
	/*helper functions*/
   
     

	function setErrorMessage($err){
		$this->error_message = $err;
		
	}

	 function GetErrorMessage()
    {
        return $this->error_message;
    }  

	function RedirectToURL($url){
		header("Location: $url");
		exit;
	}

	function SetRandomKey($key){
		$this->rand_key = $key;
	}

	function hashWithSalt($paswd){		
	    $encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->rand_key), $paswd, MCRYPT_MODE_CBC, md5(md5($this->rand_key))));
	    return $encoded;
    }

    

    function truncate($mytext, $link, $var, $id){
		$chars = 200;
		$mytext = substr($mytext,0,$chars);  
		$mytext = substr($mytext,0,strrpos($mytext,' '));  
		$mytext = $mytext."  <a href='$link?$var=$id'>read more...</a>";  
		return $mytext; 
	}
}

?>
