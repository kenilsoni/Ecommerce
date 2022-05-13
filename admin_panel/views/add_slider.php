<!-- ============================================================== -->
<!-- navbar -->
<!-- ============================================================== -->
<?php include("navbar.php"); ?>
<!-- ============================================================== -->
<!-- end navbar -->
<!-- ============================================================== -->
<?php include("left_sidebar.php"); ?>
<style>
   
    .imgGallery img {
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


    .remove {
        display: block;
        color: white;
        text-align: center;
        cursor: pointer;
    }
</style>
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
                        <h2 class="pageheader-title">All Slider</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=service_slider" class="breadcrumb-link">Slider</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add slider </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <!-- Add slider  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
                <!--  slider detail -->
                <!-- ============================================================== -->
                <div class="col-12 slider_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addslider_token'])) {
                            if ($_SESSION['addslider_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Slider added successfully!!.
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
                            unset($_SESSION['addslider_token']);
                        } ?>

                        <!-- delete alert -->
                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deleteslider_token'])) {
                            if ($_SESSION['deleteslider_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    Slider deleted successfully!!.
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
                            unset($_SESSION['deleteslider_token']);
                        } ?>
                       
                        <a href="#" class="btn btn-primary active add_sliderbtn">Add slider</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All Details</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="slider_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Created_At</th>
                                            
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
                <!-- end slider detail  -->
                <!-- add slider -->
                <div class="row d-flex justify-content-center add_slider" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add slider</h5>
                            <div class="card-body">
                                <form  action="?controller=Admin&function=add_sliderdata" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Description</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control add-slider" name="description" placeholder="Description" required>
                                    </div>

                                    <div class="custom-file mb-3">
                                        <label class="custom-file-label form-control" for="chooseFile">Choose Image</label>
                                        <input type="file" name="files_image[]" accept=".jpg , .png , .jpeg " class="custom-file-input" id="files_image" required>

                                    </div>
                                    <div class="mb-2">
                                        <h4 class="upload-img">Uploaded Images</h4>
                                        <div class="imgGallery" style="width:100px;">
                                            <!-- image preview -->
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Slider</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end Add slider  -->
           
        </div>
    </div>
</div>
</div>

<?php include("footer.php"); ?>
<script src="./assets/js/slider.js"></script>