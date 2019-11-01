<!-- 
 Admin View-->
<?php
setcookie('firstname', "", strtotime('-1 year'), '/');
?>
<?php
if (!$_SESSION['loggedin']) {
   header('Location: /acme/?action=home');
}
?>
<?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
    

    <!-- site navigation use placeholder references -->
   
        
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>       
      
    <main>
        <h1><?php if($_SESSION['loggedin']){
 echo $_SESSION['clientData']['clientFirstname'];
 }?> <?php if($_SESSION['loggedin']){
 echo $_SESSION['clientData']['clientLastname'];
 echo ", you are logged in.";
 }?></h1>
       
        <?php
        if (isset($message)) {
            echo $message;}?>
        
        <ul class="admin-list">
        <li><strong>First name:</strong> <?php if($_SESSION['loggedin']){
 echo $_SESSION['clientData']['clientFirstname'];
 }?></li>
        <li><strong>Last name:</strong> <?php if($_SESSION['loggedin']){
 echo $_SESSION['clientData']['clientLastname'];
 }?></li>
        <li><strong>Email:</strong> <?php if($_SESSION['loggedin']){
 echo $_SESSION['clientData']['clientEmail'];
 }?></li>
        </ul> 
        
       <!--test code
    //<?php
//if (isset($message)) {
// echo $message;
//} if (isset($clientList)) {
// echo $clientList;}?>
        //<?php echo $client; ?>
        //<?php $clientInfo = getClientInfo($clientEmail)?> -->
      
    <?php if($_SESSION['loggedin']){ echo "<p><a href='/acme/accounts/?action=client-update'>Update Account Information.</a></p>";}?>
        
        <section>
        <?php if($_SESSION['clientData']['clientLevel']>1){
 echo "<h2>Manage Products</h2><p>Update or delete products by clicking the link below.</p> <p><a href='/acme/products/index.php'>Product Management</a></p>";
 }?>
      </section>
       
       <p><a href='/acme/uploads/index.php'>Image Management</a></p>
        </main>
   
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
