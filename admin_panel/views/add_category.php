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
                        <h2 class="pageheader-title">Category</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=all_category" class="breadcrumb-link">Category</a></li>
                                    <li class="breadcrumb-item active " aria-current="page">Add Category </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <!-- Add category  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
                <div class="row d-flex justify-content-center">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add Category</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Category&function=addcategory" method="post">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Category Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control category_name" name="category_name" placeholder="Category Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label><span class="star">*</span>
                                        <textarea class="form-control" name="desc_category" id="category_desc" rows="3" id="exampleFormControlTextarea1" placeholder="Description"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end Add category  -->
        </div>
    </div>
</div>
</div>
<?php include("footer.php"); ?>
<script src="./assets/js/category.js"></script>