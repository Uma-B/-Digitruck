<html>
<head>
    <!--  -->
<style>
.dropbtn {
  background-color: #d9534f;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  text-align: center;
  width:100%;

}

 .dropbutton{
  background-color: #d9534f;
  color: white;
  padding: 12px;
  font-size: 15px;
  border: none;
  cursor: pointer;
  text-decoration: none;

}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn  {
  background-color: #d9534f;
}
</style>
</head>
<body>


    <div class="header">
    	<nav class="navbar  fixed-top navbar-site navbar-light bg-light navbar-expand-md"
    		 role="navigation">
    		<div class="container">

            <div class="navbar-identity">


    			<a href="session_out.php" class="navbar-brand logo logo-title">
    			<span class="logo-icon"><!-- <i class="icon icon-search-1 ln-shadow-logo "></i> -->
    			</span>DIGI<span>TRUCK </span> </a>


    			<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggler pull-right"
    					type="button">

    				<svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 30 30" width="30" height="30" focusable="false"><title>Menu</title><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/></svg>


    			</button>
            </div>



    			<div class="navbar-collapse collapse">
    				<ul class="nav navbar-nav navbar-left">
                      <li><a href="" class="glyphicon glyphicon-home"></a></li>
                      <li><a href="bike_sale_all.php">Bike for sale</a></li>
                      <li><a href="">Insurance</a></li>
                       <li class="dropdown no-arrow nav-item"><a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Service</a>
                          <ul
                              class="dropdown-menu user-menu dropdown-menu-right">
                              <li class="dropdown-item"><a href="bike_sale_all.php"><i class="fa fa-search" aria-hidden="true"></i>Search</a>
                              </li>
                              <?php
                                  if (isset($_SESSION['usr_id']) && isset($_SESSION['dealer_type'])) {
                                    $id=$_SESSION['usr_id'];
                                    ?>
                              <li class="dropdown-item">
                                <a href="service_post_ad.php"><i class="fa fa-upload" aria-hidden="true"></i> Post ad </a>
                              </li>
                              <?php
                                }
                                else {
                                  ?>
                                  <li class="dropdown-item">
                                <a href onclick="myFunction1()"><i class="fa fa-upload" aria-hidden="true"></i> Post ad </a>
                              </li>
                              <script>
                                  function myFunction1() {
                                      alert("Please login as dealer before posting ads");
                                  }
                                </script>
                                  <?php
                                }
                              ?>
                            </ul>
                      </li>
                      <li><a href="">Help</a></li>
    				</ul>
    				<ul class="nav navbar-nav ml-auto navbar-right">
    					<!-- <li class="nav-item"><a href="category.html" class="nav-link"><i class="icon-th-thumb"></i> All Ads</a>
    					</li> -->
    					<!-- <li class="dropdown no-arrow nav-item"><a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

    						<span>User Name</span> <i class="icon-user fa"></i> <i class=" icon-down-open-big fa"></i></a>   
    						<ul
    								class="dropdown-menu user-menu dropdown-menu-right">
    
    						</ul>
    					</li> -->
                         <?php if (isset($_SESSION['usr_name'])) { ?>
                         <li class="dropdown no-arrow nav-item"><a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                            <span>Signed in as <?php echo $_SESSION['usr_name']; ?></span> <i class="icon-user fa"></i> <i class=" icon-down-open-big fa"></i></a>
                            <ul
                                    class="dropdown-menu user-menu dropdown-menu-right">
                                    <li class="dropdown-item"><a href="favourite_view.php"><i class=" icon-money "></i>Featured Ads</a>
                                </li>
                                <li class="dropdown-item"><a href="logout.php"><i class=" icon-logout "></i> Log out </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                        <div class="dropdown">
                            <?php

                                if (isset($_SESSION['dealer_type'])) {
                                    ?>

                                    &nbsp;&nbsp;&nbsp; &nbsp;<a href="dealer_post.php" class="dropbutton " style="height: 45px; width: 120px;" >Sell your Bike</a>
                                    <?php
                                }
                                else{
                                    ?>
                                    &nbsp;&nbsp;&nbsp; &nbsp;<a href="customer_post.php" class="dropbutton " style="height: 45px; width: 120px;" >Sell your Bike</a>
                                    <?php
                                }
                            ?>
                                
  
 
</div><!-- <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" style="height: 45px; width: 120px;">
    Sell your bike
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="customer_post.php">Customer</a>
    <a class="dropdown-item" href="dealer_post.php">Dealer</a>
    
  </div>
</div> --></li>
                <?php } else { ?>
                <li>
                    <!-- <div class="btn-group">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" style="height: 45px; width: 120px;">
    Login
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="UserLogin.php">User</a>
    <a class="dropdown-item" href="CompanyLogin.php">Company</a>
    
  </div>
</div>  </li>
                <li><div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" style=" height: 45px; width: 120px; margin-left: 20px;">
    Register
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="UserRegistration.php">User</a>
    <a class="dropdown-item" href="delear.php">Company</a>
    
  </div>
</div></li> -->
 <div class="dropdown">
  &nbsp;&nbsp;&nbsp; &nbsp;<button class="dropbtn" style="width: 120px;" >Login
</button>
 <div class="dropdown-content">
    <a class="dropdown-item" href="UserLogin.php" style="background-color: white;width: 170px;text-align: left">User</a>
   <a class="dropdown-item" href="CompanyLogin.php" style="background-color: white;width: 170px;text-align: left">Dealer</a>
   </div>
</div><!-- <div class="btn-group">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" style="height: 45px; width: 120px;">
 </button>
 <div class="dropdown-menu">
   
 </div>
</div> -->  </li>
               <li>

<div class="dropdown">
 <button class="dropbtn" style=" width: 120px; margin-left: 20px;">
   Register</button>
 <div class="dropdown-content">
  <a class="dropdown-item" href="UserRegistration.php" style="background-color: white;width: 170px;text-align: left">User</a>
   <a class="dropdown-item" href="dealer.php" style="background-color: white;width: 170px;text-align: left">Dealer</a>
   
   </div>
</div>

      </li> 
                <?php } ?>    
    				</ul> 
    			</div>
    			<!--/.nav-collapse -->
    		</div>
    		<!-- /.container-fluid -->
    	</nav>
    </div>
    <!-- /.header -->
    </body>
    </html>