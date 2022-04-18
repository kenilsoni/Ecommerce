<?php
class SubCategoryController
{
    function __construct()
    {
        include('models/SubCategory_model.php');
        $this->model = new SubCategoryModel();
    }
    public function all_subcategory()
    {
        include("./views/all_subcategory.php");
    }
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function getsubcategory()
    {
        $success = $this->model->subcategory_data();
        if (count($success) > 0) {
            echo json_encode($success);
        }
    }
    public function addsubcategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['Category'];
            $name = $this->test_input($_POST['subcategory_name']);
            $desc = $this->test_input($_POST['desc_subcategory']);
            session_start();
            if ($name != "" && $desc != "") {
                $data = array(
                    'ID' => $id,
                    'Subcategory_Name' => $name,
                    'desc_subcategory' => $desc
                );
                $success = $this->model->addsubcategory_data($data);
                if ($success == 1) {
                    $_SESSION['addsubcategory_token'] = true;
                    header("location:?controller=SubCategory&function=all_subcategory");
                } else {
                    $_SESSION['addsubcategory_token'] = false;
                    header("location:?controller=SubCategory&function=all_subcategory");
                }
            } else {
                $_SESSION['addsubcategory_token'] = false;
                header("location:?controller=SubCategory&function=all_subcategory");
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
    public function deletesubcategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            session_start();
            if ($id != "") {
                $success = $this->model->delete_subcategory($id);

                if ($success == 1) {

                    $_SESSION['deletesubcategory_token'] = true;
                } else {
                    $_SESSION['deletesubcategory_token'] = false;
                }
            } else {
                $_SESSION['deletesubcategory_token'] = false;
            }
        }
    }
    public function update_subcategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['update_id'];
            $category_id = $_POST['Category'];
            $subcategory = $this->test_input($_POST['subcategory_name']);
            $desc = $this->test_input($_POST['desc_subcategory']);
            session_start();
            if ($subcategory != "" && $desc != "") {
                $data = array(
                    'ID' => $id,
                    'Category_ID' => $category_id,
                    'Subcategory_Name' => $subcategory,
                    'desc_subcategory' => $desc
                );
                $success = $this->model->update_subcategory($data);
                if ($success == 1) {

                    $_SESSION['updatesubcategory_token'] = true;
                    header("location:?controller=SubCategory&function=all_subcategory");
                } else {
                    $_SESSION['updatesubcategory_token'] = false;
                    header("location:?controller=SubCategory&function=all_subcategory");
                }
            } else {
                $_SESSION['updatesubcategory_token'] = false;
                header("location:?controller=SubCategory&function=all_subcategory");
            }
        }
    }
}
