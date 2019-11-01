<?php
/* Accounts Controller */
// Create or access a Session
 session_start();
 
// Get the database connection file
 require_once '../library/connections.php';
 // Get the functions library
 require_once '../library/functions.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the accounts model
 require_once '../model/accounts-model.php';
 

 
 // Get the array of categories
	$categories = getCategories();

       //var_dump($categories);
	//exit;
       
       
// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
 $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}
 
 //get the action from our POST request
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
     //get the action from our GET request if our POST is null
  $action = filter_input(INPUT_GET, 'action');
  //set default action for controller
  if ($action == NULL) {
      $action = 'loginPage';
  }
 }

 switch ($action){
     
  // #### go to login page
 case 'loginPage':
  include '../view/login.php';
  break;

//### go to registration page
case 'registration':
  include '../view/registration.php';
  break;

//### register user
case 'register':
 // Filter and store the data
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname',FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail',FILTER_SANITIZE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_STRING);
$clientEmail = checkEmail($clientEmail);
$checkPassword = checkPassword($clientPassword);

// Check for existing email address in the table

$existingEmail = checkExistingEmail($clientEmail);

if($existingEmail){
 $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
 include '../view/login.php';
 exit;
}


// Check for missing data
if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
 $message = '<div class="fail-message"><p>*Please provide information for all empty form fields.</p></div>';
 include '../view/registration.php';
 exit; 
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
// Send the data to the model
$regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

// Check and report the result
if($regOutcome === 1){
    setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
 $message = "<div class='success-message'><p>Thanks for registering $clientFirstname . Please use your email and password to login.</p></div>";
 //include '../view/login.php';
 header('Location: /acme/accounts/?action=login');
 exit;
} else {
 $message = "<div class='fail-message'><p>Sorry $clientFirstname, but the registration failed. Please try again.</p></div>";
 include '../view/registration.php';
 exit;
}

  include '../view/registration.php';
  break;
 
  
 //### log in user
case 'login_user':
$clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
$clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    
$clientEmail = checkEmail($clientEmail);
$passwordCheck = checkPassword($clientPassword);

// Run basic checks, return if errors
if (empty($clientEmail) || empty($passwordCheck)) {
 $message = '<p class="fail-message">Please provide a valid email address and password.</p>';
 include '../view/login.php';
 exit;
}
  
    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
      $message = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    include '../view/admin.php';
    exit;
 
 break;
 
 //###log out user
 case 'logout':
       session_destroy();
       include '../index.php';
       break;
   
  //### direct to admin page
 case 'admin':
     include '../view/admin.php';
     break;
 
 //### direct to account-update page
 case 'client-update':
     include '../view/client-update.php';
     break;
 
 //### update account
 
 case 'updateAccount':
 // Filter and store the data
$clientFirstname = filter_input(INPUT_POST, 'clientFirstname',FILTER_SANITIZE_STRING);
$clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
$clientEmail = filter_input(INPUT_POST, 'clientEmail',FILTER_SANITIZE_EMAIL);
$clientId = filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT);
//$clientEmail = checkEmail($clientEmail);
//
//// Check for existing email address in the table
//
//$existingEmail = checkExistingEmail($clientEmail);
//
//if($existingEmail){
// $message = '<p class="notice">That email address already exists. Please try again.</p>';
// include '../view/client-update.php';
// exit;
//}


// Check for missing data
if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
 $message = '<div class="fail-message"><p>*Please provide information for all empty form fields.</p></div>';
 include '../view/client-update.php';
 exit; 
}
// Send the data to the model
$accountResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
// Check and report the result
if($accountResult === 1){
 $message = "<div class='success-message'><p> $clientFirstname your information was updated.</p></div>";
$clientData = getClient($clientEmail);
array_pop($clientData);
$_SESSION['clientData']=$clientData;
        //array('clientFirstname' =>$clientFirstname, 'clientLastname' =>$clientLastname, 'clientEmail'=>$clientEmail, 'clientId'=>$clientId);
    // Store the array into the session
    //$_SESSION['clientData'] = $clientData;
 include '../view/admin.php';
 //header('Location: /acme/accounts/?action=login');
 exit;
} else {
 $message = "<div class='fail-message'><p>Sorry $clientFirstname, but the information could not be updated. Please try again.</p></div>";
 include '../view/client-update.php';
 exit;
}
##### change password
case 'updatePassword':
 // Filter and store the data
$clientPassword = filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_STRING);
$clientId = filter_input(INPUT_POST, 'clientId',FILTER_SANITIZE_NUMBER_INT);
$checkPassword = checkPassword($clientPassword);

// Check for existing email address in the table

// Check for missing data
if(empty($clientPassword)){
 $message = '<div class="fail-message"><p>*Please enter a password.</p></div>';
 include '../view/client-update.php';
 exit; 
}

// Hash the checked password
$hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
// Send the data to the model
$updatePassword = updatePassword($hashedPassword, $clientId);

// Check and report the result
if($updatePassword){
 $message = "<div class='success-message'><p>Password updated.</p></div>";
 include '../view/admin.php';
 exit;
} else {
 $message = "<div class='fail-message'><p>Sorry, password not updatedPlease try again.</p></div>";
  include '../view/client-update.php';
 exit;
}

  break;

 
 //### default statement
 default:
   
     include '../view/login.php';
   break;
}