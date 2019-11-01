<?php

/*
 * Products Controller
 */

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the functions file
require_once '../library/functions.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model
require_once '../model/products-model.php';


// Get the array of categories
$categories = getCategories();

//var_dump($categories);
//exit;
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        include '../view/login.php';
        break;

//### directs to new category page
    case 'new-cat':
        include '../view/new-cat.php';
        break;

//#### creates new category
    case 'create-category':
        // Filter and store the data
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        // Check for missing data
        if (empty($categoryName)) {
            $message = '<div class="fail-message"><p>*Please provide information for all empty form fields.</p></div>';
            include '../view/new-cat.php';
            exit;
        }
// Send the data to the model
        $regOutcome = createCategory($categoryName);

// Check and report the result
        if ($regOutcome === 1) {
            header('Location: /acme/products/index.php');
            //$message = "<p>You created $categoryName. Good job.</p>";
            include '../view/new-cat.php';
            exit;
        } else {
            $message = `<div class="fail-message"><p>Sorry but the category was not created. Please try again.</p></div>`;
            include '../view/new-cat.php';
            exit;
        } break;


    ///### directs to new product page
    case 'new-prod':
        include '../view/new-prod.php';
        break;


/// #### creates new product
    case 'newProduct':
        // Filter and store the data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

// Check for missing data
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
            $message = '<div class="fail-message"><p>*Please provide information for all empty form fields.</p></div>';
            include '../view/new-prod.php';
            exit;
        }
// Send the data to the model
        $regOutcome = createProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle);

// Check and report the result
        if ($regOutcome === 1) {
            $message = '<div class="success-message"><p>You created ' . $invName . '. Good job.</p></div>';
            include '../view/new-prod.php';
            exit;
        } else {
            $message = '<div class="fail-message"><p>Sorry but the product was not created. Please try again.</p></div>';
            include '../view/new-prod.php';
            exit;
        } break;




// ####gets product info for update
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }

        if (isset($prodInfo['invName'])) {
            $page_title = "Modify $prodInfo[invName]";
        } elseif (isset($invName)) {
            $page_title = "$invName";
        }
        include '../view/prod-update.php';
        exit;

        break;


// updates product
    case 'updateProd':
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

// Check for missing data
        if (empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation) || empty($categoryId) || empty($invVendor) || empty($invStyle)) {
            $message = '<div class="fail-message"><p>*Please complete all information for the item!</p></div>';
            include '../view/prod-update.php';
            exit;
        }
// Send the data to the model
        $updateResult = updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $invId);

        if ($updateResult) {
            $message = "<div class='success-message'><p>Congratulations, $invName was successfully updated.</p></div>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
// $message = '<div class="fail-message"><p>Error. The product was not updated. Please try again.</p></div>';
// include '../view/prod-update.php';
            $message = "<div class='fail-message'><p>Error. $invName was not updated.</p></div>";
            include '../view/prod-update.php';
            exit;
        } break;

// gets product info for delete
    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }

        if (isset($prodInfo['invName'])) {
            $page_title = "Delete $prodInfo[invName]";
        } elseif (isset($invName)) {
            $page_title = $invName;
        }
        include '../view/prod-delete.php';
        exit;

        break;

    // deletes product
    case 'deleteProd';
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

// Send the data to the model
        $deleteResult = deleteProduct($invId);

        if ($deleteResult) {
            $message = "<div class='success-message'><p>Congratulations, $invName was successfully deleted.</p></div>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<div class='fail-message'><p>Error. $invName was not deleted.</p></div>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } break;

/// ####### Category for Nav URL

    case 'category':
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);
        }
        include '../view/category.php';
        break;

    /// ###### retrieve product information in order to deliver it to a product detail view.

    case 'product':
        $inventoryId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
        $productDetail = getProductById($inventoryId);

        if (!count($productDetail)) {
            $message = "<p class='notice'>Sorry, no product could be found.</p>";
            $page_title = "No Product Found";
        } else {
            $page_title = $productDetail['invName'];
            $productDetail = buildProductDetail($productDetail);
        }

        include '../view/product-detail.php';
        break;

    /// ###### featured status functionality ##########
    case 'feature':
$invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        //check if invId is empty . It's working.
        if (empty($invId)){
           $_SESSION['message']='<p class="notice">InvId '.$invId. ' is not valid. Please choose a valid product.</p>';
            header('Location: /acme/products/'); 
                exit;            
        }
        
//  clear featured item and return message
        
   $invFeatured = filter_input(INPUT_POST, 'invFeatured', FILTER_VALIDATE_BOOLEAN);
        $getFeaturedProduct = getFeaturedProduct($invFeatured);
        $clearFeaturedProduct = clearFeaturedProduct($invFeatured);
if ($clearFeaturedProduct){
    $_SESSION['message']= "<p class='notice'>Previously featured item: " . $getFeaturedProduct['invName'] . " was cleared.</p>";
} else {
    $_SESSION['message'] = "<p class='notice'>No featured product was cleared.</p>";
}

//set featured item
            $setFeaturedProduct = setFeaturedProduct($invId);
            $invSetName = getFeaturedName($invFeatured);
  if ($setFeaturedProduct){
           $_SESSION['message'] .= "<p class='notice'>New featured item: " . $invSetName['invName'] . " was set.</p>";
            }else{
    $_SESSION['message']= '<p class="notice">No featured item was set. Please choose a valid product to feature.</p>';
            }
        
     
        header('Location: /acme/products/'); 
exit;  
        break;

    //######default section that builds the product table#######
    default:
        $products = getProductBasics();
        if (count($products) > 0) {
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td>";
                if (!$product['invFeatured']) {
                    $prodList .= "<td><a href='/acme/products?action=feature&id=$product[invId]' title='Click to set feature'>Feature</a></td></tr>";
                } else {
                    $prodList .= "<td class='selected'>SELECTED</td></tr>";
                    
            }}
                $prodList .= '</tbody></table>';
        } else {
                $message = '<p class="notify">Sorry, no products were returned.</p>';
            }
        
            include '../view/prod-mgmt.php';
            break;
        }
    