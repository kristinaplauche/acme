<?php if (isset($_SESSION['loggedin'])){
            if($_SESSION['clientData']['clientLevel']<2){
                header('Location: /acme/?action=home');}}?>

<?php $categories = getCategories();
$catList = "<select name='categoryId' id='catList-style' required> <option value=''>Please Select</option>";
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
   
        <form action="/acme/products/" method="POST">
           <h2><?php if(isset($prodInfo['invName']))
               { echo "Delete $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h2>
           <div class="fail-message"><p>Confirm Product Deletion. The delete is permanent.</p></div>
        <div>
                <label>Product Name *</label>
        </div>
        <div>
                <input name="invName" 
                       id="invName" 
                       type="text"
                       readonly
                        <?php if(isset($invName)){ echo "value='$invName'"; } 
                        elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; }?>  />
        </div>
        <div>
                <label >Product Description *</label>
        </div>
        <div>
                <textarea name="invDescription"
                          readonly
                          id="invDescription"><?php if(isset($invDescription)){ echo $invDescription; }
elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; }?></textarea>
        </div>
        
        
        <div>
            <label>&nbsp;</label>
            <input type="submit" 
                   name="submit" 
                   id="regbtn" 
                   value="Delete Product" 
                   class="register"/>
            <!-- Add the action name-value pair -->
            <input type="hidden" 
                   name="action" 
                   value="deleteProd"/>
            <input type="hidden" 
                   name="invId" 
                   value="<?php if(isset($prodInfo['invId']))
                       { echo $prodInfo['invId'];}?>">
        </div>
               
            </form>
</main>
    
        <?php include($_SERVER["DOCUMENT_ROOT"] . '/acme/common/footer.php');?>
        
  
