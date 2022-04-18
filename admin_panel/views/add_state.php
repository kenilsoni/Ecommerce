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
                        <h2 class="pageheader-title">State</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=add_state" class="breadcrumb-link">State</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add State </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader  -->
            <!-- ============================================================== -->
            <!-- Add product  -->
            <!-- ============================================================== -->
            <div class="ecommerce-widget">
                <!--  state detail -->
                <!-- ============================================================== -->
                <div class="col-12 state_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addstate_token'])) {
                            if ($_SESSION['addstate_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    State added successfully!!.
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
                            unset($_SESSION['addstate_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deletestate_token'])) {
                            if ($_SESSION['deletestate_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    State deleted successfully!!.
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
                                    Delete City First!!.
                                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </a>
                                </div>
                        <?php }
                            unset($_SESSION['deletestate_token']);
                        } ?>
                        <!-- update alert -->

                        <?php if (isset($_SESSION['updatestate_token'])) {
                            if ($_SESSION['updatestate_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("update").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                                    State updated successfully!!.
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
                            unset($_SESSION['updatestate_token']);
                        } ?>
                        <a href="#" class="btn btn-primary active add_statebtn">Add State</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All State</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="state_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Country</th>
                                            <th>State</th>
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
                <!-- end state detail  -->
                <!-- add state -->
                <div class="row d-flex justify-content-center add_state" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add State</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Address&function=add_statedata" method="post">
                                    <div class="form-group">
                                        <label for="Country">Select Country</label><span class="star">*</span><br>
                                        <select class="form-control Country" name="cid">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">State Name</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control add-state" name="state" placeholder="State Name">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add State</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end Add state  -->
            <!-- update state -->
            <div class="row d-flex justify-content-center update_state" style="display:none!important">
                <div class="col-10">
                    <div class="card">
                        <h5 class="card-header">Update State</h5>
                        <div class="card-body">
                            <form id="validate_form1" action="?controller=Address&function=update_state" method="post">
                                <div class="form-group">
                                    <input type="hidden" class="state-id" name="state_id">
                                    <label for="Country">Select Country</label><span class="star">*</span><br>
                                    <select class="form-control Country" name="cid" id="country_update">
                                        <option value="" selected>Select</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputText3" class="col-form-label">State Name</label><span class="star">*</span>
                                    <input id="inputText3" type="text" class="form-control state-name" name="state" placeholder="State Name">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Update State</button>
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
<script src="./assets/js/state.js"></script>