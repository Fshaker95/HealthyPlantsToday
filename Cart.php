<!--
   Author: fahad shaker
-->
<html>
<head>
<link  rel="stylesheet" href="CSS/bootstrap.min.css" type="text/css" />
</head>
<body>

 <style>

    a {
	    color: black; 	}

    img {
  		width: 90%; 	}

     .cart-container {
	   display: flex;}

     .cart-item
	 {
		 width:25%;
	   margin: 10px;
	   text-align: center;
	   line-height: 50px;
	   font-size: 30px;
	   border-radius: 30px 30px 30px 30px;
		 border: 3px solid #33b5e5;
		 align:center; }

     .container-fluid {
	     border-top: 2px solid #33b5e5; }

    .card-header {
	    background: #33b5e5;
     	color: white; }

     .card-body {
	     background: #33b5e5;
	     width: 10%;
	     float: right;
      	color: white; }

    .total {
      color: white; }

	</style>


<h3 class="card-header"> Order Details </h3>
<br />

<a href="market.php">  << Back to Market </a>

<br />
<br />


<div class="cart-container">
      <?php
        include ('test_session.php');

           if(!empty($_SESSION["shopping_cart"])) {
	             $total = 0;
               foreach ($_SESSION["shopping_cart"] as $keys => $values) {  ?>
            <div class="cart-item" >
               <form method="post">
                 <div class="form-group">
                   <img src="<?php echo $values["item_pic"]; ?>" id="item-pic">
                 </div>
               <div class="form-group">
                  <h4 class="item-font-color"> <?php echo $values["item_name"]; ?></h4>
               </div>
             <div class="form-group">
               <h4 class="text-danger">$<?php echo $values["item_price"]; ?></h4>
             </div>
            <div class="form-group">
              <h4 class="item-font-color">Qty: <?php echo $values["item_qty"]; ?></h4>
            </div>

			   	 <div class="form-group">
				   	 <h4>
				   		 <a class="btn btn-danger" href="market.php?action=delete&id=<?php echo $values["item_id"]; ?>"> Remove </a>
					   </h4>
				  </div>
       </form>
    </div>

       <?php
         }
      }  ?>
</div>



<?php
$total = $total + ($values["item_qty"] * $values["item_price"]);
?>

      <!-- Footer -->
<footer class="page-footer fixed-bottom">
 <!-- Footer Elements container -->
  <div class="container-fluid">
        <!--Grid row-->
        <div class="row">
          <!--Grid column 2-->
          <div class="col-md">
            <!-- Form -->
              <div class="card-body">
                <form method="POST" >
        					<div class="total" >
											  <h2>Total</h2>
												<h4>$ <?php echo number_format($total, 2); ?></4>
									</div>
									<br/>

									<div>
										  <input type="submit" name="send_msg" value="Check Out" class="btn btn-danger">
									</div>
               </form>
            </div>
         </div>
    </div>
  </div>
</footer>

</body>
</html>
