<?php
class UserController
{
    function __construct()
    {
        include('models/User_model.php');
        $this->model = new UserModel();
    }
    public function all_subcategory()
    {
        include("./views/user_list.php");
    }
    public function all_userlist()
    {
        include("./views/user_list.php");
    }
    public function getuser()
    {
        $success = $this->model->user_data();
        $data_main = [];
        foreach ($success as $data) {
            $success = $this->model->get_address($data['ID']);
            $final = array_merge(array($data), $success);
            array_push($data_main, $final);
        }
        if (count($data_main) > 0) {
            echo json_encode($data_main);
        }
    }
    public function getuserdetail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $success = $this->model->user_detail($id);
            $data_main = [];
            foreach ($success as $data) {
                $success = $this->model->get_address($data['ID']);
                $final = array_merge(array($data), $success);
                array_push($data_main, $final);
            }
            if (count($data_main) > 0) {
                echo json_encode($data_main);
            }
        }
    }
    public function deactive()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $success = $this->model->deactive_user($id);
            if ($success) {
                echo $success;
            }
        }
    }
    public function active()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $success = $this->model->active_user($id);
            if ($success) {
                echo $success;
            }
        }
    }
}
