<?php
class AdminController
{
    function __construct()
    {
        include('models/Event.php');
        include('models/stripe.php');
        $this->model = new EventModel();
        $stripe_key = new Stripe();
        $this->stripe=$stripe_key->stripe_key();
     
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
    public function service_tax()
    {
        include("./views/service_tax.php");
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
    public function slider()
    {
        include("./views/add_slider.php");
    }
    public function add_coupan()
    {
        include("./views/add_coupan.php");
    }
    public function add_testimonial()
    {
        include("./views/add_testimonial.php");
    }
    public function add_about()
    {
        include("./views/about.php");
    }
    public function add_contact()
    {
        include("./views/add_contact.php");
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
    public function slider_img()
    {
        $success = $this->model->get_slider();
        if ($success) {
            echo json_encode($success);
        } else {
            echo json_encode("empty");
        }
    }
    public function add_sliderdata()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $uploadsDir = "./assets/uploads/";
            $allowedFileType = array('jpg', 'png', 'jpeg');
            $description = $_POST['description'];
            session_start();
            if ($description != '') {

                foreach ($_FILES['files_image']['name'] as $id => $val) {
                    $fileName        = $_FILES['files_image']['name'][$id];
                    $tempLocation    = $_FILES['files_image']['tmp_name'][$id];
                    $targetFilePath  = $uploadsDir . $fileName;
                    $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    $rand = rand() . '.' . $fileType;
                    $path = $uploadsDir . $rand;

                    if (in_array($fileType, $allowedFileType)) {
                        if (move_uploaded_file($tempLocation, $path)) {
                            $data = array(
                                'image_path' => $rand,
                                'description' => $description
                            );
                        }
                    }
                }
                $success = $this->model->add_slider($data);

                if ($success) {

                    $_SESSION['addslider_token'] = true;
                    header("location:?controller=Admin&function=slider");
                } else {
                    $_SESSION['addslider_token'] = false;
                    header("location:?controller=Admin&function=slider");
                }
            } else {
                $_SESSION['addslider_token'] = false;
                header("location:?controller=Admin&function=slider");
            }
        }
    }
    public function delete_slider()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $image_path = $_POST['image_path'];
            session_start();
            $success = $this->model->remove_slider($id);

            if ($success) {
                unlink("./assets/uploads/" . $image_path);
                $_SESSION['deleteslider_token'] = true;
            } else {
                $_SESSION['deleteslider_token'] = false;
            }
        } else {
            $_SESSION['deleteslider_token'] = false;
        }
    }
    //coupan start
    public function add_coupandata()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $percent = $_POST['coupan'];
            $duration = $_POST['duration'];
            $date = date('Y-m-d');
            $Expiry = date('Y-m-d', strtotime($date . ' + ' . $duration . ' months'));

            // echo $newDate;die();

            $coupan = $this->stripe->coupons->create([
                'percent_off' => $percent,
                'duration' => 'repeating',
                'duration_in_months' => $duration,
            ]);
            $data = array(
                'coupan' => $coupan->id,
                'expiry' => $Expiry,
                'discount' => $percent
            );
            $success = $this->model->add_coupan_db($data);
            session_start();
            if ($success) {
                $_SESSION['addcoupan_token'] = true;
                header("location:?controller=Admin&function=add_coupan");
            } else {
                $_SESSION['addcoupan_token'] = false;
                header("location:?controller=Admin&function=add_coupan");
            }
        } else {
            $_SESSION['addcoupan_token'] = false;
            header("location:?controller=Admin&function=add_coupan");
        }
    }
    public function getcoupan_data()
    {
        $success = $this->model->get_coupan();
        if ($success) {
            echo json_encode($success);
        } else {
            echo json_encode("empty");
        }
    }
    public function delete_coupan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];


            $delete = $this->stripe->coupons->delete($id, []);
            if ($delete->deleted) {
                session_start();
                $success = $this->model->remove_coupan($id);
                if ($success) {
                    $_SESSION['deletecoupan_token'] = true;
                } else {
                    $_SESSION['deletecoupan_token'] = false;
                }
            }
        } else {
            $_SESSION['deletecoupan_token'] = false;
        }
    }
    //testimonial
    public function get_testimonial()
    {
        $success = $this->model->get_testimonial();
        if ($success) {
            echo json_encode($success);
        } else {
            echo json_encode("empty");
        }
    }
    public function add_testimonialdata()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['desc'];
            $designation = $_POST['designation'];
            $uploadsDir = "./assets/uploads/";
            $allowedFileType = array('jpg', 'png', 'jpeg');
            session_start();
            if ($description != '') {

                foreach ($_FILES['files_image']['name'] as $id => $val) {
                    $fileName        = $_FILES['files_image']['name'][$id];
                    $tempLocation    = $_FILES['files_image']['tmp_name'][$id];
                    $targetFilePath  = $uploadsDir . $fileName;
                    $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    $rand = rand() . '.' . $fileType;
                    $path = $uploadsDir . $rand;

                    if (in_array($fileType, $allowedFileType)) {
                        if (move_uploaded_file($tempLocation, $path)) {
                            $data = array(
                                'image_path' => $rand,
                                'description' => $description,
                                'name' => $name,
                                'designation' => $designation
                            );
                        }
                    }
                }
                $success = $this->model->add_testimonial($data);

                if ($success) {

                    $_SESSION['addtestimonial_token'] = true;
                    header("location:?controller=Admin&function=add_testimonial");
                } else {
                    $_SESSION['addtestimonial_token'] = false;
                    header("location:?controller=Admin&function=add_testimonial");
                }
            } else {
                $_SESSION['addtestimonial_token'] = false;
                header("location:?controller=Admin&function=add_testimonial");
            }
        }
    }
    public function update_testimonialdata()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['desc'];
            $designation = $_POST['designation'];
            $uploadsDir = "./assets/uploads/";
            $allowedFileType = array('jpg', 'png', 'jpeg');
            session_start();
            if ($description != '') {

                foreach ($_FILES['files_image']['name'] as $id => $val) {
                    $fileName        = $_FILES['files_image']['name'][$id];
                    $tempLocation    = $_FILES['files_image']['tmp_name'][$id];
                    $targetFilePath  = $uploadsDir . $fileName;
                    $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    $rand = rand() . '.' . $fileType;
                    $path = $uploadsDir . $rand;

                    if (in_array($fileType, $allowedFileType)) {
                        if (move_uploaded_file($tempLocation, $path)) {
                            $data = array(
                                'id' => $_POST['id'],
                                'image_path' => $rand,
                                'description' => $description,
                                'name' => $name,
                                'designation' => $designation
                            );
                        }
                    }
                }
                $data_img = $this->model->get_testimg($_POST['id']);
                if ($data_img) {
                    foreach ($data_img as $val) {

                        unlink("./assets/uploads/" . $val['Image_Path']);
                    }
                    $success = $this->model->update_testimonial($data);
                }

                if ($success) {

                    $_SESSION['updatetestimonial_token'] = true;
                    header("location:?controller=Admin&function=add_testimonial");
                } else {
                    $_SESSION['updatetestimonial_token'] = false;
                    header("location:?controller=Admin&function=add_testimonial");
                }
            } else {
                $_SESSION['updatetestimonial_token'] = false;
                header("location:?controller=Admin&function=add_testimonial");
            }
        }
    }
    public function delete_testimonial()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image_path = $_POST['image_path'];
            session_start();
            $success = $this->model->remove_testimonial($_POST['id']);

            if ($success) {
                unlink("./assets/uploads/" . $image_path);
                $_SESSION['deletetestimonial_token'] = true;
            } else {
                $_SESSION['deletetestimonial_token'] = false;
            }
        } else {
            $_SESSION['deletetestimonial_token'] = false;
        }
    }
    //about ckeditor
    public function get_about()
    {
        $success = $this->model->get_about();
        if ($success) {
            echo json_encode($success);
        } else {
            echo json_encode("empty");
        }
    }
    public function update_about()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['content'];
            session_start();
            $success = $this->model->add_about($data);
            if ($success) {
                $_SESSION['addabout_token'] = true;
                header("location:?controller=Admin&function=add_about");
            } else {
                $_SESSION['addabout_token'] = false;
                header("location:?controller=Admin&function=add_about");
            }
        }
    }
    //contact start
    public function get_contact()
    {
        $success = $this->model->get_contact();
        if ($success) {
            echo json_encode($success);
        } else {
            echo json_encode("empty");
        }
    }
    public function reply_contact()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_user = $_POST['id'];
            $reply = $this->test_input($_POST['reply']);
            $email_user = $this->test_input($_POST['email_id']);
            session_start();
            $success = $this->model->send_reply($reply, $email_user);
            if ($success) {
                $data = array(
                    'id' => $id_user,
                    'reply' => $reply
                );
                $save = $this->model->save_reply($data);
                if ($save) {
                    $_SESSION['sendreply_token'] = true;
                    header("location:?controller=Admin&function=add_contact");
                } else {
                    $_SESSION['sendreply_token'] = false;
                    header("location:?controller=Admin&function=add_contact");
                }
            } else {
                $_SESSION['sendreply_token'] = false;
                header("location:?controller=Admin&function=add_contact");
            }
        }
    }
}
