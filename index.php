<?php  session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
<title>SA</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/form.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery1.min.js"></script>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<!--start slider -->
    <link rel="stylesheet" href="css/fwslider.css" media="all">
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/css3-mediaqueries.js"></script>
    <script src="js/fwslider.js"></script>
<!--end slider -->
<script src="js/jquery.easydropdown.js"></script>
</head>
<body>
     <?php 

if (!isset($_SESSION['loggedin'])) {
	include("header1.php");
}
else
{

     include("header2.php"); 
} ?>
	<div class="header-bottom">
	    <div class="wrap">
			<div class="header-bottom-left">
				<div class="logo">
					<a href="index.html"><img src="images/leo.jpg" alt="" width="70px" height="70px" /></a>
				</div>
				<div class="menu">
	            <ul class="megamenu skyblue">
			<li class="active grid"><a href="index.php">Home</a></li>
				
			
				<li><a class="color6" href="">Other</a></li>
				<li><a class="color7" href="">Purchase</a></li>
			</ul>
			</div>
		</div>
	   <div class="header-bottom-right">
         <div class="search">	  
				<input type="text" name="s" class="textbox" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
				<input type="submit" value="Subscribe" id="submit" name="submit">
				<div id="response"> </div>
		 </div>
	  <div class="tag-list">
	    <ul class="icon1 sub-icon1 profile_img">
			<li><a class="active-icon c1" href="#"> </a>
				<ul class="sub-icon1 list">
					<li><h3>sed diam nonummy</h3><a href=""></a></li>
					<li><p>Lorem ipsum dolor sit amet, consectetuer  <a href="">adipiscing elit, sed diam</a></p></li>
				</ul>
			</li>
		</ul>
		<ul class="icon1 sub-icon1 profile_img">
			<li><a class="active-icon c2" href="#"> </a>
				
			</li>
		</ul>
	    <ul class="last"><li><a href="#"><?php if (isset($_SESSION['carrito'])&& isset($_SESSION['loggedin']))
	     {
	    	echo count($_SESSION['carrito']);
	    }
	    else
	    {
	    	echo "0";
	    }
	     ?></a></li></ul>
	    
	  </div>
    </div>
     <div class="clear"></div>
     </div>
	</div>

   
<div class="main">
	<div class="wrap">
		<div class="section group">
		  <div class="cont span_2_of_3">
		  	<h2 class="head"></h2>
			<div class="top-box">
			
			 	<?php
			 	include("conexion.php");
			 	$resultado= $conexion -> query("SELECT * FROM productos order by id  DESC  limit 10");
                  while($fila = mysqli_fetch_array($resultado)){


			 	?>
			 	 <div class="col_1_of_3 span_1_of_3"> 
			   <a href="single.php?id=<?php echo $fila['id'];?>">
			   	<?php  //if(!isset($_['loggedin'])){header('location:login.php');} ?>
				<div class="inner_content clearfix">
					<div class="product_image">
						<img src="images/<?php echo $fila['imagen'];   ?>" alt=""/>
					</div>
                  
                    <div class="price">
					   <div class="cart-left">
							<p class="title"> <?php echo $fila['nombre'];  ?></p>
							<p > <?php echo $fila['descripcion'];  ?></p>
							<div class="price1">
							  <span class="actual"><?php if (!isset($_SESSION['loggedin'])) {
							  	# code...

							  }  else{
							  echo $fila['precio'];}?></span>
							</div>
						</div>
						<div class="cart-right"> </div>
						<div class="clear"></div>
					 </div>				
                   </div>
                 </a>
                 </div><?php
             }
                 ?>
				
			 
				<div class="clear"></div>
			</div>	
		

				<div class="clear"></div>
			</div>			 						 			    
		  </div>
			<div class="rsidebar span_1_of_left">
				<div class="top-border"> </div>
				
           <div class="top-border"> </div>
			<div class="sidebar-bottom">
			    <h2 class="m_1">Newsletters</h2>
			    <p class="m_text">Lorem ipsum dolor sit amet, consectetuerrem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor vehicula mi. Ut purus libero, sollicitudin ac auctor ut, consectetur nec lectus. In </p>
			    <div class="subscribe">
					 <form>
					  
					 </form>
	  			</div>
			</div>
	    </div>
	   <div class="clear"></div>
	</div>
	</div>
	</div>
   <div class="footer">
		
		<div class="footer-middle">
			<div class="wrap">
			
		   
		   
		  
		  <div class="clear"></div>
		    </div>
		  </div>
		</div>
		<div class="footer-bottom">
			<div class="wrap">
	            
				<div class="f-list2">
				 <ul>
				
				 </ul>
			    </div>
			    <div class="clear"></div>
		      </div>
	     </div>
	</div>
</body>
</html>