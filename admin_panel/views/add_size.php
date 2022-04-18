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
                        <h2 class="pageheader-title">Size</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=add_size" class="breadcrumb-link">Size</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Size </li>
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
                <!--  Size Detail -->
                <!-- ============================================================== -->
                <div class="col-12 size_detail">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addsize_token'])) {
                            if ($_SESSION['addsize_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Size added successfully!!.
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
                            unset($_SESSION['addsize_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deletesize_token'])) {
                            if ($_SESSION['deletesize_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    Size deleted successfully!!.
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
                            unset($_SESSION['deletesize_token']);
                        } ?>
                        <!-- update alert -->

                        <?php if (isset($_SESSION['updatesize_token'])) {
                            if ($_SESSION['updatesize_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("update").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                                    Size updated successfully!!.
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
                            unset($_SESSION['updatesize_token']);
                        } ?>
                        <a href="#" class="btn btn-primary active add_sizebtn">Add Size</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">Add size</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="size_detail">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
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
                <!-- end Size detail  -->
                <!-- Add Size  -->
                <!-- ============================================================== -->

                <div class="row d-flex justify-content-center add_size" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add Size</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Product&function=add_sizedata" method="post">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Size Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control add-size" name="size" placeholder="Size Name">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Size</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end Add Size  -->
                <!-- Update Size  -->
                <!-- ============================================================== -->

                <div class="row d-flex justify-content-center update_size" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Update Size</h5>
                            <div class="card-body">
                                <form id="validate_form1" action="?controller=Product&function=update_size" method="post">
                                    <div class="form-group">
                                        <input type="hidden" class="size-id" name="size_id">
                                        <label for="inputText3" class="col-form-label">Size Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control size-name" name="size" placeholder="Size Name">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update Size</button>
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
</div>

<?php include("footer.php"); ?>
<script src="./assets/js/size.js"></script>