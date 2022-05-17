<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../../config/Database.php';
include_once '../../models/product.php';
include_once '../user/auth.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate product object
$product = new Product($db);
$product->from = isset($_GET['from']) ? $_GET['from'] : '';
$product->to = isset($_GET['to']) ? $_GET['to'] : '';
$product->order = isset($_GET['order']) ? $_GET['order'] : '';
if ($product->order == 1) {
    $product->order = "Created_At DESC";
}
$product->Category_ID = isset($_GET['cat_id']) ? $_GET['cat_id'] : '';
$product->load = isset($_GET['load']) ? $_GET['load'] : '';

$product->Product_Color_ID = isset($_GET['clr_id']) ? $_GET['clr_id'] : "";
$product->Subcategory_ID = isset($_GET['subcat_id']) ? $_GET['subcat_id'] : '';
$product->Product_Size = isset($_GET['size_id']) ? $_GET['size_id'] : '';

if (!empty($product->Product_Color_ID)) {
    if (!empty($product->Subcategory_ID) && empty($product->Product_Size)) {
        //clr subcat
        $result = $product->order_color_filter();
        $num = $result->rowCount();
    } else if (!empty($product->Product_Size) && !empty($product->Subcategory_ID)) {
        //clr subcat size
        $result = $product->order_size_filter();
        $num = $result->rowCount();
    } else if (empty($product->Subcategory_ID) && !empty($product->Product_Size)) {
        //clr size
        $result = $product->order_color_cs();
        $num = $result->rowCount();
    } else {
        //clr
        $result = $product->order_color();
        $num = $result->rowCount();
    }
} else {
    if (!empty($product->Subcategory_ID) && !empty($product->Product_Size)) {
        //subcat  size 

        $result = $product->order_color3();
        $num = $result->rowCount();
    } else if (!empty($product->Product_Size)) {
        //size
        $result = $product->order_size();
        $num = $result->rowCount();
    } else if (!empty($product->Subcategory_ID)) {
        // subcat
        $result = $product->order_subcat();
        $num = $result->rowCount();
    } else {
        //   default
        $result = $product->default();
        $num = $result->rowCount();
    }
}

// Check if any product
if ($num > 0) {
    // product array
    $product_arr = array();
    $product_arr['data'] = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item1 = array(
            'ID' => $ID,
            'Product_Name' => $Product_Name,
            'Product_Description' => $Product_Description,
            'Product_Quantity' => $Product_Quantity,
            'IsTrending' => $IsTrending,
            'Subcategory_ID' => $Subcategory_ID,
            'Category_ID' => $Category_ID,
            'Product_Quantity' => $Product_Quantity,
            'Product_Color_ID' => $Product_Color_ID,
            'Color_name' => $Product_Color,
            'Size_Name' => $Product_Size,
            'Product_Size' => $Product_Size,
            'Product_Price' => $Product_Price,
            'Category_name' => $Category_Name,
            'Subcategory_name' => $Subcategory_Name,
            'Size_id' => $size_id,
            'price_id'=>$Price_ID

        );
        $result2 = $product->getsingle_image($ID);
        while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $product_item2 = array(
                'Image_path' => $Image_Path
            );

            // Push to "data"
            $newdata = array_merge($product_item1, $product_item2);
        }
        // Push to "data"
        array_push($product_arr['data'], $newdata);
    }
    //    echo "<pre>"; print_r($product_arr);
    // Turn to JSON & output
    echo json_encode($product_arr);
} else {
    // No product
    echo json_encode(
        array('message' => 'No product Found')
    );
}
