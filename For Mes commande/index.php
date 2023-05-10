<?php 
try {
    $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
}
session_start();

if($_SESSION["ID_UT"] == NULL)
{
    header('Location:'.'Login/index.php?er=OBCN');
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    if(array_key_exists('LOGOUT', $_POST)) 
    {
        session_destroy();
        header('Location:'.'Login/index.php');
    }
}

    $hh = "";
    $ProduiC = 0;
    $CommandeC = 0;
        $Commande = $cn->prepare("SELECT * FROM commande WHERE Code_Ut = ?");
        $Commande -> execute(array($_SESSION["ID_UT"]));
        
        if($Commande->rowCount() != 0)
        {
            for ($j=0; $j < $Commande->rowCount() ; $j++) 
                {
                    $CommandeC = $CommandeC+1;
                    
                    if(($CommandeC == 2 && $ProduiC == 3) || ($CommandeC == 1 && $ProduiC == 4))
                                {
                                    $hh = $hh."<center><span class='more'> And More ... </span></center>";
                                    break;
                                }
                                else{
                    $hh = $hh."<h3 class='comm'>Commande : ".  $j+1 ."</h3>";
                        $Line1 = $Commande->fetch(PDO::FETCH_ASSOC);
                        $Prod = $cn->prepare("SELECT `produit`.`Nom_P` as 'N',`produit`.`Prix_P` as 'P',`produit`.`Img_P` as 'I' FROM `ligne_de_commande` INNER JOIN `produit` on `ligne_de_commande`.`Code_P` = `produit`.`Code_P` WHERE `ligne_de_commande`.`Num_C` = ?;");
                        $Prod -> execute(array($Line1["Num_C"]));
                        if($Prod->rowCount() != 0)
                        {
                            
                            for ($i=0; $i < $Prod->rowCount() ; $i++) 
                            { 
                                $ProduiC = $ProduiC+1;
                                
                                
                                
                                    
                                $line = $Prod->fetch(PDO::FETCH_ASSOC);
                            $image = $line["I"];
                            $Name = $line["N"];
                            $Prix = $line["P"];
                            $hh = $hh. '<div class="cart-item">
                            
                            


                            <img class="itemimgm" src="'.$image.'" alt="">
                            <div class="content">
                                <h3>'.$Name.'</h3>
                                <div style="font-size:16px;" class="price">'.$Prix.' DH</div>
                            </div>
                        </div>'; 
                        if(($CommandeC == 2 && $ProduiC == 3) || ($CommandeC == 1 && $ProduiC == 4))
                                {
                                    $hh = $hh."<center><span class='more'> And More ... </span></center>";
                                    break;
                                }
                            
                            }
                        
                        }
                    }
                }
        }    
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DR.CAR</title>
    <link rel="icon" type="image/x-icon" href="images/icon.ico">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        .cart-item
        {
            cursor: pointer;
        }
        .cart-item:hover
        {
            
            background-color : rgb(204, 226, 255);
        }
        .footer .brand a
{
    height: 15rem;
    width: 15rem;
    line-height: 15rem;
    font-size: 12rem;
    color:#fff;
    border:var(--border);
    margin:.3rem;
    border-radius: 50%; 
        
}
.itemimgm
{
    width : 40%;
}
.more
{
    text-align : center;
    font-size : 15px;
    padding-top : 5px;

}
.comm
{
    padding-top : 11px;
    font-size : 24px;
    font-family : Helvetica;
    color :orangered;
    border-bottom: 1px dashed black;
    border-top: 1px dashed black;
    padding-bottom : 11px;
}
.brand
{
    display: flex;
    justify-content: space-between;
    background-color: transparent;
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
}
::selection {
  
  background: gainsboro;
}
.bbgg
{
    background-color: rgb(1, 5, 42);
    border-top:1px solid gold;
}
.Parrr
{
    font-family: inter;
    font-size: 24px;
    font-weight: 900;
    letter-spacing: 2px;
}
.Profil
{
    background-color:rgba(255, 255, 255, 0.429);
    border : none;
    width : 100%;
    
    color : Black;
    font-size : 3rem;
    font-family: 'Roboto';
    
}
.Profil:hover
{
    color: var(--main-color);
    /* border-bottom: .1rem solid var(--main-color); */
    cursor: pointer;
    background-color : rgba(157, 166, 255, 0.429);
    
}
.menuu
{
   display:none;
    background-color : transparent;
   position: absolute;
   top:97px;
   right : 370px;
   height : 74px;
   width : 190px;
}
    </style>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
      <script>
          var a = 0
         $(document).ready(function() {

             $("#Pro").click(function () {
                 if(a==0)
                 {
                $("#drop").show();
                a=1;
            }
                else
                {
                    $("#drop").hide();
                a=0;
                }

             });

         });
			
      </script>

