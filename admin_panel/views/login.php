<?php session_start();
if (isset($_SESSION['ID'])) {
    header("location:?controller=Admin&function=admin_page");
} ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="./assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/libs/css/style.css">
    <link rel="stylesheet" href="./assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><i class="fa fa-shopping-cart fa-4x" aria-hidden="true"></i><span class="splash-description">Please enter your credentials.</span></div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['token_password'])) {
                    if ($_SESSION['token_password']) { ?>
                        <script>
                            setTimeout(() => {
                                document.getElementById("password_check").style.display = 'none';
                            }, 4000);
                        </script>
                        <div class="alert alert-warning alert-dismissible fade show" id="password_check" role="alert">
                            <strong>Please Enter Valid Password!!!</strong>
                            <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </a>
                        </div><?php unset($_SESSION['token_password']);
                            }
                        } ?>
                <?php if (isset($_SESSION['token_username'])) {
                    if ($_SESSION['token_username']) { ?>
                        <script>
                            setTimeout(() => {
                                document.getElementById("username_check").style.display = 'none';
                            }, 4000);
                        </script>
                        <div class="alert alert-warning alert-dismissible fade show" id="username_check" role="alert">
                            <strong>Please Enter Valid UserName!!!</strong>
                            <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </a>
                        </div><?php unset($_SESSION['token_username']);
                            }
                        } ?>
                <?php if (isset($_SESSION['token_method'])) {
                    if ($_SESSION['token_method']) { ?>
                        <script>
                            setTimeout(() => {
                                document.getElementById("method_check").style.display = 'none';
                            }, 4000);
                        </script>
                        <div class="alert alert-warning alert-dismissible fade show" id="method_check" role="alert">
                            <strong>Something Went Wrong!!!</strong>
                            <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </a>
                        </div><?php unset($_SESSION['token_method']);
                            }
                        } ?>
                <form action="?function=check_login" method="post">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" name="username" type="text" required="" value="<?php if (isset($_COOKIE["member_login"])) {
                                                                                                                                        echo $_COOKIE["member_login"];
                                                                                                                                    } ?>" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" required="" value="<?php if (isset($_COOKIE["member_password"])) {
                                                                                                                                            echo $_COOKIE["member_password"];
                                                                                                                                        } ?>" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" <?php if (isset($_COOKIE["member_login"])) { ?> checked <?php } ?>><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>

        </div>
    </div>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->


    <script src="./assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>