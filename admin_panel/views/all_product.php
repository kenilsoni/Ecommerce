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
<style>
    .imgGallery img {
        width: 100px;
        height: 100px;
        margin-right: 20px;

    }

    .available_image {
        display: flex;
    }

    .available_image img {
        width: 100px;
        height: 100px;
        margin-right: 20px;

    }

    .imgGallery {
        display: flex;
    }

    .imgGallery span {
        margin-right: 20px;
    }

    .switch-button label:before {
        content: "NO" !important;
    }

    .switch-button input[type=checkbox]:checked+span label:before {
        content: "YES" !important;
    }

    .remove {
        display: block;
        color: white;
        text-align: center;
        cursor: pointer;
    }
</style>
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <!-- ============================================================== -->
            <!-- pageheader  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Products</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=all_product" class="breadcrumb-link">Products</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">All Product </li>
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
                <!-- All products  -->
                <!-- ============================================================== -->

                <div class="col-12 product_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addproduct_token'])) {
                            if ($_SESSION['addproduct_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Product added successfully!!.
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
                            unset($_SESSION['addproduct_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deleteproduct_token'])) {
                            if ($_SESSION['deleteproduct_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    Product deleted successfully!!.
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
                            unset($_SESSION['deleteproduct_token']);
                        } ?>
                        <!-- update alert -->

                        <?php if (isset($_SESSION['updateproduct_token'])) {
                            if ($_SESSION['updateproduct_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("update").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                                    Product updated successfully!!.
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
                            unset($_SESSION['updateproduct_token']);
                        } ?>
                        <a href="?controller=Admin&function=add_product" class="btn btn-primary active">Add Product</a>
                    </div>
                    <div class="card">

                        <h5 class="card-header">All Product </h5>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="product_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th style="width:115px">Created Date</th>
                                            <th style="width:115px">Modify Date</th>
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
                <!-- end product  -->
                <!-- update product -->
                <div class="row d-flex justify-content-center update_product" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Update Product</h5>
                            <div class="card-body">
                                <form action="?controller=Product&function=update_productdata" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <input type="hidden" class="product-id" name="id">
                                        <label for="inputText1" class="col-form-label">Product Name</label><span class="star">*</span>
                                        <input id="inputText1" type="text" class="form-control product_name" name="product_name" placeholder="Product Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Product Description</label><span class="star">*</span>
                                        <textarea class="form-control product_desc" name="product_desc" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText4" class="col-form-label">Price (Per Unit)</label><span class="star">*</span>
                                        <input id="inputText4" type="number" name="product_price" class="form-control product_price" placeholder="Price" min="0" max="99999" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText6" class="col-form-label">Quantity</label><span class="star">*</span>
                                        <input id="inputText6" type="number" name="product_quantity" class="form-control product_quantity" placeholder="Quantity" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Category">Category</label><span class="star">*</span><br>
                                        <select class="form-control product_category" name="product_category" id="Category" required>
                                            <option value="" selected>Select</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Sub_Category">Sub Category</label><span class="star">*</span><br>
                                        <select class="form-control product_subcategory" name="product_subcategory" id="Sub_Category" required>
                                            <option value="" selected>Select</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">IsTrending</label>
                                        <div>
                                            <div class="switch-button switch-button-success">
                                                <input type="checkbox" name="istrend" id="switch16"><span>
                                                    <label for="switch16"></label></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="product_color">Product Color</label><span class="star">*</span><br>
                                        <select class="form-control  selectpicker" id="product_color" name="product_color[]" multiple required>
                                            <?php
                                            session_start();
                                            $success = $_SESSION['color'];
                                            $update = explode(",", $_SESSION['color_update']);
                                            foreach ($success as $val) { ?>
                                                <option value="<?php echo $val['ID'] ?>" <?php if (in_array($val['ID'], $update)) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $val['Product_Color'] ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product_size">Product Size</label><span class="star">*</span><br>
                                        <select class="form-control selectpicker" id="product_size" name="product_size[]" multiple required>
                                            <?php
                                            session_start();
                                            $success = $_SESSION['size'];
                                            $size = explode(",", $_SESSION['size_update']);
                                            foreach ($success as $val) { ?>
                                                <option value="<?php echo $val['ID'] ?>" <?php if (in_array($val['ID'], $size)) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $val['Product_Size'] ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="custom-file mb-3">

                                        <input type="file" name="files_image[]" accept="image/*" class="custom-file-input" id="files_image" multiple>
                                        <label class="custom-file-label form-control" for="chooseFile">Choose Image</label>

                                    </div>
                                    <div class="mb-2">
                                        <h4 class="upload-img ">Uploaded Images</h4>
                                        <div class="imgGallery" style="width:100px;">
                                            <!-- image preview -->
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <h4>Available Images</h4>
                                        <div class="available_image" style="width:100px;">

                                            <!-- image preview -->
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update Product</button>
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

<script src="./assets/js/product.js"></script>
<script src="./assets/vendor/bootstrap-select/js/bootstrap-select.js"></script>