<?php 
 try {
  $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  echo 'Erreur de connexion: ' . $e->getMessage();
}
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    if(array_key_exists('check', $_POST)) 
    {
      $Date = date("Y-m-d");
      $Commande = $cn->prepare("SELECT * FROM precommande where Code_Ut=? and Code_P IN(SELECT Code_P from produit where Quan_S>0)");
      $Commande -> execute(array($_SESSION["ID_UT"]));
      if($Commande->rowCount() != 0)
      {
        $Insert = $cn->prepare("INSERT INTO commande VALUES(NULL,?,?,'en demande')");
        $Insert -> execute(array($_SESSION["ID_UT"],$Date));

        $MAX = $cn->prepare("SELECT MAX(Num_C) as 'MAX' FROM commande WHERE Code_Ut = ?");
        $MAX -> execute(array($_SESSION["ID_UT"]));
        $Line = $MAX->fetch(PDO::FETCH_ASSOC);
        
        $Code_C = $Line["MAX"];


                for ($j=0; $j < $Commande->rowCount() ; $j++) 
                {
                  $LineC = $Commande->fetch(PDO::FETCH_ASSOC);
                  $IN = $cn->prepare("INSERT INTO ligne_de_commande VALUES(?,?,?)");
                  $IN -> execute(array($Code_C,$LineC["Code_P"],$LineC["Quan_C"]));

                  $UPDATE = $cn->prepare("UPDATE produit SET Quan_S = Quan_S-? where Code_P=?");
                  $UPDATE -> execute(array($LineC["Quan_C"],$LineC["Code_P"]));

                  $Delete = $cn->prepare("DELETE FROM precommande where Code_P=? AND Code_Ut=?");
                  $Delete -> execute(array($LineC["Code_P"],$_SESSION["ID_UT"]));
                }
        

      }
      else
      {
        echo "Ajouter Produit First !!!!";
      }

    }
}

    
    if(isset($_GET["Code"])) 
    {
      $Commande = $cn->prepare("DELETE FROM precommande where Code_P=? AND Code_Ut=?");
      $Commande -> execute(array($_GET["Code"],$_SESSION["ID_UT"]));
      header('Location:'.'index.php');
    }


            $Commande = $cn->prepare("SELECT * FROM precommande where Code_Ut=?");
            $Commande -> execute(array($_SESSION["ID_UT"]));
            $List = "";
            $Gtotal = "";
if($Commande->rowCount() != 0)
{
  $Gtotal = 0;
  
  for ($j=0; $j < $Commande->rowCount() ; $j++) 
  {
    $Line1 = $Commande->fetch(PDO::FETCH_ASSOC);
            $Commande2 = $cn->prepare("SELECT * FROM produit WHERE Code_P=?");
            $Commande2 -> execute(array($Line1["Code_P"]));
            $Line2 = $Commande2->fetch(PDO::FETCH_ASSOC);
    
    $image1 = $Line2["Img_P"];
    $Nom = $Line2["Nom_P"];
    $Prix = $Line2["Prix_P"];
    $Total = $Prix*$Line1["Quan_C"];
    $Gtotal = $Gtotal+$Total;
    $QTS = $Line2["Quan_S"];
    $val = "";

    if($QTS == 0)
    {
      $val = '<label style="text-align:center;font-weight: bold;">OUT STOCK</label>';
      $Total = 0;
    }
    else
    {
      $val = '<input style="text-align:center;font-weight: bold;" type="text" value="'.$Line1["Quan_C"].'" readonly>';
      $Total = $Prix*$Line1["Quan_C"];
    }

    $List = $List.  '<div class="product">
    <div class="product-image">
      <img src="../../'.$image1.'">
    </div>
    <div class="All">
        
    <div class="product-details">
      <div class="product-title"><b>'.$Nom.'</b></div>
    </div>
    <div class="product-price"><b>'.$Prix.' DH</b></div>
    <div class="product-quantity">
      '.$val.'
    </div>
    <a href="index.php?Code='.$Line1["Code_P"].'">
    <div class="product-removal">
      <input style="font-weight: bold;" type="button" name="remove" class="remove-product" value="Remove">
      </input>
    </div>
    </a>
    <div class="product-line-price"><b>'.$Total.' DH</b></div>

  </div>
</div>';


  }
}
                else
                {
                  $List = "<span> !!!!!! Aucun Produit !!!!!! </span>";
                  $Gtotal = "0";
                }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        .product-image {
  float: left;
  width: 20%;
}

.product-details {
  float: left;
  width: 37%;
}

.product-price {
  float: left;
  width: 12%;
}

.product-quantity {
  float: left;
  width: 10%;
}

.product-removal {
  float: left;
  width: 9%;
}

.product-line-price {
  float: left;
  width: 12%;
  text-align: right;
}

/* This is used as the traditional .clearfix class */
.group:before, .shopping-cart:before, .column-labels:before, .product:before, .totals-item:before,
.group:after,
.shopping-cart:after,
.column-labels:after,
.product:after,
.totals-item:after {
  content: '';
  display: table;
}

.group:after, .shopping-cart:after, .column-labels:after, .product:after, .totals-item:after {
  clear: both;
}

.group, .shopping-cart, .column-labels, .product, .totals-item {
  zoom: 1;
}

/* Apply clearfix in a few places */
/* Apply dollar signs */
/* .product .product-price:before, .product .product-line-price:before, .totals-value:before {
  content: '$';
} */

