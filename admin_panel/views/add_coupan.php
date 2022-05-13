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
                        <h2 class="pageheader-title">Coupan</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=add_coupan" class="breadcrumb-link">Coupan</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">Add Coupan </li>
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
                <!--  coupan detail -->
                <!-- ============================================================== -->
                <div class="col-12 coupan_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addcoupan_token'])) {
                            if ($_SESSION['addcoupan_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Coupan added successfully!!.
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
                            unset($_SESSION['addcoupan_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deletecoupan_token'])) {
                            if ($_SESSION['deletecoupan_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    Coupan deleted successfully!!.
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
                            unset($_SESSION['deletecoupan_token']);
                        } ?>
                       

                        <a href="#" class="btn btn-primary active add_coupanbtn">Add Coupan</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All Coupan</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="coupan_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Coupan ID</th>
                                            <th>Discount</th>
                                            <th>Created Date</th>
                                            <th>Expired Date</th>                                       
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
                <!-- end coupan detail  -->
                <!-- add coupan -->
                <div class="row d-flex justify-content-center add_coupan" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add Coupan</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Admin&function=add_coupandata" method="post">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Discount</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control coupan-name" name="coupan" placeholder="Discount" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Duration(In Months)</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control coupan-name" name="duration" placeholder="Duration" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Coupan</button>
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
<script src="./assets/js/coupan.js"></script>