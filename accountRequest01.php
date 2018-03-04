<?php

require_once(__DIR__.'/../mysql_connect.php');

session_start();
$id = $_GET['id'];
if (isset($_POST['update'])){
    $queryA = "SELECT * FROM ClientAccount WHERE CompanyID = '\"{$id}\" ";
    $resultA = mysqli_query($dbc, $queryA);
    if ($rowA = mysqli_fetch_array($resultA, MYSQLI_ASSOC)){
        if (isset($_POST['qty'])){
            $qty = $_POST['qty'];
            $totalAmt = $qty * $rowA['OPrice'];

            $query = "UPDATE `Orders` SET OQuantity = '".$qty."', OTotalAmount = '".$totalAmt."' WHERE OrderID = '".$orderID."'; ";
            $result = mysqli_query($dbc, $query);
        }
        if (isset($_POST['price'])){
            $price = $_POST['price'];
            $totalAmt = intval($price) * intval($rowA['OQuantity']);

            $query = "UPDATE `Orders` SET OPrice = '".$price."', OTotalAmount = '".$totalAmt."' WHERE OrderID = '".$orderID."'; ";
            $result = mysqli_query($dbc, $query);
        }
        if (isset($_POST['orderDate'])){
            $orderDate = $_POST['orderDate'];

            $query = "UPDATE `Orders` SET OOrderedDate = '".$orderDate."' WHERE OrderID = '".$orderID."'; ";
            $result = mysqli_query($dbc, $query);
        }
        if (isset($_POST['requireDate'])){
            $requireDate = $_POST['requireDate'];

            $query = "UPDATE `Orders` SET ORequiredDate = '".$requireDate."' WHERE OrderID = '".$orderID."'; ";
            $result = mysqli_query($dbc, $query);
        }
        if (isset($_POST['payDate'])){
            $payDate = $_POST['payDate'];

            $query = "UPDATE `Orders` SET OPaymentDate = '".$payDate."', OPaymentStatus = 'Paid' WHERE OrderID = '".$orderID."'; ";
            $result = mysqli_query($dbc, $query);
        }
        if (isset($_POST['startDate'])){
            $startDate = $_POST['startDate'];

            $query = "UPDATE `Orders` SET StartManufacturing = '".$startDate."', ManufacturingStatus = 'In Progress' WHERE OrderID = '".$orderID."'; ";
            $result = mysqli_query($dbc, $query);
        }
        else if (isset($_POST['endDate'])){
            $endDate = $_POST['endDate'];
            $query = "UPDATE `Orders` SET EndManufacturing = '".$endDate."', ManufacturingStatus = 'Completed' WHERE OrderID = '".$orderID."'; ";
            $result = mysqli_query($dbc, $query);

        }
        else if (isset($_POST['shipDate'])){
            $shipDate = $_POST['shipDate'];

            $query = "UPDATE `Orders` SET OShippedDate = '".$shipDate."', OShipmentStatus = 'Shipped', OrderStatus = 'Completed' WHERE OrderID = '".$orderID."'; ";
            $result = mysqli_query($dbc, $query);
        }
    }
}

if (isset($_POST['accept'])){    
    $sql = "UPDATE ClientAccount SET AccountStatus = 'Accepted' WHERE CName = \"{$id}\" ";
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/activateAccounts.php");
                
}
else if (isset($_POST['reject'])){
    $sql = "UPDATE ClientAccount SET AccountStatus = 'Rejected' WHERE CName = \"{$id}\" ";
	header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/accountRequests.php");
}

