<?php
class ProductController
{
    function __construct()
    {
        include('models/Product_model.php');
        $this->model = new ProductModel();
    }
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function add_color()
    {
        include("./views/add_color.php");
    }
    public function add_size()
    {
        include("./views/add_size.php");
    }
    public function all_product()
    {
        include("./views/all_product.php");
    }
    public function getcolor()
    {
        $success = $this->model->color_data();
        if (count($success) > 0) {
            session_start();
            $_SESSION['color'] = $success;
            echo json_encode($success);
        }
    }
    public function getcolor_id()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $success = $this->model->colordata_id($id);
            if (count($success) > 0) {
                echo json_encode($success);
            }
        }
    }
    public function add_colordata()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $color = $this->test_input($_POST['color_name']);
            $code = $this->test_input($_POST['color_code']);
            session_start();
            if ($color != "" && $code != "") {
                $success = $this->model->add_colordb($color, $code);
                if ($success == 1) {
                    $_SESSION['addcolor_token'] = true;
                    header("location:?controller=Product&function=add_color");
                } else {
                    $_SESSION['addcolor_token'] = false;
                    header("location:?controller=Product&function=add_color");
                }
            } else {
                $_SESSION['addcolor_token'] = false;
                header("location:?controller=Product&function=add_color");
            }
        }
    }
    public function update_color()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['color_id'];
            $color = $this->test_input($_POST['color_name']);
            $code = $this->test_input($_POST['color_code']);

            session_start();
            if ($color != "" && $code != "") {
                $success = $this->model->update_color($color, $id, $code);
                if ($success == 1) {
                    $_SESSION['updatecolor_token'] = true;
                    header("location:?controller=Product&function=add_color");
                } else {
                    $_SESSION['updatecolor_token'] = false;
                    header("location:?controller=Product&function=add_color");
                }
            } else {
                $_SESSION['updatecolor_token'] = false;
                header("location:?controller=Product&function=add_color");
            }
        }
    }
    public function delete_color()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            session_start();
            if ($id != "") {
                $success = $this->model->delete_color($id);
                if ($success == 1) {
                    $_SESSION['deletecolor_token'] = true;
                } else {
                    $_SESSION['deletecolor_token'] = false;
                }
            } else {
                $_SESSION['deletecolor_token'] = false;
            }
        }
    }
    // size start
    public function getsize()
    {
        $success = $this->model->size_data();
        if (count($success) > 0) {
            session_start();
            $_SESSION['size'] = $success;
            echo json_encode($success);
        }
    }
    public function add_sizedata()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $size = $this->test_input($_POST['size']);

            session_start();
            if ($size != "") {
                $success = $this->model->add_sizedb($size);
                if ($success == 1) {
                    $_SESSION['addsize_token'] = true;
                    header("location:?controller=Product&function=add_size");
                } else {
                    $_SESSION['addsize_token'] = false;
                    header("location:?controller=Product&function=add_size");
                }
            } else {
                $_SESSION['addsize_token'] = false;
                header("location:?controller=Product&function=add_size");
            }
        }
    }
    public function update_size()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['size_id'];
            $size = $this->test_input($_POST['size']);

            session_start();
            if ($size != "") {
                $success = $this->model->update_size($size, $id);
                if ($success == 1) {

                    $_SESSION['updatesize_token'] = true;
                    header("location:?controller=Product&function=add_size");
                } else {
                    $_SESSION['updatesize_token'] = false;
                    header("location:?controller=Product&function=add_size");
                }
            } else {
                $_SESSION['updatesize_token'] = false;
                header("location:?controller=Product&function=add_size");
            }
        }
    }
    public function delete_size()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            session_start();
            if ($id != "") {
                $success = $this->model->delete_size($id);
                if ($success == 1) {
                    $_SESSION['deletesize_token'] = true;
                } else {
                    $_SESSION['deletesize_token'] = false;
                }
            } else {
                $_SESSION['deletesize_token'] = false;
            }
        }
    }
    // product start
    public function getproduct()
    {
        $success = $this->model->product_data();
        $data_main = [];
        foreach ($success as $val) {
            $success = $this->model->getimage($val['ID']);
            $data = array_merge(array($val), $success);
            array_push($data_main, $data);
        }
        if (count($success) > 0) {
            echo json_encode($data_main);
        }
    }
    public function getproductby_id()
    {
        $id = $_POST['id'];
        $success = $this->model->product_databyid($id);
        $data_main = [];
        foreach ($success as $val) {
            $success = $this->model->getimage($val['ID']);
            $data = array_merge(array($val), $success);
            array_push($data_main, $data);
            session_start();
            $_SESSION['color_update'] = $val['Product_Color_ID'];
            $_SESSION['size_update'] = $val['Product_Size'];
        }
        if (count($success) > 0) {
            echo json_encode($data_main);
        }
    }
    public function getsubcategory_id()
    {
        $id = $_POST['id'];
        $success = $this->model->subcategory_data($id);
        if (count($success) > 0) {
            echo json_encode($success);
        }
    }
    public function getimage_update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $success = $this->model->fetch_image($_POST['id']);
            if (count($success) > 0) {
                echo json_encode($success);
            }
        }
    }
    public function add_productdata()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uploadsDir = "./assets/uploads/";
            $allowedFileType = array('jpg', 'png', 'jpeg');
            $product = $this->test_input($_POST['product_name']);
            $product_desc = $this->test_input($_POST['product_desc']);
            $price = $_POST['product_price'];
            $quantity = $_POST['product_quantity'];
            $category = $_POST['product_category'];
            $subcategory = $_POST['product_subcategory'];
            $color = $_POST['product_color'];
            $size = $_POST['product_size'];
            $color_string = implode(",", $color);
            $size_string = implode(",", $size);

            session_start();
            if (($product &&  $product_desc &&  $price &&  $quantity && $category &&  $subcategory &&   $color &&  $size) != '') {
                $image_name = [];
                foreach ($_FILES['files_image']['name'] as $id => $val) {
                    $fileName        = $_FILES['files_image']['name'][$id];
                    $tempLocation    = $_FILES['files_image']['tmp_name'][$id];
                    $targetFilePath  = $uploadsDir . $fileName;
                    $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    $rand = rand() . '.' . $fileType;
                    $path = $uploadsDir . $rand;

                    if (in_array($fileType, $allowedFileType)) {
                        if (move_uploaded_file($tempLocation, $path)) {
                            array_push($image_name, $rand);
                        }
                    }
                }
                if (isset($_POST['istrend'])) {
                    $trend = 1;
                } else {
                    $trend = 0;
                }
                $data = array(
                    'product_name' => $product,
                    'product_desc' => $product_desc,
                    'price' => $price,
                    'quantity' => $quantity,
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'color' => $color_string,
                    'size' => $size_string,
                    'trend' => $trend
                );
                $success = $this->model->add_productdb($data);
                if ($success) {
                    foreach ($image_name as $val) {
                        $this->model->add_imagedb($val, $success);
                    }
                    $_SESSION['addproduct_token'] = true;
                    header("location:?controller=Product&function=all_product");
                } else {
                    $_SESSION['addproduct_token'] = false;
                    header("location:?controller=Product&function=all_product");
                }
            } else {
                $_SESSION['addproduct_token'] = false;
                header("location:?controller=Product&function=all_product");
            }
        }
    }
    public function update_productdata()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uploadsDir = "./assets/uploads/";
            $allowedFileType = array('jpg', 'png', 'jpeg');
            $product = $this->test_input($_POST['product_name']);
            $product_desc = $this->test_input($_POST['product_desc']);
            $price = $_POST['product_price'];
            $quantity = $_POST['product_quantity'];
            $category = $_POST['product_category'];
            $subcategory = $_POST['product_subcategory'];
            $color = $_POST['product_color'];
            $size = $_POST['product_size'];
            $color_string = implode(",", $color);
            $size_string = implode(",", $size);

            session_start();
            if (($product &&  $product_desc &&  $price &&  $quantity && $category &&  $subcategory &&   $color &&  $size) != '') {
                $image_name = [];
                foreach ($_FILES['files_image']['name'] as $id => $val) {
                    $fileName        = $_FILES['files_image']['name'][$id];
                    $tempLocation    = $_FILES['files_image']['tmp_name'][$id];
                    $targetFilePath  = $uploadsDir . $fileName;
                    $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    $rand = rand() . '.' . $fileType;
                    $path = $uploadsDir . $rand;
                    if (in_array($fileType, $allowedFileType)) {
                        if (move_uploaded_file($tempLocation, $path)) {
                            array_push($image_name, $rand);
                        }
                    }
                }
                foreach ($image_name as $val) {
                    $this->model->add_imagedb($val, $_POST['id']);
                }
                if (isset($_POST['istrend'])) {
                    $trend = 1;
                } else {
                    $trend = 0;
                }
                $data = array(
                    'product_name' => $product,
                    'product_desc' => $product_desc,
                    'price' => $price,
                    'quantity' => $quantity,
                    'category' => $category,
                    'subcategory' => $subcategory,
                    'color' => $color_string,
                    'size' => $size_string,
                    'trend' => $trend,
                    'id' => $_POST['id']
                );
                $success = $this->model->update_productdb($data);
                if ($success) {

                    $_SESSION['updateproduct_token'] = true;
                    header("location:?controller=Product&function=all_product");
                } else {
                    $_SESSION['updateproduct_token'] = false;
                    header("location:?controller=Product&function=all_product");
                }
            } else {
                $_SESSION['updateproduct_token'] = false;
                header("location:?controller=Product&function=all_product");
            }
        }
    }
    public function delete_image()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $image_name = $this->model->fetch_image_table($id);
            foreach ($image_name as $val) {
                unlink("./assets/uploads/" . $val['Image_Path']);
            }
            $success = $this->model->image_delete($id);
            if ($success) {
                echo $success;
            }
        }
    }
    public function delete_product()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            session_start();
            if ($id != "") {
                $image_name = $this->model->fetch_image($id);
                foreach ($image_name as $val) {
                    unlink("./assets/uploads/" . $val['Image_Path']);
                }
                $success = $this->model->delete_product($id);
                if ($success == 1) {

                    $_SESSION['deleteproduct_token'] = true;
                } else {
                    $_SESSION['deleteproduct_token'] = false;
                }
            } else {
                $_SESSION['deleteproduct_token'] = false;
            }
        }
    }
}
