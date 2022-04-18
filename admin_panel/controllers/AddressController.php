<?php
class AddressController
{
    function __construct()
    {
        include('models/Address_model.php');
        $this->model = new AddressModel();
    }
    public function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
    public function getcountry()
    {
        $success = $this->model->country_data();
        if (count($success) > 0) {
            echo json_encode($success);
        }
    }
    public function add_countrydata()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $country = $this->test_input($_POST['country']);
            session_start();
            if ($country != "") {
                $success = $this->model->add_countrydb($country);
                if ($success == 1) {
                    $_SESSION['addcountry_token'] = true;
                    header("location:?controller=Address&function=add_country");
                } else {
                    $_SESSION['addcountry_token'] = false;
                    header("location:?controller=Address&function=add_country");
                }
            } else {
                $_SESSION['addcountry_token'] = false;
                header("location:?controller=Address&function=add_country");
            }
        }
    }
    public function update_country()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $country = $this->test_input($_POST['country']);

            session_start();
            if ($country != "") {
                $success = $this->model->update_country($country, $id);
                if ($success == 1) {

                    $_SESSION['updatecountry_token'] = true;
                    header("location:?controller=Address&function=add_country");
                } else {
                    $_SESSION['updatecountry_token'] = false;
                    header("location:?controller=Address&function=add_country");
                }
            } else {
                $_SESSION['updatecountry_token'] = false;
                header("location:?controller=Address&function=add_country");
            }
        }
    }
    public function delete_country()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            session_start();
            if ($id != "") {
                $success = $this->model->delete_country($id);
                if ($success == 1) {
                    $_SESSION['deletecountry_token'] = true;
                } else {
                    $_SESSION['deletecountry_token'] = false;
                }
            } else {
                $_SESSION['deletecountry_token'] = false;
            }
        }
    }
    // state start
    public function getstate()
    {
        $success = $this->model->state_data();
        if (count($success) > 0) {
            echo json_encode($success);
        }
    }
    public function add_statedata()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cid = $_POST['cid'];
            $state = $this->test_input($_POST['state']);

            session_start();
            if ($state != "") {
                $success = $this->model->add_statedb($cid, $state);
                if ($success == 1) {

                    $_SESSION['addstate_token'] = true;
                    header("location:?controller=Address&function=add_state");
                } else {
                    $_SESSION['addstate_token'] = false;
                    header("location:?controller=Address&function=add_state");
                }
            } else {
                $_SESSION['addstate_token'] = false;
                header("location:?controller=Address&function=add_state");
            }
        }
    }
    public function update_state()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $stateid = $_POST['state_id'];
            $country = $_POST['cid'];
            $state = $this->test_input($_POST['state']);

            session_start();
            if ($state != "") {
                $success = $this->model->update_state($stateid, $country, $state);
                if ($success == 1) {

                    $_SESSION['updatestate_token'] = true;
                    header("location:?controller=Address&function=add_state");
                } else {
                    $_SESSION['updatestate_token'] = false;
                    header("location:?controller=Address&function=add_state");
                }
            } else {
                $_SESSION['updatestate_token'] = false;
                header("location:?controller=Address&function=add_state");
            }
        }
    }
    public function delete_state()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            session_start();
            if ($id != "") {
                $success = $this->model->delete_state($id);
                if ($success == 1) {
                    $_SESSION['deletestate_token'] = true;
                } else {
                    $_SESSION['deletestate_token'] = false;
                }
            } else {
                $_SESSION['deletestate_token'] = false;
            }
        }
    }
    // city start
    public function getcity()
    {
        $success = $this->model->city_data();
        if (count($success) > 0) {
            echo json_encode($success);
        }
    }
    public function add_citydata()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cid = $_POST['cid'];
            $sid = $_POST['sid'];
            $city = $this->test_input($_POST['city']);

            session_start();
            if ($city != "") {
                $success = $this->model->add_citydb($cid, $sid, $city);
                if ($success == 1) {

                    $_SESSION['addcity_token'] = true;
                    header("location:?controller=Address&function=add_city");
                } else {
                    $_SESSION['addcity_token'] = false;
                    header("location:?controller=Address&function=add_city");
                }
            } else {
                $_SESSION['addcity_token'] = false;
                header("location:?controller=Address&function=add_city");
            }
        }
    }
    public function update_city()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cityid = $_POST['city_id'];
            $countryid = $_POST['cid'];
            $stateid = $_POST['sid'];
            $city = $this->test_input($_POST['city']);
            session_start();
            if ($city != "") {
                $data = array(
                    'city_id' => $cityid,
                    'country_id' => $countryid,
                    'state_id' => $stateid,
                    'city_name' => $city
                );
                $success = $this->model->update_city($data);
                if ($success == 1) {

                    $_SESSION['updatecity_token'] = true;
                    header("location:?controller=Address&function=add_city");
                } else {
                    $_SESSION['updatecity_token'] = false;
                    header("location:?controller=Address&function=add_city");
                }
            } else {
                $_SESSION['updatecity_token'] = false;
                header("location:?controller=Address&function=add_city");
            }
        }
    }
    public function getstatebyid()
    {
        $id = $_POST['id'];
        $success = $this->model->state_databyid($id);
        if (count($success) > 0) {
            echo json_encode($success);
        } else {
            echo json_encode('empty');
        }
    }
    public function delete_city()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            session_start();
            if ($id != "") {
                $success = $this->model->delete_city($id);
                if ($success == 1) {
                    $_SESSION['deletecity_token'] = true;
                } else {
                    $_SESSION['deletecity_token'] = false;
                }
            } else {
                $_SESSION['deletecity_token'] = false;
            }
        }
    }
}
