<?php
class CategoryController
{
    function __construct()
    {
        include('models/Category_model.php');
        $this->model = new CategoryModel();
    }
    public function all_category()
    {
        include("./views/all_category.php");
    }
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function getcategory()
    {
        $success = $this->model->category_data();
        if (count($success) > 0) {
            echo json_encode($success);
        }
    }
    public function addcategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->test_input($_POST['category_name']);
            $desc = $this->test_input($_POST['desc_category']);
            session_start();
            if ($name != "" && $desc !="") {
                $success = $this->model->addcategory_data($name, $desc);
                if ($success == 1) {
                    $_SESSION['addcategory_token'] = true;
                    header("location:?controller=Category&function=all_category");
                } else {
                    $_SESSION['addcategory_token'] = false;
                    header("location:?controller=Category&function=all_category");
                }
            } else {
                $_SESSION['addcategory_token'] = false;
                header("location:?controller=Category&function=all_category");
            }
        }
    }
    public function getdesc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $success = $this->model->desc_data($id);
        if (count($success) > 0) {
            echo json_encode($success);
        }
    }
    }
    public function deletecategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            session_start();
            if ($id != "") {
                $success = $this->model->delete_category($id);
                if ($success == 1) {
                    $_SESSION['deletecategory_token'] = true;
                } else {
                    $_SESSION['deletecategory_token'] = false;
                }
            } else {
                $_SESSION['deletecategory_token'] = false;
            }
        }
    }
    public function update_category()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['update_id'];
            $name_update = $this->test_input($_POST['category_name']);
            $desc = $this->test_input($_POST['desc_category']);
            session_start();
            if ($name_update != "") {
                $data = array(
                    'ID' => $id,
                    'Category_Name' => $name_update,
                    'desc_category'=>$desc
                );
                $success = $this->model->update_category($data);
                if ($success == 1) {
                    $_SESSION['updatecategory_token'] = true;
                    header("location:?controller=Category&function=all_category");
                } else {
                    $_SESSION['updatecategory_token'] = false;
                    header("location:?controller=Category&function=all_category");
                }
            } else {
                $_SESSION['updatecategory_token'] = false;
                header("location:?controller=Category&function=all_category");
            }
        }
    }
}
