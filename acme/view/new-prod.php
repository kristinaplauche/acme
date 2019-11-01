<?php if (isset($_SESSION['loggedin'])){
            if($_SESSION['clientData']['clientLevel']<2){
                header('Location: /acme/?action=home');}}?>

<?php $categories = getCategories();
$catList = "<select name='categoryId' id='catList-style' required> <option value=''>Please Select</option>";
foreach ($categories as $category) {
   if (isset($categoryId)) {
       if($category['categoryId'] == $categoryId){
           $catList .= "<option value='". $category['categoryId']."' selected>". $category['categoryName']."</option>"; 
       }
   }else {
   $catList .= "<option value='". $category['categoryId']."'>". $category['categoryName']."</option>";
   }
}
$catList .= "</select>";?><?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?>
    

    <!-- site navigation use placeholder references -->
    
        
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>        
   
    <main> 
        
        <?php
        if (isset($message)) {
            echo $message;
            }
            ?>
        <form action="/acme/products/index.php" method="POST">
           <h2>Create New Product</h2>
           <div class="fail-message"><p>* All fields are required</p></div>
        <div>
                <label>Product Name *</label>
        </div>
        <div>
                <input name="invName" 
                       id="invName" 
                       type="text" 
                       required
                           <?php if (isset($invName)) {
                echo "value='$invName'";} ?>  />
        </div>
        <div>
                <label >Product Description *</label>
        </div>
        <div>
                <textarea name="invDescription" 
                          required 
                          id="invDescription"><?php echo (isset($invDescription) ? $invDescription : ''); ?></textarea>
        </div>
        <div>
                <label >Product Image *</label>
        </div>
        <div>
                <input type="text" 
                       name="invImage" 
                       id="invImage" 
                       required 
                       placeholder="/acme/images/products/no-image.png"/>
        </div>
        <div>
                <label >Thumbnail Image *</label>
        </div>
        <div>
          <input type="text" 
                 name="invThumbnail" 
                 id="invThumbnail" 
                 required 
                 placeholder="/acme/images/products/no-image.png" />     
        </div>
        <div>
                <label >Price *</label>
        </div>
        <div>
                <input type="number" 
                       step="0.5" 
                       name="invPrice" 
                       id="invPrice" 
                       required
                       placeholder="eg: $5.00" 
                       <?php if (isset($invPrice)) {
                         echo "value='$invPrice'";} ?> />
        </div>
        <div>
                <label >Stock *</label>
        </div>
        <div>
                <input type="number" 
                       name="invStock" 
                       id="invStock" 
                       required
                       placeholder ="eg: 6 "
                       <?php if (isset($invStock)) {
                        echo "value='$invStock'";} ?> />
        </div>
        <div>
                <label >Size *</label>
        </div>
        <div>
                <input name="invSize" 
                       id="invSize" 
                       type="number" 
                       step="any" 
                       required
                        <?php if (isset($invSize)) {echo "value='$invSize'";} ?> />
        </div>
        <div>
                <label >Weight *</label>
        </div>
        <div>
                <input name="invWeight" 
                       id="invWeight" 
                       type="number"
                       required
                       step="any"
                        <?php if (isset($invWeight)) {echo "value='$invWeight'";} ?> />
        </div>
        <div>
                <label >Location *</label>
        </div>
        <div>
                <input name="invLocation" 
                       id="invLocation" 
                       type="text" 
                       required
                           <?php if (isset($invLocation)) {echo "value='$invLocation'";} ?> />
        </div>
        <div>
                <label>Category *</label>
        </div>
        <div>
                <?php echo $catList ?>
        </div>
        
        
        <div>
                <label>Vendor *</label>
        </div>
        <div>
                <input name="invVendor" 
                       id="invVendor" 
                       type="text" 
                       required
                           <?php if (isset($invVendor)) {echo "value='$invVendor'";} ?> />
        </div>
        <div>
                <label>Style *</label>
        </div>
        <div>
                <input name="invStyle" 
                       id="invStyle" 
                       type="text"
                       required
                        <?php if (isset($invStyle)) {echo "value='$invStyle'";} ?> />
        </div>
        
        <div>
            <label>&nbsp;</label>
            <input type="submit" 
                   name="submit" 
                   id="regbtn" 
                   value="New Product" 
                   class="register"/>
            <!-- Add the action name-value pair -->
            <input type="hidden" 
                   name="action" 
                   value="newProduct"/>
        </div>
               
            </form>
</main>
    
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
  
