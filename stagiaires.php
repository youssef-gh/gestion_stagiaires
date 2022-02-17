<!DOCTYPE html>
<html lang="en">
  <head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Notre Cars</title>

    <!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
    

    
    
    <title>Our Cars </title>
    <style>  @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
          /* *{
  margin: 0;
  padding: 0;
  color: #d9d9d9;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
} */

    body{
        background-color:black;
    }

    </style>
  </head>
   <body>
  <?php 
   
   include("includes/header_encadrant.php");
//    include_once 'config.php';
    include('includes/config.php');

    ?>

<section class="listing-page">
  <div >
  <!-- class="container"> -->
    <div class="">
      <div class = "padding">
        <div class="result-sorting-wrapper">
          
</div>
<?php $sql = "SELECT etudiant.* from etudiant  ";
$query = $pdo -> prepare($sql);

$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
       
        <div class="product-listing-m gray-bg" style = "margin:100px;">
          <div class="product-listing-img"><img src="img/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="Image" /> </a> 
          </div>
          <div class="product-listing-content" style = "color:white;">
            <h5 >NOM: <?php echo htmlentities($result->nom);?></a></h5>
            <p class="list-price"><b>Prenom :<?php echo htmlentities($result->prenom);?>  </b></p>
            <ul>
              <li><i class="fa " aria-hidden="true"></i>Filliere:<b><?php echo htmlentities($result->filliere);?> </b></li>
              <li><i class="fa " aria-hidden="true"></i>annee: <b> <?php echo htmlentities($result->annee);?> </b></li>
              
            </ul>
          </div>
        </div>
      <?php }} ?>
         </div>
          
    </div>
  </div>
</div>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 

</body>
</html>