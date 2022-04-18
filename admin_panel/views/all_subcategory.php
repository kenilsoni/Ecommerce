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
                        <h2 class="pageheader-title">Sub Category</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=all_subcategory" class="breadcrumb-link">Sub Category</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">All SubCategory </li>
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
                <!-- All SubCategory  -->
                <!-- ============================================================== -->
                <?php if (isset($_SESSION['addsubcategory_token'])) {
                    if ($_SESSION['addsubcategory_token']) { ?>
                        <script>
                            setTimeout(() => {
                                document.getElementById("add").style.display = 'none';
                            }, 4000);
                        </script>
                        <div class="alert alert-success alert-dismissible fade show" id=add role="alert">
                            SubCategory added successfully!!.
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
                    unset($_SESSION['addsubcategory_token']);
                } ?>

                <!-- delete alert -->
                <?php if (isset($_SESSION['deletesubcategory_token'])) {
                    if ($_SESSION['deletesubcategory_token']) { ?>
                        <script>
                            setTimeout(() => {
                                document.getElementById("delete").style.display = 'none';
                            }, 4000);
                        </script>
                        <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                            SubCategory deleted successfully!!.
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
                            SubCategory already assigned to the product!!.
                            <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </a>
                        </div>
                <?php }
                    unset($_SESSION['deletesubcategory_token']);
                } ?>
                <!-- update alert -->

                <?php if (isset($_SESSION['updatesubcategory_token'])) {
                    if ($_SESSION['updatesubcategory_token']) { ?>
                        <script>
                            setTimeout(() => {
                                document.getElementById("update").style.display = 'none';
                            }, 4000);
                        </script>
                        <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                            SubCategory updated successfully!!.
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
                    unset($_SESSION['updatesubcategory_token']);
                } ?>
                <div class="col-12 subcategory_data">
                    <div class="mb-2"><a href="?controller=Admin&function=add_subcategory" class="btn btn-primary active">Add SubCategory</a></div>
                    <div class="card">
                        <h5 class="card-header">All SubCategory</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="subcategory_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>SubCategory Name</th>
                                            <th>Created Date</th>
                                            <th>Modify Date</th>
                                            <th style="width:124px">Action</th>
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
                <!-- End ALL Subcategory  -->
                <!-- Update SubCategory -->
                <div class="row d-flex justify-content-center update_subcategory" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Update SubCategory</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=SubCategory&function=update_subcategory" method="post">
                                    <div class="form-group">
                                        <input type="hidden" class="update_id" name="update_id">
                                        <label for="Category">Category</label><span class="star">*</span><br>
                                        <select class="form-control category_id" name="Category" id="Category">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3">Sub Category</label><span class="star">*</span><br>
                                        <input id="inputText3" type="text" class="form-control subcategory_input" name="subcategory_name" placeholder="SubCategory Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label><span class="star">*</span>
                                        <textarea class="form-control" name="desc_subcategory" id="subcategory_desc" rows="3" id="exampleFormControlTextarea1" placeholder="Description"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update SubCategory</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
<script src="./assets/js/subcategory.js"></script>