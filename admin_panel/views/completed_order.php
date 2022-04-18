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
                        <h2 class="pageheader-title">Orders</h2>

                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Orders</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Completed Order </li>
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

                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Completed Order</h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Product ID</th>
                                            <th>Quantity</th>
                                            <th>Customer Name</th>
                                            <th>Address</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>id000001 </td>
                                            <td>2/2/22</td>
                                            <td>id000001 </td>
                                            <td>20</td>
                                            <td>ABC </td>
                                            <td>street 123</td>
                                            <td>20</td>


                                            <td><a href="#" class="btn btn-rounded btn-success">Completed</a> </td>
                                        </tr>
                                        <tr>
                                            <td>id000001 </td>
                                            <td>2/2/22</td>
                                            <td>id000001 </td>
                                            <td>20</td>
                                            <td>ABC </td>
                                            <td>street 123</td>
                                            <td>20</td>

                                            <td><a href="#" class="btn btn-rounded btn-success">Completed</a> </td>
                                        </tr>
                                        <tr>
                                            <td>id000001 </td>
                                            <td>2/2/22</td>
                                            <td>id000001 </td>
                                            <td>20</td>
                                            <td>ABC </td>
                                            <td>street 123</td>
                                            <td>20</td>

                                            <td><a href="#" class="btn btn-rounded btn-success">Completed</a> </td>
                                        </tr>


                                    </tbody>


                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end product  -->

            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>