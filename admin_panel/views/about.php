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
                        <h2 class="pageheader-title">About</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=all_about" class="breadcrumb-link">About</a></li>
                                    <li class="breadcrumb-item active " aria-current="page">About Data </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <!-- Add about  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
                <div class="row d-flex justify-content-center">
                    <div class="col-10">
                        <div class="mb-2">
                            <?php if (isset($_SESSION['addabout_token'])) {
                                if ($_SESSION['addabout_token']) { ?>
                                    <script>
                                        setTimeout(() => {
                                            document.getElementById("add").style.display = 'none';
                                        }, 4000);
                                    </script>
                                    <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                        Data updated successfully!!.
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
                                unset($_SESSION['addabout_token']);
                            } ?>
                        </div>
                        <div class="card">
                            <h5 class="card-header">All Details</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Admin&function=update_about" method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label><span class="star">*</span>
                                        <textarea class="form-control" name="content" id="editor"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update About</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end Add about  -->
        </div>
    </div>
</div>
</div>

<?php include("footer.php"); ?>
<script src="./ckeditor/ckeditor.js"></script>
<script>
     
    CKEDITOR.replace('editor');
                    
    function onload() {
        $.ajax({
            type: "GET",
            url: "?controller=Admin&function=get_about",
            datatype: "json",
            success: function(data) {
                obj = JSON.parse(data);
                if (typeof obj === "object") {
                    console.log(obj)
                    var html=obj[0]['data']
                    CKEDITOR.instances['editor'].setData(html);
                }
            }
        })

    }
    onload(); 
</script>