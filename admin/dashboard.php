<?php
session_start();
$_SESSION['user'];

require_once("../classes/User.php");
$user = new User;
$count_user = $user->count_user();

require_once("../classes/Item.php");
$item = new Item;
$instock_item = $item->count_instock_item();
$outofstock_item = $item->count_outofstock_item();

require_once("../classes/Order.php");
$order = new Order;
$waiting_for_payemnt = $order->count_waiting_for_payment();
$received_payment = $order->count_received_payment();
$in_transit = $order->count_in_transit();
$waiting_for_receiving = $order->count_waiting_for_receiving();
$request_for_return = $order->count_request_for_return();
$waiting_for_return = $order->count_waiting_for_return();
$count_returning = $order->count_returning();
$count_no_item_received = $order->count_no_item_received();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <span class="sidebar-brand d-flex align-items-center justify-content-center text-white">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN PAGE</div>
      </span>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="order/list.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Orders</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="user/list.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Members</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="category/list.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Categories</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="item/list.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Items</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="payment/list.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Payments</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user']; ?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

          <!-- Shop Status -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100">
              <div id="order-status" class="card rounded border-0 h-100">
                  <h4 class="card-header text-center">Shop Status</h4>

                <div class="card-body p-0">
                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                            <div class="col-2 align-middle text-center"><i class="fa fa-users fa-2x text-secondary" aria-hidden="true"></i></div>
                              <div class="col align-middle">
                                  <span class="align-middle">Number of Members</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $count_user['users']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                            <div class="col-2 align-middle text-center"><i class="fa fa-cubes fa-2x text-secondary" aria-hidden="true"></i></div>
                              <div class="col align-middle">
                                  <span class="align-middle">In Stock Items</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $instock_item['items']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                        <div class="row align-items-center">
                          <div class="col-2 align-middle text-center"><i class="fa fa-inbox fa-2x text-secondary" aria-hidden="true"></i></div>
                              <div class="col align-middle">
                                  <span class="align-middle">Out of Stock Items</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $outofstock_item['items']; ?></span>
                              </div>
                          </div>
                        </div>
                    </div>
                </div> <!-- end of card body-->
              </div>
            </div> <!-- end of class -->
          </div> <!-- end of col -->

            <!-- Order Status -->
            <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100">
              <div id="order-status" class="card rounded border-0 h-100">
                <a href="#" class="text-secondary">
                  <h4 class="card-header text-center">Order Status</h4>
                </a>

                <div class="card-body p-0">
                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                              <div class="col align-middle">
                                  <span class="align-middle">Waiting for Payment</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $waiting_for_payemnt['count']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                              <div class="col align-middle">
                                  <span class="align-middle">Received Payment</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $received_payment['count']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                              <div class="col align-middle">
                                  <span class="align-middle">In Transit</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $in_transit['count']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                              <div class="col align-middle">
                                  <span class="align-middle">Waiting for Receiving</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $waiting_for_receiving['count']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                              <div class="col align-middle">
                                  <span class="align-middle">Request for Return</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $request_for_return['count']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                              <div class="col align-middle">
                                  <span class="align-middle">Waiting for Return</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $waiting_for_return['count']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                              <div class="col align-middle">
                                  <span class="align-middle">Returning</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $count_returning['count']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>

                    <div class="d-block border border-top-0 border-left-0 border-right-0">
                      <div class="p-3 d-block">
                          <div class="row align-items-center">
                              <div class="col align-middle">
                                  <span class="align-middle">No Item Received</span>
                              </div>
                              <div class="col-auto text-right align-middle">
                                  <span class="h4 align-middle font-weight-normal text-dark"><?php echo $count_no_item_received['count']; ?></span>
                              </div>
                          </div>
                      </div>
                    </div>
                </div> <!-- end of card body-->
              </div>
            </div> <!-- end of class -->
          </div> <!-- end of col -->

          </div> <!-- end of row -->
        </div>
      <!-- End of container fluid -->

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>
</html>