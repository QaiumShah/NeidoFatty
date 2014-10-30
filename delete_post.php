<?php
include_once('resources/nfsite_config.php');

if(isset($_GET['id'])){
$pid=$_GET['id'];
$postcon->deletePost($pid);
exit;
}
?>