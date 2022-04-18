<?php
class AdminController
{
    function __construct()
    {
        include('models/Event.php');
        $this->model = new EventModel();
    }
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function admin_page()
    {
        include("./views/admin.php");
    }
    public function logout()
    {
        include("./views/logout.php");
    }
    public function all_product()
    {
        include("./views/all_product.php");
    }
    public function add_product()
    {
        include("./views/add_product.php");
    }
    public function add_category()
    {
        include("./views/add_category.php");
    }
    public function all_category()
    {
        include("./views/all_category.php");
    }
    public function add_subcategory()
    {
        include("./views/add_subcategory.php");
    }
    public function all_subcategory()
    {
        include("./views/all_subcategory.php");
    }
    public function add_country()
    {
        include("./views/add_country.php");
    }
    public function add_state()
    {
        include("./views/add_state.php");
    }
    public function add_city()
    {
        include("./views/add_city.php");
    }
    public function pending_order()
    {
        include("./views/pending_order.php");
    }
    public function completed_order()
    {
        include("./views/completed_order.php");
    }
    public function user_list()
    {
        include("./views/user_list.php");
    }
    public function add_color()
    {
        include("./views/add_color.php");
    }
    public function add_size()
    {
        include("./views/add_size.php");
    }
    public function gettotal_user()
    {
        $success = $this->model->getuser_count();
        if ($success) {
            echo json_encode($success);
        } else {
            echo json_encode("empty");
        }
    }
    public function gettotal_product()
    {
        $success = $this->model->getproduct_count();
        if ($success) {
            echo json_encode($success);
        } else {
            echo json_encode("empty");
        }
    }
}