if (!empty($sql)){
    $qu = mysqli_query($dbc, $sql);
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Account request: <?php echo $id; ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="home2.html" class="simple-text">
                    DOLLJOY
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="prodManDashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="accountRequests.php">
                        <i class="pe-7s-add-user"></i>
                        <p>Account Requests</p>
                    </a>
                </li>
                <li>
                    <a href="activateAccounts.php">
                        <i class="pe-7s-unlock"></i>
                        <p>Activate Accounts</p>
                    </a>
                </li>
                <li>
                    <a href="addEmployee.php">
                        <i class="pe-7s-id"></i>
                        <p>Add Employees</p>
                    </a>
                </li>
                <li>
                    <a href="viewAccounts.php">
                        <i class="pe-7s-users"></i>
                        <p>View Accounts</p>
                    </a>
                </li>
                <li>
                    <a href="reviewOrders.php">
                        <i class="pe-7s-search"></i>
                        <p>Review Orders</p>
                    </a>
                </li>
                <li>
                    <a href="dollOrders.php">
                        <i class="pe-7s-menu"></i>
                        <p>Current Doll Orders</p>
                    </a>
                </li>
                <li>
                    <a href="shipment.php">
                        <i class="pe-7s-next-2"></i>
                        <p>Payment and Shipment</p>
                    </a>
                </li>
                <li>
                    <a href="completedDollOrders1.php">
                        <i class="pe-7s-notebook"></i>
                        <p>Completed Doll Orders</p>
                    </a>
                </li>
                <li>
                    <a href="orderFromSuppliers.php">
                        <i class="pe-7s-drawer"></i>
                        <p>Supply Orders</p>
                    </a>
                </li>
                <li>
                    <a href="addSuppliers.php">
                        <i class="pe-7s-cart"></i>
                        <p>Add Suppliers</p>
                    </a>
                </li>
                <li>
                    <a href="receiveInventory.php">
                        <i class="pe-7s-box1"></i>
                        <p>Inventory</p>
                    </a>
                </li>
                <li>
                    <a href="generateSalesReport.php">
                        <i class="pe-7s-display1"></i>
                        <p>Generate Sales Report</p>
                    </a>
                </li>
                <li>
                <a href="addNewDoll.php">
                        <i class="pe-7s-magic-wand"></i>
                        <p>Add New Doll</p>
                    </a>
              </li>
              <li>
                <a href="gallery.php">
                        <i class="pe-7s-look"></i>
                        <p>View Premade Dolls</p>
                    </a>
              </li>
              <li>
              <a href="createNewSpec.php">
                        <i class="pe-7s-next-2"></i>
                        <p>Create New Doll Specification</p>
                    </a>
              </li>
              <li>
              <a href="createNewSpecValue.php">
                        <i class="pe-7s-network"></i>
                        <p>Create Specification Choices</p>
                    </a>
              </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
  
                        <!----------------------- START NOTIFICATIONS --------------------------------------------------------------->
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span class="notification hidden-sm hidden-xs">
                                    <?php
                                        
                                        ////notif pending account
                                    $queryacct="SELECT CompanyID as 'acct' FROM clientaccount WHERE AccountStatus='Pending'";
                                    $resultacct=mysqli_query($dbc,$queryacct);
                                    $acct = $resultacct->num_rows;
                                       
                                        ////notif pending order
                                    $queryorder="SELECT OrderID as 'orderid' FROM orders WHERE OrderStatus='Pending'";
                                    $resultorder=mysqli_query($dbc,$queryorder);
                                    $order = $resultorder->num_rows;
                                        
                                        //notif order ready for shipping
                                    $queryship="SELECT OrderID as 'ship' FROM orders WHERE ManufacturingStatus = 'Completed' && OShipmentStatus='Not shipped'";
                                    $resultship=mysqli_query($dbc,$queryship);
                                    $ship= $resultship->num_rows;
                                        
                                        //notif order ready for payment
                                    $querypay="SELECT OrderID as 'pay' FROM orders WHERE OrderStatus='Approved' AND OPaymentStatus='Unpaid'";
                                    $resultpay=mysqli_query($dbc,$querypay);
                                    $pay= $resultpay->num_rows;
                                        
                                        //notif supplies
                                    $queryrcv="SELECT SupplyID as 'supplies' FROM supplies WHERE DateReceived IS NULL";
                                    $resultrcv=mysqli_query($dbc,$queryrcv);
                                    $rcv= $resultrcv->num_rows;
                                    
                                    $total = $acct + $order + $ship + $rcv + $pay;
                                    if (($acct + $order + $ship + $rcv + $pay) > 0)
                                        echo $total;
                                    ?>
                                    
                                    </span>
                                    <p class="hidden-lg hidden-md">
                                        <b class="caret"></b>
                                    </p>
                              </a>
                            
                            
                            
                            
                              <ul class="dropdown-menu">
                                  <?php
                                  
                                  //APPROVE OR REJECT CLIENT ACCOUNTS
                                  if ($acct == 0){
                                      echo "";
                                  }
                                  else if ($acct == 1){
                                      echo "<li><a href='approveClientAccounts.php'>There is a client account pending for approval</a></li>";
                                  }
                                  else if ($acct > 1){
                                      echo "<li><a href='approveClientAccounts.php'>There are client accounts pending for approval</a></li>";
                                  }
                                  
                                  //APPROVE OR REJECT ORDERS
                                  if ($order == 0){
                                      echo "";
                                  }
                                  else if ($order == 1){
                                      echo "<li><a href='reviewOrders.php'>There is an order pending for approval</a></li>";
                                  }
                                  else if ($order > 1){
                                      echo "<li><a href='reviewOrders.php'>There are orders pending for approval</a></li>";
                                  }
                                  
                                  //CONFIRM SHIPPING
                                  if ($ship == 0){
                                      echo "";
                                  }
                                  else if ($ship == 1){
                                      echo "<li><a href='shipment.php'>There is an order ready for shipping</a></li>";
                                  }
                                  else if ($ship > 1){
                                      echo "<li><a href='shipment.php'>There are orders ready for shipping</a></li>";
                                  }
                                  
                                  //PENDING PAYMENT
                                  if ($pay == 0){
                                      echo "";
                                  }
                                  else if ($pay == 1){
                                      echo "<li><a href='shipment.php'>There is an order pending payment</a></li>";
                                  }
                                  else if ($pay > 1){
                                      echo "<li><a href='shipment.php'>There are orders pending payment</a></li>";
                                  }
                                  
                                  //RECEIVE INVENTORY
                                  if ($rcv == 0){
                                      echo "";
                                  }
                                  else if ($rcv == 1){
                                      echo "<li><a href='receiveInventory.php'>There is a supply waiting to be received</a></li>";
                                  }
                                  else if ($rcv > 1){
                                      echo "<li><a href='receiveInventory.php'>There are supplies waiting to be received</a></li>";
                                  }
                                  
                                  
                                  ?>
                                  
                                
                              </ul>
                        </li>
                        
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                                <p class="hidden-lg hidden-md">Search</p>&nbsp;&nbsp;&nbsp;
                                <input type="textarea" placeholder="Search...">
                            </a>
                        </li>
                    </ul>
                        
                        
 <!----------------------- END NOTIFICATIONS --------------------------------------------------------------->

                    <ul class="nav navbar-nav navbar-right">
                       
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
                                        Website
                                        <b class="caret"></b>
                                    </p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="home2.html">Home</a></li>
                                <li><a href="FAQ2.html">F.A.Q.</a></li>
                                <li><a href="gallery.php">Gallery</a></li>
                                <li><a href="services2.php">Services</a></li>
                                <li><a href="contact2.html">Contact</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="home.html">
                                <p>Log out</p>
                            </a>
                        </li>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Account request: <?php echo $id; ?> </h4>
                        <!--<p class="category">View, edit, and keep track of order specifications.</p>-->

                        <br>

                        <!--<h5>Company details</h5>-->

                        <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>E-mail</th>
                                    </thead>
                                    
                                        
<?php

require_once('../mysql_connect.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT *
              FROM   ClientAccount WHERE CName = \"".$id."\"; ";
    $result=mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result);
    
echo 
"
<tbody>
<tr>

<td>{$row['CName']}</a></td>
<td>{$row['CAddress']}</td>
<td>{$row['CContactNo']}</td>
<td>{$row['CEmailAdd']}</td>

</tr>
</tbody>
"
;

}

