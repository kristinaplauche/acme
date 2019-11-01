<?php if (isset($_SESSION['loggedin'])){
            if($_SESSION['clientData']['clientLevel']<2){
                header('Location: /acme/?action=home');}}?>

<?php $categories = getCategories();
$catList = "<select name='categoryId' id='catList-style' required> <option value=''>Please Select</option>";
//foreach ($categories as $category) {
//   if (isset($categoryId)) {
//       if($category['categoryId'] == $categoryId){
//           $catList .= "<option value='". $category['categoryId']."' selected>". $category['categoryName']."</option>"; 
//       }
//   }else {
//   $catList .= "<option value='". $category['categoryId']."'>". $category['categoryName']."</option>";
//   }
//}
//$catList .= "</select>";
foreach ($categories as $category) {
 $catList .= "<option value='$category[categoryId]'";
  if(isset($catType)){
   if($category['categoryId'] === $catType){
   $catList .= ' selected ';
  }
 } elseif(isset($prodInfo['categoryId'])){
  if($category['categoryId'] === $prodInfo['categoryId']){
   $catList .= ' selected ';
  }
}
$catList .= ">$category[categoryName]</option>";
}
$catList .= '</select>';?><?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/header.php');?>
    

    <!-- site navigation use placeholder references -->
    
        
     <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/nav.php');?>        
   
    <main> 
        
        <?php
        if (isset($message)) {
            echo $message;
            }
            ?>
        <form action="/acme/products/index.php" method="POST">
           <h2><?php if(isset($prodInfo['invName']))
               { echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h2>
           <div class="fail-message"><p>* All fields are required</p></div>
        <div>
                <label>Product Name *</label>
        </div>
        <div>
                <input name="invName" 
                       id="invName" 
                       type="text" 
                       required
                        <?php if(isset($invName)){ echo "value='$invName'"; } 
                        elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>  />
        </div>
        <div>
                <label >Product Description *</label>
        </div>
        <div>
                <textarea name="invDescription" 
                          required 
                          id="invDescription"><?php if(isset($invDescription)){ echo $invDescription; }
elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?></textarea>
        </div>
        <div>
                <label >Product Image *</label>
        </div>
        <div>
                <input type="text" 
                       name="invImage" 
                       id="invImage" 
                       required <?php if(isset($invImage)){ echo "value='$invImage'"; } 
                        elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; }?>
                       />
        </div>
        <div>
                <label >Thumbnail Image *</label>
        </div>
        <div>
          <input type="text" 
                 name="invThumbnail" 
                 id="invThumbnail" 
                 required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } 
                        elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; }?>
                  />     
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
                       <?php if(isset($invPrice)){ echo "value='$invPrice'"; } 
                       elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; }?> />
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
                       <?php if(isset($invStock)){ echo "value='$invStock'"; } 
                       elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; }?> />
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
                        <?php if(isset($invSize)){ echo "value='$invSize'"; } 
                       elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; }?> />
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
                        <?php if(isset($invWeight)){ echo "value='$invWeight'"; } 
                       elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; }?> />
        </div>
        <div>
                <label >Location *</label>
        </div>
        <div>
                <input name="invLocation" 
                       id="invLocation" 
                       type="text" 
                       required
                         <?php if(isset($invLocation)){ echo "value='$invLocation'"; } 
                       elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; }?> />
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
                          <?php if(isset($invVendor)){ echo "value='$invVendor'"; } 
                       elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; }?> />
        </div>
        <div>
                <label>Style *</label>
        </div>
        <div>
                <input name="invStyle" 
                       id="invStyle" 
                       type="text"
                       required
                        <?php if(isset($invStyle)){ echo "value='$invStyle'"; } 
                       elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; }?> />
        </div>
        
        <div>
            <label>&nbsp;</label>
            <input type="submit" 
                   name="submit" 
                   id="regbtn" 
                   value="Update Product" 
                   class="register"/>
            <!-- Add the action name-value pair -->
            <input type="hidden" 
                   name="action" 
                   value="updateProd"/>
            <input type="hidden" 
                   name="invId" 
                   value="<?php if(isset($prodInfo['invId']))
                       { echo $prodInfo['invId'];} 
                       elseif(isset($invId)){ echo $invId; } ?>">
        </div>
               
            </form>
</main>
    
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
  
