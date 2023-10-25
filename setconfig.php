<?php
include 'netting/class.crud.php';
$crud= Crud::init();
if (!isset($_SESSION['admins']) && isset($_COOKIE['adminsLogin'])){
    echo "ok";
  $adminsLogin=json_decode($_COOKIE['adminsLogin']);
  $sonuc=Crud::adminsLogin($adminsLogin->admins_username,$adminsLogin->admins_pass,TRUE);
  if ($sonuc['status']){
      header("Location: admins.php");
      exit;
  }
}
if (!isset($_SESSION['admins']) && !isset($_COOKIE['adminsLogin'])){
    header("Location: login.php");
    exit;
}

?>
