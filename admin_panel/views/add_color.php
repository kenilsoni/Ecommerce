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
                        <h2 class="pageheader-title">Color</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=add_color" class="breadcrumb-link">Color</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">Add Color </li>
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
                <!--  Color Details  -->
                <div class="col-12 color_detail">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addcolor_token'])) {
                            if ($_SESSION['addcolor_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Color added successfully!!.
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
                            unset($_SESSION['addcolor_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deletecolor_token'])) {
                            if ($_SESSION['deletecolor_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    Color deleted successfully!!.
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
                            unset($_SESSION['deletecolor_token']);
                        } ?>
                        <!-- update alert -->

                        <?php if (isset($_SESSION['updatecolor_token'])) {
                            if ($_SESSION['updatecolor_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("update").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                                    Color updated successfully!!.
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
                            unset($_SESSION['updatecolor_token']);
                        } ?>
                        <a href="#" class="btn btn-primary active add_colorbtn">Add Color</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All Color</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="color_detail">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Code</th>
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
                <!-- End Color Details  -->
                <!-- Add Color  -->
                <!-- ============================================================== -->

                <div class="row d-flex justify-content-center add_color" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add Color</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Product&function=add_colordata" method="post">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Color Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control add-color" name="color_name" placeholder="Color Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Select Color</label><span class="star">*</span>
                                        <input id="inputText3" type="color" class="form-control color-code" name="color_code">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Color</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end Add Color  -->
                <!-- Update Color  -->
                <!-- ============================================================== -->

                <div class="row d-flex justify-content-center update_color" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Update Color</h5>
                            <div class="card-body">
                                <form id="validate_form1" action="?controller=Product&function=update_color" method="post">
                                    <div class="form-group">
                                        <input type="hidden" class="color-id" name="color_id">
                                        <label for="inputText3" class="col-form-label">Color Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control color-name" name="color_name" placeholder="Color Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Select Color</label><span class="star">*</span>
                                        <input id="inputText3" type="color" class="form-control color-code" name="color_code">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update Color</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end Update Color  -->
            </div>
        </div>
    </div>
</div>
</div>

<?php include("footer.php"); ?>
<script src="./assets/js/color.js"></script>