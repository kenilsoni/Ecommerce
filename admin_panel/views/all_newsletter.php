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
                        <h2 class="pageheader-title">NewsLetter</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=all_newsletter" class="breadcrumb-link">NewsLetter</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">All NewsLetter </li>
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
                <!--  newsletter detail -->
                <!-- ============================================================== -->
                <div class="col-12 newsletter_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['add_token'])) {
                            if ($_SESSION['add_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    NewsLetter added successfully!!.
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
                            unset($_SESSION['add_token']);
                        } ?>
                          <!-- delete alert -->
                          <?php if (isset($_SESSION['delete_nl'])) {
                            if ($_SESSION['delete_nl']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    NewsLetter deleted successfully!!.
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
                                    Something went wrong!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                        <?php }
                            unset($_SESSION['delete_nl']);
                        } ?>
                        <a href="#" class="btn btn-primary active add_newsletterbtn">Add NewsLetter</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All NewsLetter</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="newsletter_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Created Date</th>
                                            <th>Action</th>                                        
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end newsletter detail  -->
                <!-- add newsletter -->
                <div class="row d-flex justify-content-center add_newsletter" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add NewsLetter</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Admin&function=add_newsletterdata" method="post">
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Title</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control newsletter-name" name="title" placeholder="Title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText4" class="col-form-label">Description</label><span class="star">*</span>
                                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1 product_desc" rows="3" placeholder="Description" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add NewsLetter</button>
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
<script src="./assets/js/newsletter.js"></script>