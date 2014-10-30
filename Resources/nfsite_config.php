<?php
require_once("Resources/Functions/function.php");
require_once("Resources/UserActivation.php");
require_once("Resources/PostConfirmation.php");
require_once("Resources/Categories.php");

$nfsite = new NFwebsite();
$useract = new UserActivation();
$postcon = new PostConfirmation();
$cate = new Catagories();

$nfsite->SetRandomKey("&Qs38td92");
?>