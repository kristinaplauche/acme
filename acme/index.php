<?php
/*Acme Root Controller*/
// Create or access a Session
 session_start();
// Get the database connection file
 require_once 'library/connections.php';
 //Get the functions file
  require_once 'library/functions.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';

 
 // Get the array of categories
	$categories = getCategories();

       //var_dump($categories);
	//exit;
    if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}    
 $invFeatured = filter_input(INPUT_POST, 'invFeatured', FILTER_VALIDATE_BOOLEAN);
$productFeatured2 = getFeaturedProduct($invFeatured);
$productFeatured = buildFeaturedProductDisplay($productFeatured2);

$action = filter_input(INPUT_POST, 'action');

 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
 case 'home':
  include 'view/home.php';
  break;
 
 default:
  include 'view/home.php';
}