<?php

/* 
 * Products Model page for site visitors.
 */
/* 
 * New function will handle creation of new categories.
 */

function createCategory($categoryName)
        {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'INSERT INTO categories(categoryName)
     VALUES (:categoryName)';
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
        
 
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
        }
 /* 
 * New function will handle creation of new products.
 */

function createProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize,
        $invWeight, $invLocation, $categoryId, $invVendor, $invStyle){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize,invWeight, invLocation, categoryId, invVendor, invStyle)
     VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize,:invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

/* function will get basic product information from 
 * the inventory table for starting an update or delete process*/

function getProductBasics() {
 $db = acmeConnect();
 $sql = 'SELECT invName, invId, invFeatured FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

/*function selects single product based on its id*/

// Get product information by invId
function getProductInfo($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $prodInfo;
}


// This will update a product
function updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize,
        $invWeight, $invLocation, $categoryId, $invVendor, $invStyle, $invId){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, 
     invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, 
     invLocation = :invLocation, categoryId = :categoryId, invVendor = :invVendor, invStyle = :invStyle
    WHERE invId = :invId';
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// delete a product
function deleteProduct($invId){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// get list of products based on category
function getProductsByCategory($type){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :catType)';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

////////////////////////////////////////////////
//Enhancement 8 starts here/////
// get product data based on inventory Id
function getProductById($inventoryId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invId', $inventoryId, PDO::PARAM_STR);
 $stmt->execute();
 $productDetail = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $productDetail;
}

////////////////////////////////////////////////
//Final Project starts here/////
// get product data based on inventory Id
/*function selects single product based on its id*/

//// Get data for featured inventory item by invId
//function getFeaturedProduct($invFeatured){
// $db = acmeConnect();
// $sql = 'SELECT * FROM inventory WHERE invFeatured = TRUE';
// $stmt = $db->prepare($sql);
// $stmt->bindValue(':invFeatured', $invFeatured, PDO::PARAM_BOOL);
// $stmt->execute();
// $featuredProduct = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $stmt->closeCursor();
// return $featuredProduct;
//}

function getFeaturedName($invFeatured){
 $db = acmeConnect();
 $sql = 'SELECT invName FROM inventory WHERE invFeatured = TRUE';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':invFeatured', $invFeatured, PDO::PARAM_BOOL);
 $stmt->execute();
 $clearName = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clearName;
}

// Clear featured item status to NULL
function clearFeaturedProduct($invFeatured){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'UPDATE inventory SET invFeatured = NULL WHERE invFeatured = TRUE';
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':invFeatured', $invFeatured, PDO::PARAM_BOOL);
 
 // set featured item status to TRUE
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Clear featured item status to NULL
function setFeaturedProduct($invId){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'UPDATE inventory SET invFeatured = TRUE WHERE invId = :invId';
 // Create the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tells the database the type of data it is
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Close the database interaction
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}
