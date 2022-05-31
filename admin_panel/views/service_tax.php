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
                        <h2 class="pageheader-title">Service tax</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?controller=Admin&function=service_tax" class="breadcrumb-link">Service tax</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add tax </li>
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
                <!--  tax detail -->
                <!-- ============================================================== -->
                <div class="col-12 state_data">
                    <div class="mb-2">
                        <?php if (isset($_SESSION['addtax_token'])) {
                            if ($_SESSION['addtax_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("add").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="add" role="alert">
                                    Tax added successfully!!.
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
                            unset($_SESSION['addtax_token']);
                        } ?>

                        <!-- delete alert -->
                        <?php if (isset($_SESSION['deletetax_token'])) {
                            if ($_SESSION['deletetax_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("delete").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="delete" role="alert">
                                    Tax deleted successfully!!.
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
                            unset($_SESSION['deletetax_token']);
                        } ?>
                        <!-- update alert -->

                        <?php if (isset($_SESSION['updatetax_token'])) {
                            if ($_SESSION['updatetax_token']) { ?>
                                <script>
                                    setTimeout(() => {
                                        document.getElementById("update").style.display = 'none';
                                    }, 4000);
                                </script>
                                <div class="alert alert-success alert-dismissible fade show" id="update" role="alert">
                                    Tax updated successfully!!.
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
                            unset($_SESSION['updatetax_token']);
                        } ?>
                        <a href="#" class="btn btn-primary active add_taxbtn">Add tax</a>
                    </div>
                    <div class="card">
                        <h5 class="card-header">All Details</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first" id="tax_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>Service Tax(%)</th>
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
                <!-- end tax detail  -->
                <!-- add tax -->
                <div class="row d-flex justify-content-center add_state" style="display:none!important">
                    <div class="col-10">
                        <div class="card">
                            <h5 class="card-header">Add Tax</h5>
                            <div class="card-body">
                                <form id="validate_form" action="?controller=Address&function=add_taxdata" method="post">
                                    <div class="form-group">
                                        <label for="Country">Select Country</label><span class="star">*</span><br>
                                        <select class="form-control Country" name="cid">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Country">Select State</label><span class="star">*</span><br>
                                        <select class="form-control State" name="state">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText31" class="col-form-label">Country Code</label><span class="star">*</span>
                                        <input id="inputText31" type="text" class="form-control add-tax" name="ccode" placeholder="Country Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText21" class="col-form-label">State Code</label><span class="star">*</span>
                                        <input id="inputText21" type="text" class="form-control add-tax" name="scode" placeholder="State Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Tax Percent(%)</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control add-tax" name="tax" placeholder="Tax"  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Quantity"  min="1" max="99999">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block tax_add">Add Tax</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end Add tax  -->
            <!-- update tax -->
            <div class="row d-flex justify-content-center update_state" style="display:none!important">
                <div class="col-10">
                    <div class="card">
                        <h5 class="card-header">Update Tax</h5>
                        <div class="card-body">
                        <form id="validate_form1" action="?controller=Address&function=update_tax" method="post">
                                    <div class="form-group">
                                        <input type="hidden" class="tax_id" name="tax_id"/>
                                        <label for="Country">Select Country</label><span class="star">*</span><br>
                                        <select class="form-control Country" name="cid">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="State">Select State</label><span class="star">*</span><br>
                                        <select class="form-control State" name="state">
                                            <option value="" selected>Select</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputText3" class="col-form-label">Tax Percent(%)</label><span class="star">*</span>
                                        <input id="inputText3" type="text" class="form-control add-tax" class="tax" name="tax" placeholder="Tax">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Update Tax</button>
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
<script src="./assets/js/tax.js"></script>