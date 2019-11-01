 
 <!--Image Admin-->

 <?php if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
} ?>

<?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
    
    
        
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>       
         
    <main>
       <h2>Add New Product Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/acme/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem">Product</label><br>
 <?php echo $prodSelect; ?><br><br>
 <label>Upload Image:</label><br>
 <input id="invItem" class="fileupload" type="file" name="file1"><br>
 <input type="submit" id="regbtn" class="register" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
       
       <hr>
    <h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>   
       
        </main>
   
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
<?php unset($_SESSION['message']); ?>