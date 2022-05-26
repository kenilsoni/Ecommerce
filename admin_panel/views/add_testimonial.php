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
                        <h2 class="pageheader-title">Testimonial</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=add_testimonial" class="breadcrumb-link">Testimonial</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">Add Testimonial </li>
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
                <!--  testimonial detail -->
                <!-- ============================================================== -->
                <div class="col-12 testimonial_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addtestimonial_token'])) {
                            if ($_SESSION['addtestimonial_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Testimonial added successfully!!.
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
                            unset($_SESSION['addtestimonial_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deletetestimonial_token'])) {
                            if ($_SESSION['deletetestimonial_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    Testimonial deleted successfully!!.
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
                            unset($_SESSION['deletetestimonial_token']);
                        } ?>
                        <!-- update alert -->

                        <?php if (isset($_SESSION['updatetestimonial_token'])) {
                            if ($_SESSION['updatetestimonial_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("update").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                                    Testimonial updated successfully!!.
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
                            unset($_SESSION['updatetestimonial_token']);
                        } ?>


                        <a href="#" class="btn btn-primary active add_testimonialbtn">Add Testimonial</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All Testimonial</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="testimonial_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Description</th>
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
                <!-- end testimonial detail  -->
                <!-- add testimonial -->
                <div class="row d-flex justify-content-center add_testimonial" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add Testimonial</h5>
                            <div class="card-body">
                                <form  action="?controller=Admin&function=add_testimonialdata" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control testimonial-name" name="name" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText4" class="col-form-label">Designation</label><span class="star">*</span>
                                        <input id="inputText4" type="text" class="form-control testimonial-name" name="designation" placeholder="Designation" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText5" class="col-form-label">Description</label><span class="star">*</span>
                                        <input id="inputText5" type="text" class="form-control testimonial-name" name="desc" placeholder="Description" required>
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
                                    <button type="submit" class="btn btn-primary btn-block">Add Testimonial</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- update testimonial -->
                <div class="row d-flex justify-content-center update_testimonial" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Update Testimonial</h5>
                            <div class="card-body">
                                <form  action="?controller=Admin&function=update_testimonialdata" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" name="id" class="testimonial_id"/>
                                        <input type="hidden" name="is_change" class="is_change"/>
                                        <label for="inputText3" class="col-form-label">Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control name" name="name" placeholder="Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText4" class="col-form-label">Designation</label><span class="star">*</span>
                                        <input id="inputText4" type="text" class="form-control designation" name="designation"  placeholder="Designation" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText5" class="col-form-label">Description</label><span class="star">*</span>
                                        <input id="inputText5" type="text" class="form-control desc" name="desc"  placeholder="Description" required>
                                    </div>
                                    <div class="custom-file mb-3">
                                    <label class="custom-file-label form-control" for="chooseFile">Choose Image</label>
                                        <input type="file" name="files_image[]" accept=".jpg , .png , .jpeg " class="custom-file-input" id="files_image2" >
                                        
                                    </div>
                                    <div class="mb-2">
                                        <h4 class="upload-img">Uploaded Images</h4>
                                        <div class="imgGallery" style="width:100px;">
                                            <!-- image preview -->
                                        </div>
                                    </div>
                                    <div class="mb-2" id="image_block">
                                        <h4>Available Images</h4>
                                        <div class="available_image" style="width:100px;">

                                            <!-- image preview -->
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update Testimonial</button>
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
<script src="./assets/js/testimonial.js"></script>