<?php

require_once(__DIR__.'/../mysql_connect.php');
session_start();






?>



<!DOCTYPE html>
<html lang="en">
<head>
<!--

Template 2082 Pure Mix

http://www.tooplate.com/view/2082-pure-mix

-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<!-- Site title
   ================================================== -->
	<title>Gallery</title>

	<!-- Bootstrap CSS
   ================================================== -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Animate CSS
   ================================================== -->
	<link rel="stylesheet" href="css/animate.min.css">

	<!-- Font Icons CSS
   ================================================== -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/ionicons.min.css">

	<!-- Main CSS
   ================================================== -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Google web font 
   ================================================== -->	
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300' rel='stylesheet' type='text/css'>
	
</head>
<body>


<!-- Preloader section
================================================== -->
<div class="preloader">

	<div class="sk-spinner sk-spinner-pulse"></div>

</div>


<!-- Navigation section
================================================== -->
<div class="nav-container">
   <nav class="nav-inner transparent">

      <div class="navbar">
         <div class="container">
            <div class="row">

              <div class="brand">
                <a href="home.html">DOLLJOY</a>
              </div>

              <!-- Menu section
================================================== -->

              <div class="navicon">
	              <div class="navicon">
                  		<a href="home2.html">H O M E</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="about2.html">A B O U T</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="FAQ2.html">F A Q</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="gallery.php">G A L L E R Y</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="services2.php">S E R V I C E S</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="customerDashboard.php">A C C O U N T</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="home.html">L O G O U T</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="contact2.html">C O N T A C T</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              </div>
              </div>
              
              <!-- END of Menu section
================================================== -->

                </div>
              </div>

            </div>
         </div>
      </div>

   </nav>
</div>


<!-- Header section
================================================== -->
<section id="header" class="header-one">
	<div class="container">
		<div class="row">

			<div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
          <div class="header-thumb">
              <h1 class="wow fadeIn">DOLL GALLERY</h1>
              <h3 class="wow fadeInUp">Each doll can be customized.</h3>
          </div>
			</div>

		</div>
	</div>		
</section>


<!-- Portfolio section
================================================== -->
<section id="portfolio">
   <div class="container">
      <div class="row">

         <div class="col-md-12 col-sm-12">
            
               <!-- iso section -->
               <div class="iso-section wow fadeInUp">



                        <!-- iso box section -->
                        <div class="iso-box-section wow fadeInUp">
                           <div class="iso-box-wrapper col4-iso-box">

                            <?php 

                            $query = "SELECT  *
                                      FROM    Product
                                      WHERE   ProductType = 'PreMade'";
                            $result=mysqli_query($dbc,$query);


                            while ($row = mysqli_fetch_array($result)) { 
                              $id=$row[0];
                              ?>
                              <div class="iso-box photoshop branding col-md-4 col-sm-6">
                              <div class="portfolio-thumb">
                              <img src=<?php  echo '"data:image/jpeg;base64,'.base64_encode( $row[3] ).'" '; ?> class="img-responsive" alt="Portfolio">
                              <div class="portfolio-overlay">
                              <div class="portfolio-item">
                              <a href="individualDoll.php?id=<?php echo $id; ?>"><i class="fa fa-link"></i></a>
                              <h2><?php echo $row[2]; ?></h2>
                              </div>
                              </div>
                              </div>
                              </div>
<?php
                            }


                            ?>



                            </div>
                        </div>

               </div>

         </div>

      </div>
   </div>
</section>

<!-- Footer section
================================================== -->
<footer>
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
				<p class="wow fadeInUp">Copyright © 2017 Dolljoy - Designed by Before You Exit</p>
				<ul class="social-icon wow fadeInUp">
					<li><a href="https://www.facebook.com/Dolljoy-Gallery-and-Museum-108987895809526/" class="fa fa-facebook"></a></li>
					<li><a href="#" class="fa fa-twitter"></a></li>
					<li><a href="#" class="fa fa-dribbble"></a></li>
					<li><a href="#" class="fa fa-behance"></a></li>
					<li><a href="#" class="fa fa-google-plus"></a></li>
				</ul>
			</div>
			
		</div>
	</div>
</footer>


<!-- Javascript 
================================================== -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/isotope.js"></script>
<script src="js/imagesloaded.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>