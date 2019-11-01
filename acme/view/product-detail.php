

<!--Product Detail page -->

<?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>       
         
    <main>
    
     <?php if(isset($message)){ echo $message; } ?>
     <?php if(isset($productDetail)){ echo $productDetail; } ?>
   <?php //print_r($productDetail); ?>
 
        </main>
   
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
