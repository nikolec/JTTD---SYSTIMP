<?php

require_once(__DIR__.'/../mysql_connect.php');

session_start();



$msg="";
$message="";
$count="";

if (isset($_POST['submit'])){
        $message=NULL;





        
          $productType="PreMade";
          $dollName=$_POST['dollName'];
          //$dollImage=$_POST['dollImage'];
          $dollDescription=$_POST['dollDescription'];
          $dollGender=$_POST['dollGender'];
          $dollSize=$_POST['dollSize'];
           

           //choice1
       if(!isset($_FILES['dollImage']) || $_FILES['dollImage']['error'] == UPLOAD_ERR_NO_FILE) {
            $message="Please upload a display image for the doll.";
        }
        else{
          $target1 ="images/".basename($_FILES['dollImage']['name']);
          $dollImage = addslashes(file_get_contents($_FILES['dollImage']['tmp_name']));

           if (move_uploaded_file($_FILES['dollImage']['tmp_name'], $target1)) {
                  $msg = "Image uploaded successfully<br>";
           }
           else{
                  $msg = "Failed to upload image<br>";
           }

         }



      if(!isset($message)){
    

          $query="INSERT INTO Product       (ProductType,
                                             ProductName,
                                             ProductImage,
                                             ProductDescription,
                                             ProductGender,
                                             ProductSize)

                              VALUES        ('{$productType}',
                                             '{$dollName}',
                                             '{$dollImage}',
                                             '{$dollDescription}',
                                             '{$dollGender}',
                                             '{$dollSize}')";


          $result=mysqli_query($dbc,$query);


          $lastValueQuery = "SELECT *
                             FROM   Product
                             ORDER BY ProductID DESC
                             LIMIT 1";
          $lastValueResult=mysqli_query($dbc,$lastValueQuery);

          while($row = mysqli_fetch_array($lastValueResult)){
              $productID =$row[0];
          }

          $message="{$productType} added!<br>
                    {$dollName} added!<br>
                    display image added!<br>
                    {$dollDescription} added!<br>
                    {$dollGender} added!<br>
                    {$dollSize} added!<br>
                    {$productID} last added!<br>";



          $queryCount = "SELECT *
                         FROM   Attribute";

          $result3=mysqli_query($dbc,$queryCount);

          while ($row5 = mysqli_fetch_array($result3)) { 

            $attribute=$_POST[$row5[1]];


              $SpecsQuery="INSERT INTO Product_has_Attribute       (ProductID,
                                                               AttributeValueID)

                              VALUES                          ('{$productID}',
                                                               '{$attribute}')";

          $result27=mysqli_query($dbc,$SpecsQuery);


          }



          //moving uploaded image to /images
          if (move_uploaded_file($_FILES['dollImage']['tmp_name'], $target1)) {
              $msg = "Image uploaded successfully<br>";
            }else{
              $msg = "Failed to upload image<br>";
            }

  }
  else{
  }

}; //end error

?>

<!----------------------------------------------------------------------------------------------------------------------------------------------------QUERIES-->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="assets/img/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Add New Doll</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />


  <!-- Bootstrap core CSS     -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Animation library for notifications   --> 
  <link href="assets/css/animate.min.css" rel="stylesheet" />

  <!--  Light Bootstrap Table core CSS    -->
  <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet" />


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

      <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

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
                <li class="active">
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

<!----------------------------------------------------------------------------------------------------------------------------------------------------FORM-->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="header">
                  <h4 class="title">Add New Doll</h4>
                  <p> <?php echo "$message <br>"; ?></p>
                </div>
                <div class="content">

                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Doll Name</label>
                          <input type="text" name="dollName" class="form-control" placeholder="Doll Name" required>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Gender</label>
                          <select name="dollGender" class="form-control input" onchange="showDiv(this)">
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Size</label>
                          <select name="dollSize" class="form-control input" onchange="showDiv(this)">
                        <option value="Small (6 inches)">Small (6 inches)</option>
                        <option value="Medium (10 inches)">Medium (10 inches)</option>
                        <option value="Large (12 inches)">Large (12 inches)</option>
                        </select>
                        </div>
                      </div>
                    </div>
                    Upload Display Image of Doll:<br><input type="file" name="dollImage" accept="image/*">


<?php 

                            $query = "SELECT  *
                                      FROM    Attribute";
                            $result=mysqli_query($dbc,$query);


                            //Loop for attribute name
                            while ($row = mysqli_fetch_array($result)) { 

?>

                    <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                          <!--Prints attribute name ex: Hairstyle,Haircolor-->
                          <label><?php echo $row["AttributeName"]; ?></label>

                          <?php
                            $attributeID = $row["AttributeID"];
                           ?>

                          <head>
                            <style>
                              table {width: 100%;}
                              th,
                              td {padding: 5px;text-align: left;}
                              table#t01 tr:nth-child(even) {background-color: #f9f9f9;}
                              table#t01 tr:nth-child(odd) {background-color: #f9f9f9;}
                              table#t01 th {background-color: white;color: black;}
                            </style>
                          </head>
                          <body>

                            <?php 
                            //loop for attribute values ex. Wavy,Straight,Curly hair, Green Hair,Black hair
                            //radio buttons
                            $query2 = "SELECT  *
                                      FROM    AttributeValues
                                      WHERE   AttributeTypeID = '$attributeID' AND AttributeValueType = 'PreMade'";
                            $result2 = mysqli_query($dbc,$query2);
                            ?>

                            <table id="t01">
                              <tr>




                            <?php 
                            //loop for attribute values ex. Wavy,Straight,Curly hair, Green Hair,Black hair
                              while ($row2 = mysqli_fetch_array($result2)) { 
                                //echo $row2["ValueName"];

                            ?>
                            <td>
                              <center>
                                <!--row2["value image"] shows the image-->
                                <!--row2["value  valueName"] value of the selected radio button-->
                                <img src=<?php  echo '"data:image/jpeg;base64,'.base64_encode( $row2['ValueImage'] ).'" '; ?>><br><input type="radio" name="<?php echo $row["AttributeName"]; ?>" value="<?php echo $row2["ValueID"]; ?>" checked>
                              </center>
                            </td>
<?php
                            }
?>
                              </tr>
                            </table>
                             </font>
                          </body>
                          </div>
                      </div>
                    </div>
<?php

                  }
?>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Doll Description</label>
                          <textarea type="text" name="dollDescription" class="form-control" placeholder="Description" required></textarea> 
                        </div>
                      </div>
                    </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right" Name="submit">ADD DOLL TO CATALOG</button>
                    <div class="clearfix"></div>
                    <hr>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<!-----------------------------------------------------------------------------------------------------------------------------------------FORM-END-->

      <footer class="footer">
        <div class="container-fluid">
          <nav class="pull-left">

          </nav>
          <p class="copyright pull-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script> <a href="home2.html">Dolljoy</a>, designed by Before You Exit
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
