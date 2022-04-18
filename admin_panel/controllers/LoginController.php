<?php
class LoginController
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
    public function signin()
    {
        include("views/login.php");
    }
    public function check_login()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = $this->test_input($_POST['username']);
            $password = $this->test_input($_POST['password']);
            $remember = false;
            if (isset($_POST['remember'])) {
                $remember = true;
            }

            if (($username || $password) != '') {
                $admin_data = array(
                    'UserName' => $username
                );
                $success = $this->model->check_admin($admin_data);
                foreach ($success as $data) {
                    $ID = $data['ID'];
                    $username = $data['UserName'];
                    $password_db = $data['Password'];
                }
                if (count($success) > 0) {
                    if (password_verify($password, $password_db)) {
                        if ($remember) {
                            setcookie("member_login", $username, time() + (86400 * 3));
                            setcookie("member_password", $password, time() + (86400 * 3));
                        }
                        $_SESSION['ID'] = $ID;
                        header('location:?controller=Admin&function=admin_page');
                    } else {
                        $_SESSION['token_password'] = true;
                        header('location:?controller=Login&function=signin');
                    }
                } else {
                    $_SESSION['token_username'] = true;
                    header('location:?controller=Login&function=signin');
                }
            } else {
                $_SESSION['token_method'] = true;
                header('location:?controller=Login&function=signin');
            }
        }
    }
}