echo '</table>';

?>
                                  
                        <br>

                        <!--<h5>Representative details</h5>-->

                        <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Representative</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>E-mail</th>
                                    </thead>
                                    <tbody>

<?php

require_once('../mysql_connect.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT *
              FROM   ClientAccount WHERE CName = \"".$id."\"; ";
    $result=mysqli_query($dbc,$query);
    $row = mysqli_fetch_array($result);



    echo 
    "
    <tr>
    <td>{$row['CRepName']}</div></td>

    <td>{$row['CRepAddress']}</div></td>

    <td>{$row['CRepContactNo']}</div></td>

    <td>{$row['CRepEmailAdd']}</div></td>

    </tr>
    </tbody>
    ";
}


echo '</table>';

?>

<br><br>

<form action = "accountRequest01.php?id=<?php echo $id; ?>" method = "POST">
    <button type="submit" name = "accept" class="btn btn-success btn-fill pull-left">Accept Request</button>
    <button type="submit" name = "reject" class="btn btn-danger btn-fill pull-left">Reject Request</button></form>
    <a href="accountRequests.php"><button type="submit" class="btn btn-warning btn-fill pull-right">Back to Account Requests</button></a>


<br><br><br>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                   
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="home2.html">Dolljoy</a>, designed by Before You Exit
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

        <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

</html>