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
                        <h2 class="pageheader-title">City</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=add_city" class="breadcrumb-link">City</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">Add City </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <!-- City Statrt   -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
                <!--  city detail -->
                <!-- ============================================================== -->
                <div class="col-12 city_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addcity_token'])) {
                            if ($_SESSION['addcity_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    City added successfully!!.
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
                            unset($_SESSION['addcity_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deletecity_token'])) {
                            if ($_SESSION['deletecity_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    City deleted successfully!!.
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
                            unset($_SESSION['deletecity_token']);
                        } ?>
                        <!-- update alert -->

                        <?php if (isset($_SESSION['updatecity_token'])) {
                            if ($_SESSION['updatecity_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("update").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                                    City updated successfully!!.
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
                            unset($_SESSION['updatecity_token']);
                        } ?>
                        <a href="#" class="btn btn-primary active add_citybtn">Add City</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All City</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="city_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
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
                <!-- end city detail  -->
                <!-- add city -->
                <div class="row d-flex justify-content-center add_city" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add City</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Address&function=add_citydata" method="post">
                                    <div class="form-group">
                                        <label for="Category">Select Country</label><span class="star">*</span><br>
                                        <select class="form-control Country" name="cid">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Category">Select State</label><span class="star">*</span><br>
                                        <select class="form-control State" name="sid">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">City Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control add-city" name="city" placeholder="City Name">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add City</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update city -->
                <div class="row d-flex justify-content-center update_city" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Update City</h5>
                            <div class="card-body">
                                <form id="validate_form1" action="?controller=Address&function=update_city" method="post">
                                    <div class="form-group">
                                        <input type="hidden" class="city-id" name="city_id">
                                        <label for="country">Select Country</label><span class="star">*</span><br>
                                        <select class="form-control Country" name="cid" id="country_update">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">Select State</label><span class="star">*</span><br>
                                        <select class="form-control State" name="sid" id="state_update">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">City Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control city-name" name="city" placeholder="City Name">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update City</button>
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
<script src="./assets/js/city.js"></script>