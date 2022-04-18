<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
<?php include("navbar.php"); ?>
<!-- ============================================================== -->
<!-- end navbar -->
<!-- ============================================================== -->
<?php include("left_sidebar.php"); ?>
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">USER</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=User&function=all_userlist" class="breadcrumb-link">USER</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Details </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
                <!-- All user  -->
                <!-- ============================================================== -->
                <div class="col-12">
                    <div class="card" id="all_detail" style="display:block">
                        <h5 class="card-header">User Details</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="user_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>UserName</th>
                                            <th>Full Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th style="width:200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card" id="view_detail" style="display:none">
                        <h5 class="card-header">View Details</h5>
                        <div class="card-body">
                            <div class="row  text-center">
                                <div class="col-6">
                                    <div>UserName</div>
                                </div>
                                <div class="col-6">
                                    <div class="username"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div>FullName</div>
                                </div>
                                <div class="col-6">
                                    <div class="fullname"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div>Gender</div>
                                </div>
                                <div class="col-6">
                                    <div class="gender"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div>Phone</div>
                                </div>
                                <div class="col-6">
                                    <div class="phone"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div>Email</div>
                                </div>
                                <div class="col-6">
                                    <div class="email"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div>Billing Address</div>
                                </div>
                                <div class="col-6">
                                    <div class="baddress"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div>Shipping Address</div>
                                </div>
                                <div class="col-6">
                                    <div class="saddress"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div>Created Date</div>
                                </div>
                                <div class="col-6">
                                    <div class="created"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div>Modify Date</div>
                                </div>
                                <div class="col-6">
                                    <div class="modify"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end user  -->
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
<script src="./assets/js/user.js"></script>