/* Body/Header stuff */
body {
  padding: 0px 30px 30px 20px;
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-weight: 100;
}

h1 {
  font-weight: 100;
}

label {
  color: #aaa;
}

.shopping-cart {
  margin-top: -45px;
}

/* Column headers */
.column-labels label {
  padding-bottom: 15px;
  margin-bottom: 15px;
  border-bottom: 1px solid #eee;
}
.column-labels .product-image, .column-labels .product-details, .column-labels .product-removal {
  text-indent: -9999px;
}

/* Product entries */
.product {
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 1px solid #eee;
}
.product .product-image {
  text-align: center;
}
.product .product-image img {
  width: 100px;
}
.product .product-details .product-title {
  margin-right: 20px;
  font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
  font-size: 22px;
}
.product .product-details .product-description {
  margin: 5px 20px 5px 0;
  line-height: 1.4em;
}
.product .product-quantity input {
  width: 40px;
}
.product .remove-product {
    margin-top: -8px;
  border: 0;
  padding: 10px 20px;
  background-color: #c66;
  color: #fff;
  font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
  font-size: 18px;
  border-radius: 3px;
  cursor: pointer;
}
.product .remove-product:hover {
  background-color: #a44;
}

/* Totals section */
.totals .totals-item {
  float: right;
  clear: both;
  width: 100%;
  margin-bottom: 10px;
}
.totals .totals-item label {
  float: left;
  clear: both;
  width: 79%;
  text-align: right;
}
.totals .totals-item .totals-value {
  float: right;
  width: 21%;
  text-align: right;
}
.totals .totals-item-total {
  font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
}

.checkout {
  float: right;
  border: 0;
  margin-top: 20px;
  padding: 6px 25px;
  background-color: #6b6;
  color: #fff;
  font-size: 25px;
  border-radius: 3px;
}

.checkout:hover {
  background-color: #494;
}

/* Make adjustments for tablet */
@media screen and (max-width: 650px) {
  .shopping-cart {
    margin: 0;
    padding-top: 20px;
    border-top: 1px solid #eee;
  }

  .column-labels {
    display: none;
  }

  .product-image {
    float: right;
    width: auto;
  }
  .product-image img {
    margin: 0 0 10px 10px;
  }

  .product-details {
    float: none;
    margin-bottom: 10px;
    width: auto;
  }

  .product-price {
    clear: both;
    width: 70px;
  }

  .product-quantity {
    width: 100px;
  }
  .product-quantity input {
    margin-left: 20px;
  }

  .product-quantity:before {
    content: 'x';
  }

  .product-removal {
    width: auto;
  }

  .product-line-price {
    float: right;
    width: 70px;
  }
}
/* Make more adjustments for phone */
@media screen and (max-width: 350px) {
  .product-removal {
    float: right;
  }

  .product-line-price {
    float: right;
    clear: left;
    width: auto;
    margin-top: 10px;
  }

  .product .product-line-price:before {
    content: 'Item Total: $';
  }

  .totals .totals-item label {
    width: 60%;
  }
  .totals .totals-item .totals-value {
    width: 40%;
  }
}
.All
{
    margin-top: 35px;
}
    </style>
</head>
<body>
    <div style="margin-top: 90px;">
    <h1>Shopping Cart</h1>

<div class="shopping-cart">

  <div class="column-labels">
    <label class="product-image">Image</label>
    <label class="product-details">Product</label>
    <label class="product-price">Price</label>
    <label class="product-quantity">Quantity</label>
    <label class="product-removal">Remove</label>
    <label class="product-line-price">Total</label>
  </div>

  <?php     
    echo $List;
  ?>
  

  <div style="margin-top: 40px;" class="totals">
    
    <div class="totals-item totals-item-total">
      <label style="font-size: 20px;color:black;font-weight:bold;" >Grand Total</label>
      <div class="totals-value" id="cart-total" style="color:rgb(0, 0, 0);font-weight:bold;"><?php echo $Gtotal ?> DH</div>
    </div>
  </div>
  
      <form  action="" method="post">
      <input type="submit" style="cursor: pointer;" name="check" class="checkout" value="Checkout"></button>
      <?php 
      if(isset($_GET['res']) == true)
      {
        $a = "";
        if($_GET['res']=="ma")
        {
          $a = "../Market.php";
        }
        else if($_GET['res']=="home")
        {
          $a = "../../index.php";
        }
      }
      ?>
      <a href="<?php echo $a; ?>"><input type="button" style="cursor: pointer;margin-right:20px;background-color:orangered" class="checkout" value="Go Back"></button></a>
    </form>
    
</div>
</div>
      <script>
          /* Set rates + misc */
var taxRate = 0.05;
var shippingRate = 15.00; 
var fadeTime = 300;


/* Assign actions */
$('.product-quantity input').change( function() {
  updateQuantity(this);
});

$('.product-removal button').click( function() {
  removeItem(this);
});


/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
  
  /* Calculate totals */
  var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + tax + shipping;
  
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal.toFixed(2));
    $('#cart-tax').html(tax.toFixed(2));
    $('#cart-shipping').html(shipping.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }
    $('.totals-value').fadeIn(fadeTime);
  });
}


/* Update quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      recalculateCart();
      $(this).fadeIn(fadeTime);
    });
  });  
}


/* Remove item from cart */
function removeItem(removeButton)
{
  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent();
  productRow.slideUp(fadeTime, function() {
    productRow.remove();
    recalculateCart();
  });
}
      </script>
</body>
</html>