<?php 
 try {
  $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
  echo 'Erreur de connexion: ' . $e->getMessage();
}
session_start();

            $Count = $cn->prepare("SELECT count(Code_P) as 'C' FROM precommande where Code_Ut = ?");
            $Count -> execute(array($_SESSION["ID_UT"]));
            $Liin = $Count->fetch(PDO::FETCH_ASSOC);
            $All = $Liin["C"];

if(!isset($_GET['cat']))
{
  $Commande = $cn->prepare("SELECT * FROM produit");
  $Commande -> execute();
}
else
{
          if($_GET['cat'] == "Cars")
          {
            $Commande = $cn->prepare("SELECT * FROM produit where Type_P='voiture'");
            $Commande -> execute();
          }
          elseif($_GET['cat'] == "Parts")
          {
            $Commande = $cn->prepare("SELECT * FROM produit where Type_P<>'voiture'");
            $Commande -> execute();
          }
          
          elseif($_GET['cat'] == "Batterie")
          {
            $Commande = $cn->prepare("SELECT * FROM produit where Type_P='batterie'");
            $Commande -> execute();
          }
          elseif($_GET['cat'] == "Moteur")
          {
            $Commande = $cn->prepare("SELECT * FROM produit where Type_P='moteur'");
            $Commande -> execute();
          }
          elseif($_GET['cat'] == "Roue")
          {
            $Commande = $cn->prepare("SELECT * FROM produit where Type_P='roue'");
            $Commande -> execute();
          }
          elseif($_GET['cat'] == "Siege")
          {
            $Commande = $cn->prepare("SELECT * FROM produit where Type_P='siege'");
            $Commande -> execute();
          }
}


$List = "";

if($Commande->rowCount() != 0)
{
  for ($j=0; $j < $Commande->rowCount() ; $j++) 
  {
    $Line1 = $Commande->fetch(PDO::FETCH_ASSOC);
    
    $Ref = $Line1["Ref_P"];
    $image1 = $Line1["Img_P"];
    $image2 = $Line1["Img_P2"];
    $Categorie = $Line1["Type_P"];
    $Nom = $Line1["Nom_P"];
    $Prix = $Line1["Prix_P"];
    $URL = "index.php?cat=".$Categorie."&ref=".$Ref;
    $BagURL = "index.php?cat=".$Categorie."&ref=".$Ref."&Ras=home";


    $List = $List.  '<div class="showcase">

<div class="vvv showcase-banner">

  <img src="../'.$image1.'" alt="Mens Winter Leathers Jackets" width="300" height="300" class="pimg product-img default">
  <img src="../'.$image2.'" alt="Mens Winter Leathers Jackets" width="300" height="300" class="pimg product-img hover">

  <!-- <p class="showcase-badge">15%</p> -->

  <div class="showcase-actions">

    <!-- <button class="btn-action">
      <ion-icon name="heart-outline"></ion-icon>
    </button> -->
    <a href="'.$URL.'">
    <button class="btn-action">
      <ion-icon name="eye-outline"></ion-icon>
    </button>
    </a>
    <button class="btn-action">
      <ion-icon name="repeat-outline"></ion-icon>
    </button>
    <a href="'.$BagURL.'">
    <button class="btn-action">
      <ion-icon name="bag-add-outline"></ion-icon>
    </button>
    </a>
  </div>

</div>

<div class="showcase-content">

  <a href="'.$URL.'" class="showcase-category">'.$Categorie.'</a>

  <a href="'.$URL.'">
    <h3 class="showcase-title">'.$Nom.'</h3>
  </a>

  <!-- <div class="showcase-rating">
    <ion-icon name="star"></ion-icon>
    <ion-icon name="star"></ion-icon>
    <ion-icon name="star"></ion-icon>
    <ion-icon name="star-outline"></ion-icon>
    <ion-icon name="star-outline"></ion-icon>
  </div> -->

  <div class="price-box">
    <p class="price">'.$Prix.' DH</p>
  </div>

</div>

</div>';
  }
}
                else
                {
                  $List = "<span> !!!!!! Aucun Produit !!!!!! </span>";
                }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DR.CAR Shop</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style-prefix.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {

              $("#plus").click(function () {
                  $("#listt").toggle('slow');
              });
        });
    </script>
