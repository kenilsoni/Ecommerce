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
                        <h2 class="pageheader-title">Country</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=add_country" class="breadcrumb-link">Country</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">Add Country </li>
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
                <!--  country detail -->
                <!-- ============================================================== -->
                <div class="col-12 country_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addcountry_token'])) {
                            if ($_SESSION['addcountry_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Country added successfully!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                            <?php  } else { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("err").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-danger alert-dismissible fade show" id="err" role="alert">
                                    Sorry data is not added!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                        <?php }
                            unset($_SESSION['addcountry_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deletecountry_token'])) {
                            if ($_SESSION['deletecountry_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    Country deleted successfully!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                            <?php  } else { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("err").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-danger alert-dismissible fade show" id="err" role="alert">
                                    Sorry data is not deleted!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                        <?php }
                            unset($_SESSION['deletecountry_token']);
                        } ?>
                        <!-- update alert -->

                        <?php if (isset($_SESSION['updatecountry_token'])) {
                            if ($_SESSION['updatecountry_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("update").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                                    Country updated successfully!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                            <?php  } else { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("err").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-danger alert-dismissible fade show" id="err" role="alert">
                                    Sorry data is not updated!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                        <?php }
                            unset($_SESSION['updatecountry_token']);
                        } ?>


                        <a href="#" class="btn btn-primary active add_countrybtn">Add Country</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All Country</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="country_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Country</th>
                                            <th>Created Date</th>
                                            <th>Modify Date</th>
                                            <th style="width:125px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end country detail  -->
                <!-- add country -->
                <div class="row d-flex justify-content-center add_country" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add Country</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Address&function=add_countrydata" method="post">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Country Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control country-name" name="country" placeholder="Country Name">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Country</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- update country -->
                <div class="row d-flex justify-content-center update_country" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Update Country</h5>
                            <div class="card-body">
                                <form id="validate_form1" action="?controller=Address&function=update_country" method="post">
                                    <div class="form-group">
                                        <input type="hidden" class="update_id" name="id">
                                        <label for="inputText3" class="col-form-label">Country Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control countryinput" name="country" placeholder="Country Name">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update Country</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include("footer.php"); ?>
<script src="./assets/js/country.js"></script>