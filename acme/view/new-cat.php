<?php if (isset($_SESSION['loggedin'])){
            if($_SESSION['clientData']['clientLevel']<2){
                header('Location: /acme/?action=home');}}?>

<?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?> 
    

    <!-- site navigation use placeholder references -->
  
      
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>  
    
    <main>  
        <?php
        if (isset($message)) {
        echo $message;
        }
        ?>
        <form action="/acme/products/index.php" method="POST">
           <h2>Create New Product Category</h2>
        <p>All fields are required</p>
        <div>
                <label>Category Name</label>
        </div>
        <div>
                <input name="categoryName" id="categoryName" type="text" <?php if (isset($categoryName)) {
                echo "value='$categoryName'";} ?> required>
        </div>
        
        <div>
            <label>&nbsp;</label>
            <input type="submit" name="submit" id="regbtn" value="Create Category" class="register">
            <!-- Add the action name-value pair -->
            <input type="hidden" name="action" value="create-category">
        </div>
               
            </form>
</main>
    
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
  