<style>
  .showw
  {
    display: none;
  }
  .pimg
  {
    
    width : 180px !important;
    height : 160px !important;
    object-fit: contain !important;
    padding : 12px;
  }
  /* .bb:hover + .dropdown-list
  {
    opacity: 1 !important;
    display : block !important;
    visibility : visible !important;
  } */
  /* .gg:hover  .dropdown-list
  {
    opacity: 1 !important;
    display : block !important;
    visibility : visible !important;
  }
  .dropdown-list:hover
  {
    opacity: 1 !important;
    display : block !important;
    visibility : visible !important;
  } */
  
  .cc
  {
    top: 4% !important;
    left: 83.5%;
    width: 9%;
    opacity: 1 !important;
    display : none;
    visibility : visible !important;
  }
  .it
  {
    pointer-events: visible;
    font-size : 18px !important;
    cursor: pointer !important;
    font-weight: 600;
  }
  .it:hover
  {
    color : white !important;
  }
</style>
</head>

<body>


  

  <!--
    - MODAL
  -->

  





  <!--
    - NOTIFICATION TOAST
  -->

  





  <!--
    - HEADER
  -->

  <header>
    <div class="header-main">

      <div class="container">

        <a href="../index.php" class="header-logo">
          <!-- <img src="./assets/images/logo/logo.svg" alt="Anon's logo" width="120" height="36"> -->
          <h1>DR-CAR</h1>
        </a>

        <div style="visibility:hidden;" class="header-search-container">

          <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

          <button class="search-btn">
            <ion-icon name="search-outline"></ion-icon>
          </button>

          

        </div>

        <div class="gg header-user-actions">
          <a class="bb menu-title">
           <button class="action-btn" id="per">
            <ion-icon name="person-outline"></ion-icon>
          </button>
          </a>
          <ul style="background-color : black;" id="menuu" class="cc dropdown-list">

              <li class="it dropdown-item">
                <a class="it" href="../Profile/user_page.php?res=ma">My Profil</a>
              </li>

              <li class="it dropdown-item">
                <a href="ToLogOut.php?log=true" class="it">LOGOUT</a>
              </li>

              <li class="it dropdown-item">
                <a href="My Actions.php?res=ma" class="it">Mes Action</a>
              </li>

            </ul>

          <!-- <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="count">0</span>
          </button>  -->
          
          <a href="/DR-CAR/Dr.Car Market/Cart/index.php?res=ma">
          <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count"><?php echo $All ?></span>
          </button>
          </a>
        </div>

      </div>

    </div>

    <nav class="desktop-navigation-menu">

      <div  class="container">

        <ul class="desktop-menu-category-list">

          <li class="menu-category">
            <a href="Market.php" class="menu-title">Home</a>
          </li>

          <li class="menu-category">
            <a href="#" class="menu-title">Categories</a>

            <div  class="dropdown-panel">

               <ul style="visibility:hidden ;" class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="#">Electronics</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Desktop</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Laptop</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Camera</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Tablet</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Headphone</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">
                    <img src="./assets/images/electronics-banner-1.jpg" alt="headphone collection" width="250"
                      height="119">
                  </a>
                </li>

              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="Market.php?cat=Cars">Cars</a>
                </li>

                

                <li class="panel-list-item">
                  <a href="Market.php?cat=Cars">
                    <img src="./assets/images/Cars.jpg" alt="men's fashion" width="250" height="119">
                  </a>
                </li>

              </ul>

              <ul class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="Market.php?cat=Parts">Parts</a>
                </li>

                <li class="panel-list-item">
                  <a href="Market.php?cat=Batterie">Batterie</a>
                </li>

                <li class="panel-list-item">
                  <a href="Market.php?cat=Moteur">Moteur</a>
                </li>

                <li class="panel-list-item">
                  <a href="Market.php?cat=Roue">Roue</a>
                </li>

                <li class="panel-list-item">
                  <a href="Market.php?cat=Siege">Siege</a>
                </li>

                <li class="panel-list-item">
                  <a href="Market.php?cat=Parts">
                    <img src="./assets/images/Parts.jpg" alt="women's fashion" width="250" height="119">
                  </a>
                </li>

              </ul>

              <!-- <ul style="visibility:hidden ;" class="dropdown-panel-list">

                <li class="menu-title">
                  <a href="#">Electronics</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Smart Watch</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Smart TV</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Keyboard</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Mouse</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">Microphone</a>
                </li>

                <li class="panel-list-item">
                  <a href="#">
                    <img src="./assets/images/electronics-banner-2.jpg" alt="mouse collection" width="250" height="119">
                  </a>
                </li>

              </ul> -->

            </div>
          </li>

          <li class="menu-category">
            <a href="Market.php?cat=Cars" class="menu-title">Cars</a>
          </li>

          <li class="menu-category">
            <a href="Market.php?cat=Parts" class="menu-title">Parts</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="Market.php?cat=Batterie">Batterie</a>
              </li>

              <li class="dropdown-item">
                <a href="Market.php?cat=Moteur">Moteur</a>
              </li>

              <li class="dropdown-item">
                <a href="Market.php?cat=Roue">Roue</a>
              </li>

              <li class="dropdown-item">
                <a href="Market.php?cat=Siege">Siege</a>
              </li>

            </ul>
          </li>

        </ul>

      </div>

    </nav>

    <div class="mobile-bottom-navigation">

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <button class="action-btn">
        <ion-icon name="bag-handle-outline"></ion-icon>

        <span class="count">0</span>
      </button>

      <button class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </button>

      <button class="action-btn">
        <ion-icon name="heart-outline"></ion-icon>

        <span class="count">0</span>
      </button>

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
        <h2 class="menu-title">Menu</h2>

        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">

        <li class="menu-category">
          <a href="#" class="menu-title">Home</a>
        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Men's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Shirt</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Shorts & Jeans</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Safety Shoes</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Wallet</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Women's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Dress & Frock</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Earrings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Necklace</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Makeup Kit</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Jewelry</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Earrings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Couple Rings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Necklace</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Bracelets</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Perfume</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Clothes Perfume</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Deodorant</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Flower Fragrance</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Air Freshener</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Blog</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Hot Offers</a>
        </li>

      </ul>

      <div class="menu-bottom">

        <ul class="menu-category-list">

          <li class="menu-category">

            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Language</p>

              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>

              <li class="submenu-category">
                <a href="#" class="submenu-title">English</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Espa&ntilde;ol</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Fren&ccedil;h</a>
              </li>

            </ul>

          </li>

          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Currency</p>
              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>
              <li class="submenu-category">
                <a href="#" class="submenu-title">USD &dollar;</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">EUR &euro;</a>
              </li>
            </ul>
          </li>

        </ul>

        <ul class="menu-social-container">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </nav>

  </header>





  <!--
    - MAIN
  -->

  <main>

    <!--
      - BANNER
    -->

    <div class="banner">

      <div class="container">

        <div class="slider-container has-scrollbar">

          <div class="slider-item">

            <img src="./assets/images/B1.jpg" alt="women's latest fashion sale" class="banner-img">

            <div class="banner-content">

              <p style="color:black;" class="banner-subtitle">Trending item</p>

              <h2 class="banner-title">latest Cars sale</h2>

              

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img src="./assets/images/B2.jpg" alt="modern sunglasses" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Trending accessories</p>

              <h2 style="color:white;" class="banner-title">Modern Car glasses</h2>

              

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

          <div class="slider-item">

            <img src="./assets/images/B3.jpg" alt="new fashion summer sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Sale Offer</p>

              <h2 style="color:white;" class="banner-title">New Cars sale</h2>

              

              <a href="#" class="banner-btn">Shop now</a>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - CATEGORY
    -->

    <!-- <div class="category">

      <div class="container">

        <div class="category-item-container has-scrollbar">

          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/dress.svg" alt="dress & frock" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Dress & frock</h3>

                <p class="category-item-amount">(53)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/coat.svg" alt="winter wear" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Winter wear</h3>

                <p class="category-item-amount">(58)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/glasses.svg" alt="glasses & lens" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Glasses & lens</h3>

                <p class="category-item-amount">(68)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/shorts.svg" alt="shorts & jeans" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Shorts & jeans</h3>

                <p class="category-item-amount">(84)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/tee.svg" alt="t-shirts" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">T-shirts</h3>

                <p class="category-item-amount">(35)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/jacket.svg" alt="jacket" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Jacket</h3>

                <p class="category-item-amount">(16)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/watch.svg" alt="watch" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Watch</h3>

                <p class="category-item-amount">(27)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/hat.svg" alt="hat & caps" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Hat & caps</h3>

                <p class="category-item-amount">(39)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div>

        </div>

      </div>

    </div> -->





    <!--
      - PRODUCT
    -->

    <div class="product-container">

      <div class="container">


        <!--
          - SIDEBAR
        -->

        <div class="sidebar  has-scrollbar" data-mobile-menu>

          <div class="sidebar-category">

            <div class="sidebar-top">
              <h2 class="sidebar-title">Category</h2>

              <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
              </button>
            </div>

            <ul class="sidebar-menu-category-list">

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>
                  <a href="Market.php?cat=Cars">
                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/car.png" alt="Cars" width="30" height="25"
                      class="menu-title-img">

                    <p class="menu-title">Cars</p>
                  </div>
