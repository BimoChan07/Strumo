<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">

            <li class="nav-item d-none d-sm-inline-block hov">
                <a href="#" class="nav-link text-white-50">Home</a>
            </li>
            <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="../contact.php" class="nav-link">Contact</a>
        </li> -->
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            </li>
            <!-- Notifications Dropdown Menu -->
            <li>
                <a class="nav-link text-white-50" href="#">
                    <i class="far fa-user text-white-50"></i> <?php echo $_SESSION['admin']; ?>
                </a>
            </li>
            <li class="info">
                <a class="nav-link text-white-50 font" href="./logout.php">
                    <i class="fa fas-sign-out-alt text-white-50" aria-hidden="true"></i>Logout
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link" style="text-decoration:none ;">
            <img src="../assets/images/logos/weblogo.png" alt="Strumo Logo" class="brand-image bg-white img-circle elevation-3" style="opacity: 0.8" />
            <span class="brand-text  font">STRUMO</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <i class="fa fa-user-alt text-white-50"></i>
                </div>
                <div class="info">
                    <a href="#" class="nav-item myA d-block font"><?php echo $_SESSION['admin']; ?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="./dashboard.php" class="d-block nav-link font">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./add-product.php" class="d-block nav-link font">
                            <i class="nav-icon fas fa-upload"></i>
                            <p>
                                Add Product
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./manageprod.php" class="nav-link font">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Manage Product
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./manageUsr.php" class="d-block nav-link font">
                            <i class="nav-icon fas fa-user-edit"></i>
                            <p>
                                Manage User
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>