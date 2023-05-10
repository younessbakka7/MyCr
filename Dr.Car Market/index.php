<script>
        function success_toast()
        {
          toastr.success("Bien Ajouter");
        }
    </script>
<?php 
 try {
  $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  echo 'Erreur de connexion: ' . $e->getMessage();
}
session_start();
if($_GET['cat'] == NULL || $_GET['ref'] == NULL)
{
  header('Location:'.'Market.php');
}


$list = "";
$val = "";

                $Commande = $cn->prepare("SELECT * FROM produit where Type_P=? AND Ref_P=?");
                $Commande -> execute(array($_GET['cat'],$_GET['ref']));
                $Line = $Commande->fetch(PDO::FETCH_ASSOC);
                
                $Code = $Line['Code_P'];
                $nom =  $Line['Nom_P'];
                $Prix = $Line['Prix_P']." DH";
                $Max = $Line['Quan_S'];
                $image1 = $Line["Img_P"];
                $image2 = $Line["Img_P2"];

                if($Max > 0)
                {
                  $val = "in Stock";
                }
                else
                {
                  $val = '<span style="color:red;">out Stock</span>';
                }

                $Commande1 = $cn->prepare("SELECT * FROM ".$_GET['cat']." where Ref=?");
                $Commande1 -> execute(array($_GET['ref']));
                $Line1 = $Commande1->fetch(PDO::FETCH_ASSOC);

                if($_GET['cat'] == "voiture")
                {
                  $list = '<ul>
                  <li>Marque : <span>'.$Line1["Marque_V"].'</span></li>
                  <li>Modele : <span>'.$Line1["Modele_V"].'</span></li>
                  <li>Style : <span>'.$Line1["Style_V"].'</span></li>
                  <li>Type Transition : <span>'.$Line1["Type_Trans_V"].'</span></li>
                  <li>Nombre de Chevales : <span>'.$Line1["Nbr_Ch_V"].'</span></li>
                  <li>Type Carbirateur : <span>'.$Line1["Type_Carb_V"].'</span></li>
                  <li>Category: <span>'.$_GET['cat'].'</span></li>
                  <li>Available: <span>'.$val.'</span></li>
                  <li>Shipping Area: <span>All over the world</span></li>
                  <li>Shipping Fee: <span>Free</span></li>
                </ul>';
                }
                elseif($_GET['cat'] == "batterie")
                {
                  $list = '<ul>
                  <li>Marque : <span  >'.$Line1["Marque_B"].'</span></li>
                  <li>Capacite : <span>'.$Line1["Capacite_B"].' AH</span></li>
                  <li>Layout : <span  >'.$Line1["Layout_B"].'</span></li>
                  <li>Warranty : <span>'.$Line1["Warranty_B"].'</span></li>
                  <li>Category: <span>'.$_GET['cat'].'</span></li>
                  <li>Available: <span>'.$val.'</span></li>
                  <li>Shipping Area: <span>All over the world</span></li>
                  <li>Shipping Fee: <span>Free</span></li>
                </ul>';
                }
                elseif($_GET['cat'] == "moteur")
                {
                  $list = '<ul>
                  <li>Marque : <span>'.$Line1["Marque_M"].'</span></li>
                  <li>Nombre de Chevale : <span>'.$Line1["Nbr_Ch_M"].'</span></li>
                  <li>Type de Carbirateur : <span>'.$Line1["Type_Carb_M"].'</span></li>
                  <li>Size : <span>'.$Line1["Size_M"].'</span></li>
                  <li>Category: <span>'.$_GET['cat'].'</span></li>
                  <li>Available: <span>'.$val.'</span></li>
                  <li>Shipping Area: <span>All over the world</span></li>
                  <li>Shipping Fee: <span>Free</span></li>
                </ul>';
                }
                elseif($_GET['cat'] == "roue")
                {
                  $list = '<ul>
                  <li>Marque : <span>'.$Line1["Marque_R"].'</span></li>
                  <li>Diametre : <span>'.$Line1["Diametre_R"].'</span></li>
                  <li>Pression : <span>'.$Line1["Pression_R"].'</span></li>
                  <li>Nombre de Trous : <span>'.$Line1["Nbr_Trous_R"].'</span></li>
                  <li>Category: <span>'.$_GET['cat'].'</span></li>
                  <li>Available: <span>'.$val.'</span></li>
                  <li>Shipping Area: <span>All over the world</span></li>
                  <li>Shipping Fee: <span>Free</span></li>
                </ul>';
                }
                elseif($_GET['cat'] == "siege")
                {
                  $list = '<ul>
                  <li>Marque : <span>'.$Line1["Marque_S"].'</span></li>
                  <li>Type de Cuire : <span>'.$Line1["Type_Cui_S"].'</span></li>
                  <li>Size : <span>'.$Line1["Size_S"].'</span></li>
                  <li>Poid : <span>'.$Line1["Poid_S"].'</span></li>
                  <li>Category: <span>'.$_GET['cat'].'</span></li>
                  <li>Available: <span>'.$val.'</span></li>
                  <li>Shipping Area: <span>All over the world</span></li>
                  <li>Shipping Fee: <span>Free</span></li>
                </ul>';
                }

                
                if(array_key_exists('ADD', $_POST)) 
                {
                  $PreCommande = $cn->prepare("SELECT * FROM precommande where Code_P=? and Code_Ut=?");
                  $PreCommande -> execute(array($Code,$_SESSION["ID_UT"]));
                  if($PreCommande->rowCount() != 0)
                  {
                    $PreCommande = $cn->prepare("UPDATE precommande set Quan_C=Quan_C+? where Code_P=? and Code_Ut=?");
                    $PreCommande -> execute(array($_POST["QtC"],$Code,$_SESSION["ID_UT"]));
                    // echo "Quantite Commander Updated !!";
                    echo '<script>alert("Bien Ajouter !!!");</script>';
                  }
                  else
                  {
                    $PreCommande = $cn->prepare("INSERT INTO precommande VALUES(?,?,?)");
                    $PreCommande -> execute(array($Code,$_SESSION["ID_UT"],$_POST["QtC"]));
                    // echo "Bien Ajouter !!";
                    echo '<script>alert("Bien Ajouter !!!");</script>';
                  }
                  
                } 
                
                if(isset($_GET['Ras']))
                {
                if($_GET['Ras'] == "home")
                {
                  $PreCommande = $cn->prepare("SELECT * FROM precommande where Code_P=?");
                                  $PreCommande -> execute(array($Code));
                                  if($PreCommande->rowCount() != 0)
                                  {
                                    $PreCommande = $cn->prepare("UPDATE precommande set Quan_C=Quan_C+1 where Code_P=? and Code_Ut=?");
                                    $PreCommande -> execute(array($Code,$_SESSION["ID_UT"]));
                                    header('Location:'.'Market.php?er=Updated');
                                  }
                                  else
                                  {
                                    $PreCommande = $cn->prepare("INSERT INTO precommande VALUES(?,?,1)");
                                    $PreCommande -> execute(array($Code,$_SESSION["ID_UT"]));
                                    header('Location:'.'Market.php?er=Ajouted');
                                  }
                }
              }