</a>
                  <!-- <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div> -->

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Shirt</p>
                      <data value="300" class="stock" title="Available Stock">300</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">shorts & jeans</p>
                      <data value="60" class="stock" title="Available Stock">60</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">jacket</p>
                      <data value="50" class="stock" title="Available Stock">50</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">dress & frock</p>
                      <data value="87" class="stock" title="Available Stock">87</data>
                    </a>
                  </li>

                </ul>

              </li>

              <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>
<a href="Market.php?cat=Parts">
                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/Parts.png" alt="Parts" class="menu-title-img" width="30"
                      height="30">

                    <p class="menu-title">Parts</p>
                  </div>
</a>
                  <div id="plus">
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="showw" id="listt" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="Market.php?cat=Batterie" class="sidebar-submenu-title">
                      <p class="product-name">Batterie</p>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="Market.php?cat=Moteur" class="sidebar-submenu-title">
                      <p class="product-name">Moteur</p>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="Market.php?cat=Roue" class="sidebar-submenu-title">
                      <p class="product-name">Roue</p>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="Market.php?cat=Siege" class="sidebar-submenu-title">
                      <p class="product-name">Siege</p>
                    </a>
                  </li>

                </ul>

              </li>

              

            </ul>

          </div>

          

        </div>



        <div class="product-box">

          <!--
            - PRODUCT MINIMAL
          -->

          



          <!--
            - PRODUCT FEATURED
          -->

          



          <!--
            - PRODUCT GRID
          -->

          <div class="product-main">

            <h2 class="title">All Products</h2>

            <div class="product-grid">
                <?php 
                
                echo $List;

                ?>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>

      <div class="container">

        <div class="testimonials-box">

          <!--
            - TESTIMONIALS
          -->

          <div class="testimonial">

            <h2 class="title">testimonial</h2>

            <div class="testimonial-card">

              <img src="./assets/images/testimonial-1.jpg" alt="alan doe" class="testimonial-banner" width="80" height="80">

              <p class="testimonial-name">Alan Doe</p>

              <p class="testimonial-title">CEO & Founder Invision</p>

              <img src="./assets/images/icons/quotes.svg" alt="quotation" class="quotation-img" width="26">

              <p class="testimonial-desc">
                My Company Dr-Car is the best Company of car's Sale
              </p>

            </div>

          </div>



          <!--
            - CTA
          -->

          <div class="cta-container">

            <img src="./assets/images/cta-banner.jpg" alt="summer collection" class="cta-banner">

            <a href="#" class="cta-content">

              <p class="discount">25% Discount</p>

              <h2 class="cta-title">Summer collection</h2>

              <p class="cta-text">Starting @ $10</p>

              <button class="cta-btn">Shop now</button>

            </a>

          </div>



          <!--
            - SERVICE
          -->

          <div class="service">

            <h2 class="title">Our Services</h2>

            <div class="service-container">

              <a href="#" class="service-item">

                <div class="service-icon">
                  <ion-icon name="boat-outline"></ion-icon>
                </div>

                <div class="service-content">

                  <h3 class="service-title">Worldwide Delivery</h3>
                  <p class="service-desc">For Order Over $100</p>

                </div>

              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="rocket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Next Day delivery</h3>
                  <p class="service-desc">UK Orders Only</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="call-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Best Online Support</h3>
                  <p class="service-desc">Hours: 8AM - 11PM</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="arrow-undo-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Return Policy</h3>
                  <p class="service-desc">Easy & Free Return</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="ticket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">30% money back</h3>
                  <p class="service-desc">For Order Over $100</p>
              
                </div>
              
              </a>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - BLOG
    -->

    

  </main>





  <!--
    - FOOTER
  -->

  <footer>

    

    
    <center><div><h2 class="nav-title" style="color: white;">created by <span style="color: orangered;">youness benbakka & Hamza Moumtaz</span> | all rights reserved</h2></div></center>

  </footer>






  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
          var a = 0
         $(document).ready(function() {

             $("#per").click(function () {
                 if(a==0)
                 {
                   
                $("#menuu").show();
                a=1;
            }
                else
                {
                    $("#menuu").hide();
                a=0;
                }

             });

         });
			
      </script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>