</head>
<body>
    
<!-- header section starts  -->

<header class="header">

    <a href="index.php" class="logo">
        

        <img src="images/LogoCar.png" alt="">
    </a>
    <form method="POST">
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="Our Services.php">Our Services</a>
        <a href="#about">About</a>
        <a href="Contact US.php">contact</a>
        <a href="#contact">Our Offers</a>
        <a href="#" id="Pro">Profil</a>
  
    </nav>
    </form>
    
    <div class="icons">
        <div  id="search-btn"></div>
        <div class="fas fa-shopping-cart" id="cart-btn"></div>
        <div class="fas fa-bars" id="menu-btn"></div>
    </div>

    <div class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </div>

    <div  class="cart-items-container">
        
    <?php 
        echo $hh;
    ?>
        
        
        <a href="#" class="btn">checkout now</a>
    </div>

</header>

<!-- header section ends -->
    
<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">

        <h3 style="font-size: 77px; color: rgba(255, 255, 255);
        text-shadow: 2px 8px 6px rgba(0,0,0,0.2),
                         0px -5px 35px rgba(255,255,255,0.3);">DR.Car</h3>
        <!-- <br><br><br> -->
        <h1 style="font-size: 26px;color: transparent;">.</h1>
        <!-- <br><br><br> -->
        <p class="Parrr">Decidedly sporty design, accentuated by the wheels as standard. The rear has a gritty appearance thanks to the silver skid plate that ensures greater safety in off-road conditions.</p>
        <a href="Our Services.php" class="btn">get Our Services</a>
        
    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span>about</span> us </h1>

    <div class="row">

        <div class="image">
            <img src="images/about-img.jpeg" alt="">
        </div>

        <div class="content">
            <h3>what makes our Services special?</h3>
            <p>No key transfer with our technicians. <br /> Leave your car unlocked or request for your technician to contact you.</p>
            <p>Save your time for the important things in life. <br /> We come to you - quit wasting time at the car wash.</p>
            <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- Popular Brands section Start -->
<section class="bgg footer">
    <h1 class="heading"> Popular <span>Brands</span> </h1>
    <div class="share brand">
        <a href="#" class="fab"> <img class="imgbr" src="images/ALpha.png" alt="BMW"></a>
        <a href="#" class="fab"> <img class="imgbr" src="images/SKODAA.png" alt="Mercides">  </a>
        <a href="#" class="fab"> <img class="imgbr" src="images/BMW.png" alt="Lambergini"></a>
        <a href="#" class="fab"> <img class="imgbr" src="images/mercedes-benz-logo-1-1.png" alt="bugatti"> </a>
        <a href="#" class="fab"> <img class="imgbr" src="images/Wolswagen.png" alt="Wolswagen"></a>
        <a href="#" class="fab"> <img class="imgbr" src="images/peugeot.png" alt="Wolswagen"></a>
        <a href="#" class="fab"> <img class="imgbr" src="images/Suz_history_6.svg.png" alt="Wolswagen"></a>
    </div>
</section>
<!-- Popular Brands section ends -->

