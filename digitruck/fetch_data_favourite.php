
<?php
session_start();
$servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "bikezone";
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection



      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      $url=$_SERVER['HTTP_REFERER'];
      $path_parts = pathinfo($url);
     $uri=$path_parts['filename'];
      

/*forAllCatagory*/
$Category =html_entity_decode($_GET['category'],null,'UTF-8');
$City = html_entity_decode($_GET['city'],null,'UTF-8');
$priceMin = $_GET['minPrice'];
$priceMax = $_GET['maxPrice'];
$userid=$_SESSION['usr_id'];

//echo $Category;
//echo $City;
$filter1="select
  usedbikes.UserId as UserId,
  usedbikes.UsedBikeId as UsedBikeId,
  usedbikes.BikeCategory as BikeCategory,
  usedbikes.UsedBikeImage1 as UsedBikeImage1,
  usedbikes.Brand as Brand,
  usedbikes.Model as Model,
  usedbikes.KilometreDriven as KilometreDriven,
  usedbikes.Location as Location,
  usedbikes.UserId as UserId,
  usedbikes.UserName as UserName,
  usedbikes.ContactNumber as ContactNumber,
  usedbikes.Prize as Prize,
  usedbikes.Amount as Amount
from
  usedbikes
where Status LIKE 'UnBlock' AND Post_Status LIKE 'UnBlock' AND
  usedbikes.UserId in (
    SELECT
      userid
    FROM
      `favourite`
    where
      favourite.Fav_UserId = $userid
  )
  and usedbikes.UsedBikeId in (
    SELECT
      usedbikeid
    FROM
      `favourite`
    where
      favourite.Fav_UserId = $userid
  ) and";



$filter2="select
  dealerbikes.DealerId as UserId,
  dealerbikes.DealerBikeId as UsedBikeId,
  dealerbikes.BikeCategory as BikeCategory,
  dealerbikes.DealerBikeImage1 as UsedBikeImage1,
  dealerbikes.Brand as Brand,
  dealerbikes.Model as Model,
  dealerbikes.KilometreDriven as KilometreDriven,
  dealerbikes.Location as Location,
  dealerbikes.DealerId as UserId,
  dealerbikes.UserName as UserName,
  dealerbikes.ContactNumber as ContactNumber,
  dealerbikes.Prize as Prize,
  dealerbikes.Amount as Amount
from
  dealerbikes
where Status LIKE 'UnBlock' AND Post_Status LIKE 'UnBlock' AND
  dealerbikes.DealerId in (
    SELECT
      userid
    FROM
      `favourite`
    where
      favourite.Fav_UserId = $userid
  )
  and dealerbikes.DealerBikeId in (
    SELECT
      usedbikeid
    FROM
      `favourite`
    where
      favourite.Fav_UserId = $userid
  ) and";

if($City != ""){
  $filter1=$filter1. " usedbikes.City LIKE '$City' AND";
  $filter2=$filter2. " dealerbikes.City LIKE '$City' AND";
}
if($priceMin != "" && $priceMax != ""){
    $filter2 = $filter2." dealerbikes.Prize IN (SELECT Prize from dealerbikes WHERE Prize BETWEEN $priceMin AND $priceMax)";
     $filter1 = $filter1." usedbikes.Prize IN (SELECT Prize from usedbikes WHERE Prize BETWEEN $priceMin AND $priceMax)";
}


$split = explode(" ", $filter1);
if($split[count($split)-1] == "AND"){
     $filter1 = preg_replace('/\W\w+\s*(\W*)$/', '$1', $filter1);
    $filter2 = preg_replace('/\W\w+\s*(\W*)$/', '$1', $filter2);
}

$filter=$filter1. "UNION " .$filter2;
$_SESSION['favourite']=$filter;
//$filter=$filter1. "UNION ". $filter2;
// if(isset($_SESSION['favourite'])){
//   $filter=$_SESSION['favourite'];
// }
$limit = 10; 
$filterQuery = $filter; 
/*For No Of Rows Selected*/
// $result = $conn->query($sql);
// $rowcount = mysqli_num_rows($result);
// /*----------------------*/
// $rs_result = $conn->query($sql);  
// $row = $rs_result->fetch_assoc();  
// $total_records = $rowcount;
// $total_pages = ceil($total_records / $limit);

 
// if (isset($_GET["page"])) {
//  $page  = $_GET["page"]; 
// } else { 
//   $page=1; 
// }  
// $filterQuery=$sql;
//$start_from = ($page-1) * $limit;
//$_SESSION['fetchToPagination']=$filter;
//$filterQuery=$filter." LIMIT $start_from, $limit";
//$_SESSION['fetchToSort']=$filterQuery;
//$_SESSION['fetchToPagination']=$filterQuery;

/*  $filterQuery= $sub." LIMIT $start_from, $limit ";*/
?>
<div class="tab-content">

<div id="masterdiv">
 <div class="category-list" id="masterdiv">
