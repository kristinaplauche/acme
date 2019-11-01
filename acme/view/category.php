<!-- 
 * Delivers products list from a a specific category
 * There is a title element that needs to be dealt with
 -->

      <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>       
         
    <main>
     <h1><?php echo $type; ?> Products</h1>  
     <?php if(isset($message)){ echo $message; } ?>
     <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>
  
     
        </main>
   
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
    
    
    
    
            
    
   
            