<!-- Popular products section Start -->
<section class="products" id="products">

    <h1 class="heading"> Popular <span>products</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <div class="image">
                <img src="images/product-1.png" alt="">
            </div>
            <div class="content">
                <h3>fresh coffee</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="price">$15.99 <span>$20.99</span></div>
            </div>
        </div>

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <div class="image">
                <img src="images/product-2.png" alt="">
            </div>
            <div class="content">
                <h3>fresh coffee</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="price">$15.99 <span>$20.99</span></div>
            </div>
        </div>

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <div class="image">
                <img src="images/product-3.png" alt="">
            </div>
            <div class="content">
                <h3>fresh coffee</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="price">$15.99 <span>$20.99</span></div>
            </div>
        </div>

    </div>

</section>

<!-- Popular Products section ends -->

<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> customer's <span>review</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi nulla sit libero nemo fuga sequi nobis? Necessitatibus aut laborum, nisi quas eaque laudantium consequuntur iste ex aliquam minus vel? Nemo.</p>
            <img src="images/pic-1.png" class="user" alt="">
            <h3>john deo</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi nulla sit libero nemo fuga sequi nobis? Necessitatibus aut laborum, nisi quas eaque laudantium consequuntur iste ex aliquam minus vel? Nemo.</p>
            <img src="images/pic-2.png" class="user" alt="">
            <h3>john deo</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
        
        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi nulla sit libero nemo fuga sequi nobis? Necessitatibus aut laborum, nisi quas eaque laudantium consequuntur iste ex aliquam minus vel? Nemo.</p>
            <img src="images/pic-3.png" class="user" alt="">
            <h3>john deo</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>

    </div>

</section>

<!-- review section ends -->


<!-- blogs section starts  -->

<section class="blogs" id="blogs">

    <h1 class="heading"> our <span>Provider</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image" >
                <img src="images/michelin-logo.jpg" alt="">
            </div>
            <div class="content">
                <a href="https://www.bosch-home.ca/en/" class="title" target="_blank">michelin Top facon d'avancer</a>
                <span>21st may, 2021</span>
                <p>Michelin is a company that is the second in the world in the rubber tire industry.</p>
                <a href="https://www.bosch-home.ca/en/" class="btn" target="_blank">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image" >
                <img src="images/Lamborghini-logo (1).png" alt="">
            </div>
            <div class="bbgg content" >
                <a href="https://www.lamborghini.com/en-en" class="title" target="_blank">Lamborghini World</a>
                <span>21st may, 2021</span>
                <p>Automobili Lamborghini S.p.A. or Lamborghini is an Italian car manufacturer.</p>
                <a href="https://www.lamborghini.com/en-en" class="btn" target="_blank">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="images/Rma_755359049.jpg" alt="">
            </div>
            <div class="content">
                <a href="https://www.rmaassurance.com/" class="title" target="_blank">Royal moroccan d'accurence</a>
                <span>21st may, 2021</span>
                <p>It is an international Moroccan insurance company established under the name RMA.</p>
                <a href="https://www.rmaassurance.com/" class="btn" target="_blank">read more</a>
            </div>
        </div>

    </div>

</section>

<!-- blogs section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-whatsapp"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-youtube"></a>
        <a href="#" class="fab fa-telegram"></a>
    </div>

    <div class="links">
        <a href="index.php">Home</a>
        <a href="Our Services.php">Our Services</a>
        <a href="#">About</a>
        <a href="Contact US.php">Contact</a>
        <a href="#">Our Offers</a>
    </div>

    <div class="credit">created by <span>Lakbouri Hamza & Salah</span> | all rights reserved</div>

</section>

<!-- footer section ends -->

















<!-- custom js file link  -->
<script src="js/script.js"></script>
<div class="menuu" id="drop">
    <form action="" method="post">
        <center><a style="display : block;" href="Profile/user_page.php" class="Profil" name="Ma_Profile">My Profil</a><center>
        <input  class="Profil" type="submit" name="LOGOUT" value="Logout">
        </form>
        </div>
</body>
</html>