?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <script>
      $(document).ready(function() {

        $("[type='number']").keypress(function (evt) {
    evt.preventDefault();
});
        });
    </script>
    <style>
      .card-wrapper
      {
        margin-top: 0px;
      }
      .btn:hover
      {
        background-color: crimson !important;
      }
      .imgg
      {
        /* width : 350px !important;*/
        height: 300px; 
        object-fit: contain;
        border-bottom: 2px solid black;
        border-bottom-left-radius: 7px ;
         border-bottom-right-radius: 7px ;
      }
      .imggg
      {
         margin-left : -100px;
         
      }
      .product-content
      {
        padding-top: 0;
        background-color: #e0e6ff;
        border-radius: 19px;
        padding-left: 52px !important;
        padding-bottom: 0px !important;
      }
      .img-select
      {
        padding-top: 29px;
      }
      .footer
        {
            background-color:transparent !important;
        }
        .imgbr
{
    height: 14rem;
    width: 14rem;
    line-height: 14rem;
    font-size: 12rem;
    margin:.35rem;
    border-radius: 50%;
        
}
.bgg
{
    background-color: transparent;
    display: inline-block;
    position: absolute;
    z-index: 5;
    top: -18px;
    left: -76px;
}
    </style>
  </head>
  <body>
  <section class="bgg footer">
        <div class="share">
            <a href="My Actions.php" class="fab las la-home"> </a>
        </div>
    </section>
    <div class = "card-wrapper">
      <div class = "card">
        <!-- card left -->
        <div class = "imggg product-imgs">
          <div class = "img-display">
            <div class = " img-showcase">
              <img src = "<?php echo  '../'.$image1 ?>" alt = "shoe image"  class="imgg">
              <img src = "<?php echo  '../'.$image2 ?>" alt = "shoe image" id="img2" class="imgg">
            </div>
          </div>
          <div class = "img-select">
            <div class = "img-item">
              <a href = "#" data-id = "1">
                <img src = "<?php echo  '../'.$image1 ?>" alt = "shoe image">
              </a>
            </div>
            <div class = "img-item">
              <a href = "#" data-id = "2">
                <img src = "<?php echo  '../'.$image2 ?>" alt = "shoe image">
              </a>
            </div>
            <div style="visibility:hidden ;" class = "img-item">
              <a href = "#" data-id = "3">
                <img src = "shoes_images/shoe_3.jpg" alt = "shoe image">
              </a>
            </div>
            <div style="visibility:hidden ;" class = "img-item">
              <a href = "#" data-id = "4">
                <img src = "shoes_images/shoe_4.jpg" alt = "shoe image">
              </a>
            </div>
          </div>
        </div>
        <!-- card right -->
        <div  class = "product-content">
          <h2 class = "product-title"><?php echo $nom; ?></h2>
          

          <div class = "product-price">
            <p class = "new-price">Le Price: <span><?php echo  $Prix; ?></span></p>
          </div>

          <div class = "product-detail">
            <h2>about this item: </h2>
            <?php 
            echo $list;
            ?>
          </div>
          <form action="" method="post">
          <div id="divv" class = "purchase-info">
            <input type = "number" name="QtC" min = "1" max="<?php echo $Max ?>" value = "1">
            
            <button style="background-color: #256eff;" name="ADD" type = "submit" class = "btn">
              Add to Cart <i class = "fas fa-shopping-cart"></i>
            </button>
<br />
<a href="Market.php">
            <input style="background-color: orangered; width:90px;" type="button" class = "btn" value="Go Back">
              
            </input>
            </a>
            
          </div>
          <?php 
          if($val == '<span style="color:red;">out Stock</span>')
          {
            echo "<script> 
            var D = document.getElementById('divv');
            D.style.display = 'none';
            </script>";
          }
          ?>
          </form>
          
        </div>
      </div>
    </div>

    
    <script src="script.js"></script>
    <script src="js/toastr.min.js"></script>
    
  </body>
</html>