<div class="tab-box  oldList">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs add-tabs" id="ajaxTabs" role="tablist">
                                <li class="active nav-item">
                                    <a  class="nav-link" href="ajax/ee.html" data-url="ajax/33.html" role="tab"
                                                      data-toggle="tab">Favourite Ads <span class="badge badge-secondary" style="display:inline-block;">
                                                          
                                                          <?php

                                            $count=mysqli_query($conn,$filterQuery);
                                                $num_rows = mysqli_num_rows($count);
                                             echo  $num_rows; ?>
                                                      </span></a>
                                </li>
                               <!--  <li class="nav-item"><a class="nav-link"  href="ajax/33.html" data-url="ajax/33.html" role="tab" data-toggle="tab">Business
                                    <span class="badge badge-secondary">22,805</span></a></li>
                                <li class="nav-item"><a class="nav-link"  href="ajax/33.html" data-url="ajax/33.html" role="tab" data-toggle="tab">Personal
                                    <span class="badge badge-secondary">18,705</span></a></li> -->
                            </ul>


                            <div class="tab-filter">
                                <select class="selectpicker select-sort-by" data-style="btn-select" data-width="auto" onchange="sort_by(this.value)">
                                    <option value="-1">Sort by </option>
                                    <option value="ASC">Price: Low to High</option>
                                    <option value="DESC">Price: High to Low</option>
                                </select>
                            </div>
                        </div>
<?php

      $result = $conn->query($filterQuery);

      if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
 ?>


<div>


<div class="item-list">
   <?php
      if($row['Amount']!=""){
       
  ?>
    <div class="cornerRibbons featuredAds">
        <a href=""> Dealer Ads</a>
    </div>
    <?php
  }
    ?>
    <div class="row">
    <div class="col-md-2 no-padding photobox">
        <div class="add-image"><span class="photo-count"><i class="fa fa-camera"></i> 2 </span>
         <a href="used_bikes_view.php?filename=<?php echo $uri;?>&usedbikeid=<?php echo $row['UsedBikeId']; ?> &userid=<?php echo $row['UserId']; ?> &brand=<?php echo $row['Brand']; ?> &category=<?php echo $row['BikeCategory']; ?>" role="button">

<?php     

echo '<img class="thumbnail no-margin" alt="no img is found" src="data:image/jpeg;base64,'.base64_encode($row['UsedBikeImage1']).'"/>'

?>
        </a>
        </div>
    </div>
    <!--/.photobox-->
    <div class="col-sm-7 add-desc-box">
        <div class="ads-details">
            <h5 class="add-title"><a href="used_bikes_view.php?filename=<?php echo $uri;?>&usedbikeid=<?php echo $row['UsedBikeId']; ?> &userid=<?php echo $row['UserId']; ?> &brand=<?php echo $row['Brand']; ?> &category=<?php echo $row['BikeCategory']; ?>" role="button">
                <?php echo $row['Brand'].'-'.$row['Model'] ;  ?></a></h5>
            <span class="info-row"> 
                <span class="add-type business-ads tooltipHere" data-toggle="tooltip" data-placement="right" title="" data-original-title="Business Ads">B </span> 
                 <span class="date">
                    <?php
                      if($row['KilometreDriven']!="0"){
                    ?>
                  <i class=" icon-clock"> </i>KM's Driven (
                  <?php 
                  echo $row['KilometreDriven']?>) - <?php
                              }
                                ?><i class="fa fa-map-marker"></i>
                  Location : <?php echo $row['Location'] ; ?></span>  
              <br><br> 
              <span class="category">Seller Name : <?php echo $row['UserName']  ?></span>

              - <span class="item-location"><i class="">
                Contact No : 
                  
              </i><?php echo $row['ContactNumber'] ?></span> </span></div>
    </div>
    <!--/.add-desc-box-->
    <div class="col-md-3 text-right  price-box">
        <h2 class="item-price">RS:-<?php echo $row['Prize']  ?></h2>         
        </div>
    <!--/.add-desc-box-->
</div>
</div>
</div>
<?php
}
}
?>
</div>
</div>
<!-- <div class="pagination-bar text-center">
     <nav aria-label="Page navigation " class="d-inline-b">

<ul class="pagination" id="pagination" >

<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
 if($i == 1):?>
            <li class="page-item active"  id="<?php echo $i;?>"><a class="page-link" href='pagination_usedbikes.php?page=<?php echo $i;?>'><?php echo $i;?></a></li> 
 <?php else:?>

 <li class="page-item" id="<?php echo $i;?>"><a href='pagination_usedbikes.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>

 <?php endif;?> 
<?php endfor;endif;?> 
</ul>
</nav>
</div> -->
</div>
<!-- <script type="text/javascript">
$(document).ready(function(){
$('.pagination').pagination({
        items: <?php echo $total_records;?>,
        itemsOnPage: <?php echo $limit;?>,
        cssStyle: 'light-theme',
        currentPage : 1,
        onPageClick : function(pageNumber) {
            jQuery('#masterdiv div').hide();
            jQuery("#target-content").html('loading...');
            jQuery("#target-content").load("pagination_usedbikes.php?page=" + pageNumber);
        }
    });
});
</script> -->