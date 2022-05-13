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
                        <h2 class="pageheader-title">Contact</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=add_contact" class="breadcrumb-link">Contact</a></li>
                                    <li class="breadcrumb-item active page_name" aria-current="page">Contact Details</li>
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
                <!--  Contact Details  -->
                <div class="col-12 contact_detail">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['sendreply_token'])) {
                            if ($_SESSION['sendreply_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Reply send successfully!!.
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
                                    Sorry reply is not sent!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                        <?php }
                            unset($_SESSION['sendreply_token']);
                        } ?>

                        
                    </div>
                    <div class="card">
                        <h5 class="card-header">All Contact</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="contact_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Subject</th>
                                            <th >Message</th>
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
                <!-- End Contact Details  -->
                <!-- reply modal -->
                <!-- Modal -->
                <div class="modal fade" id="replymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" action="?controller=Admin&function=reply_contact">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" class="id">
                                <input type="hidden" name="email_id" class="email_id">
                            <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Reply</label><span class="star">*</span>
                                        <textarea class="form-control" name="reply" id="exampleFormControlTextarea1 product_desc" rows="5" required></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
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
<script src="./assets/js/contact.js"></script>