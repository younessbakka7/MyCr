<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="styleto.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <title>Mes Actions</title> 
    <style>
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
        .cc
        {
            width: 80%;
            height: 300px;

        }
        .boxes
        {
            margin-top : -40px !important;
        }
        .boxes .box
        {
            cursor: pointer !important;
            text-align: center;
        }
        .boxes .box:hover
        {
            transform: scale(1.1);
        }
        .box1
        {
            position: relative;
            left : 150px;
            top : 80px;

        }

        .box2
        {
            position: relative;
            right : 150px;
            top : 80px;
            
        }
        .text
        {
            font-size: 24px !important;
        }
        .a
        {
            
            text-decoration: none;
            /* width : 400px !important; */
        }
        .footer
        {
            background-color:#120b40 !important;
        }
    </style>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
<center><h1 style="background-color:#120b40;color:white;font-size:34px;">Mes Actions</h1></center>

<section class="bgg footer">
        <div class="share">
        <?php 
      if(isset($_GET['res']) == true)
      {
        $a = "";
        if($_GET['res']=="ma")
        {
          $a = "index.php";
        }
        else if($_GET['res']=="home")
        {
          $a = "../index.php";
        }
      }
      ?>
            <a href="<?php echo $a ?>" class="fab las la-home"> </a>
        </div>
    </section>
    <section class="dashboard">
        

        <div class="dash-content">
            <div class="overview">
               

                <div class="boxes">

                
                    <div class="box box1">
                    <a class="a" href="Mes Commande.php?res=<?php echo $_GET["res"] ?>">
                        <img class="cc" src="images/Commands.png" alt="Mes Commande">
                        <span class="text">Mes Commandes</span>
                        </a>  
                    </div>
                    

                    
                    <div class="box box2">
                    <a class="a" href="../Mes RDV/Mes Dommande.php?res=<?php echo $_GET["res"] ?>">
                        <img class="cc" src="images/RDV3.png" alt="Mes Rendez-vous">
                        <span class="text">Mes Rendez-vous</span>
                        </a> 
                    </div>
                 

                </div>
            </div>

           
        </div>
    </section>

    <script src="scriptto.js"></script>
</body>
</html>