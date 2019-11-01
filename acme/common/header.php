<!DOCTYPE html>

<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php if(isset($page_title)){echo $page_title . '|';} ?>Acme, Inc.</title>
    <meta name="author" content="Kristina Plauché">
    <meta name="description" content="Buy Acme Rockets">
    <!-- external style references in the proper cascading order -->
    <link href="https://fonts.googleapis.com/css?family=Patrick+Hand" rel="stylesheet">
    
    <!-- Google API font reference -->
    <link href="/acme/css/normalize.css" rel="stylesheet">
    <!-- normalize useragent/browser defaults -->
    <link href="/acme/css/styles.css" rel="stylesheet">
    <!-- default styles - all screen sizes -->

</head>
<body>
 <header>
<div class="header-wrap">
        <div class="logo">
            <img src="/acme/images/site/logo.gif" alt="ACME site logo">
        </div>
        <div class="my-account">
            <p><?php if(isset($_SESSION['loggedin'])){
                echo "<a href='/acme/accounts/?action=admin'>Welcome ";
 echo $_SESSION['clientData']['clientFirstname'];
 echo "</a>";
 }?></p>
            <img src="/acme/images/site/account.gif" alt="red folder icon">
       
       <?php
           if (isset($_SESSION['loggedin'])) {
               echo "<p><a href='/acme/accounts/?action=logout'> Log out</a></p>";
           } else {
               echo "<p><a href='/acme/accounts/?action=loginPage'> My Account</a></p>";
           }
           ?> 
        </div>
</div>
   
    </header>
   
