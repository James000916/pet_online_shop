<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add": {
			$productByCode = $db_handle->runQuery("SELECT * FROM product WHERE product_id='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["product_name"], 'code'=>$productByCode[0]["product_id"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Webpage icon -->
    <link rel="icon" href="" type="image/icon type">
    <title>Joyful Paws</title>

    <!-- Cascading Style Sheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="product.css" type="text/css">

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Knewave&display=swap" rel="stylesheet">
</head>
<body>
    <!-- External JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Navigation bar -->
    <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
        <a href="../index.html" class="navbar-brand"><i class="fas fa-arrow-circle-left"></i> Back to home page</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col w3-animate-left">
                <div id="carouselExampleIndicators" style="top:85px;" class="carousel slide border" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="../img/product/hot3/1.jpg" alt="First slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col w3-animate-right">
                <div class="card" style="width: 30rem; top:85px;">
                    <div class="card-body">
                        <h5 class="card-title">PureBites Chicken Jerky & Sweet Potato 180g</h5>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>$108.00 per pack</b></li>
                        <li class="list-group-item"><input type="number" value="1" min="1" max="10" step="1"/></li>
                    </ul>
					
					<?php
							$product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY id ASC");
							if (!empty($product_array)) { 
								foreach($product_array as $key=>$value){
					?>
					
                    <div class="card-body"><form method="post" action="cart.php?action=add&code=<?php echo $product_array[$key]["19"];?>">
                        <button type="submit" value="Add to Cart" class="btn btn-danger"></button>
					</form></div>
<?php
		}
	}
	?>
                </div>
            </div>
        </div>
    </div><br><br><br><br><hr>

    <div class="container w3-animate-bottom">
        <div class="row">
            <div class="col">
                <h3>Description</h3>
                <ul>
                    <li>Made with only 2 ingredients; 100% Pure & Natural USA Raised Chicken Breast & Canadian Farmed Sweet Potato.</li>
                    <li>Made using a delicate drying process with NO added Glycerin.</li>
                    <li>100% natural, pure and easy to digest without any added preservatives.</li>
                    <li>On average 15 calories per treat and high in protein.</li>
                    <li>Ideal for dogs with health issues or pets that are overweight, diabetic, have allergies, gastrointestinal disorders, or are on a restricted diet.</li>
                    <li>Proudly sourced in the USA & Canada and gently dried in Canada.</li>
                </ul>

            </div>
            <div class="col">
                <h3>Main Ingredients</h3>
                <ul>
                    <li>Crude Protein (min) 43%</li>
                    <li>Crude Fat (min) 2%</li>
                    <li>Crude Fiber (max) 4%</li>
                    <li>Moisture (max) 12%</li>
                </ul>
            </div>
        </div>
    </div><br><br><br>

    <!-- Footer -->
    <footer class="bg-dark text-center text-white">
        <!-- Grid container -->
        <div class="container p-4">
            <section class=""><br><br>
                <div class="row d-flex justify-content-center">
                    <div class="col-auto">
                        <p class="pt-2">
                            <strong>Sign up for our newsletter</strong>
                        </p>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="form-outline form-white mb-4">
                            <input type="email" id="form5Example2" class="form-control" />
                            <label class="form-label" for="form5Example2">Email address</label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-outline-light mb-4">
                            Subscribe
                        </button>
                    </div>
                </div>
            </section>
        </div>

        <!-- Copyright -->
        <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            Copyright &#169; 2021 Mok Ching Hei. All Rights Reserved.
        </div>
    </footer>
</body>
</html>