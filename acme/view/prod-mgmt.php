<?php if (isset($_SESSION['loggedin'])){
            if($_SESSION['clientData']['clientLevel']<2){
                header('Location: /acme/?action=home');}}?>
  
      <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
    

    <!-- site navigation use placeholder references -->
        
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>       
         
    <main>
        <?php if (isset($_SESSION['loggedin'])){
            if($_SESSION['clientData']['clientLevel']>1){
 echo "<p><a href='/acme/products/?action=new-cat'>Create a New Product Category</a></p> <p><a href='/acme/products/?action=new-prod'>Create a New Product</a></p>";

if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
echo $message;
}
echo $prodList;

 } else {
     header('Location: /acme/?action=home');
        }}?>
       
         
        </main>
   
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
<?php unset($_SESSION['message']); ?>
   
