<?php 


try {
    $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
  }
  session_start();

  $Commande = $cn->prepare("SELECT * FROM `commande` WHERE Code_Ut=?");
  $Commande -> execute(array($_SESSION["ID_UT"]));

$Cart = "";
$Num = 0;

  if($Commande->rowCount() != 0)
{
  for ($j=0; $j < $Commande->rowCount() ; $j++) 
  {
    $line1 = $Commande->fetch(PDO::FETCH_ASSOC);
    $Num=$Num+1;
      $NumC  = $line1["Num_C"];
      $DateC = $line1["Date_C"];
      $EtatC = $line1["Etat_C"];

      $Prod = $cn->prepare("SELECT COUNT(l.Code_P) as 'Count',SUM(p.Prix_P*l.Quan_C) as 'SUM' FROM commande c INNER JOIN ligne_de_commande l ON c.Num_C=l.Num_C INNER JOIN produit p on l.Code_P= p.Code_P WHERE  l.Num_C = ?");
      $Prod -> execute(array($NumC));
      if($Prod->rowCount() != 0)
      {
        
            $line2 = $Prod->fetch(PDO::FETCH_ASSOC);
            $Count = $line2["Count"];
            $Sum = $line2["SUM"];
      }

      $Cart=$Cart.'

      <div style="margin-top: -50px;" class="profile-container">

  <p style="margin-top: -70px; padding-bottom:25px;" class="info full-name">Commande N°'.$Num.' </p>
          <div class="nn">
              <p style="" class="cc info role">
                  <span style="font-size: 25px; text-decoration: none;">📆 </span>'.$DateC.'
              </p>

              <p class="cc info place">
                  <span style="font-size: 25px;">📋 </span>'.$EtatC.'
                  
              </p>

              <p style="margin-top: -30px;" class="cc info place">
                  <span style="font-size: 25px;">🛒</span>
                  '.$Count.' Produit
              </p>

              <p style="margin-top: -30px;" class="cc info place">
                  <span style="font-size: 25px;">💰 </span>
                  '.$Sum.' DH
              </p>

          </div>  
          <a style="text-decoration:none;margin-top: -20px;" href="Detaille Commande.php?num='.$NumC.'&res='.$_GET["res"].'" class="up action"> Detaills Commande </a>        
</div>';

  }
}







?>

<!DOCTYPE html>
<html lang="en">


<head>
    <title>Mes Commandes</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="../css/style.css">
    <style>

        .fas {
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            line-height: 1
        }

        .fa-star:before {
            content: "\f005"
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #334e64;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            min-height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(20deg, #502101, #000000);
        }

        .profile-container {
            position: relative;
            background-color: #fff;
            width: 350px;
            padding: 100px 50px 40px;
            border-radius: 12px;
            box-shadow: 0 0 60px 5px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .img-container {
            width: 130px;
            height: 130px;
            overflow: hidden;
            border: 5px solid #b92a76;
            border-radius: 50%;
            box-shadow: 0 8px 55px #b92a76a4;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .img-container img {
            width: 100%;
            max-width: 100%;
            transform: scale(1.1);
        }

        .info {
            margin-bottom: 12px;
        }

        .info i {
            margin-right: 8px;
            font-size: 1.1em;
        }

        .place {
            margin-bottom: 40px;
        }

        .full-name {
            font-size: 1.4em;
            font-weight: bold;
            letter-spacing: 1px;
            color: #ff3d00;
        }

        .posts-info {
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            font-size: 1.1em;
            letter-spacing: 0.5px;
            margin-bottom: 30px;
            text-align: center;
        }

        .posts-info span {
            display: block;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .social-container {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .social-container i {
            color: #fff;
        }

        .social-container button {
            border: none;
            outline: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 1.2em;
            cursor: pointer;
            box-shadow: 0px 5px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s;
        }

        .social-container button:hover {
            transform: scale(1.1);
        }

        /* Social colors */

        .social-container button.youtube {
            background: linear-gradient(45deg, #ff000088, #ff0000);
        }

        .social-container button.linkedin {
            background: linear-gradient(45deg, #0e76a888, #0e76a8);
        }

        .social-container button.instagram {
            background: linear-gradient(45deg, #e6683ccc 25%, #dc2743 50%,
                    #bc1888 100%);
        }

        .social-container button.github {
            background: linear-gradient(45deg, #33333388, #333333);
        }

        .action {
            outline: none;
            cursor: pointer;
            color: #fff;
            background-color: #000048;
            border: none;
            border-radius: 50px;
            padding: 12px 20px;
            width: 80%;
            margin-top: 25px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            font-size: 1em;
            font-weight: bold;
            letter-spacing: 2px;
            transition: transform 0.3s, opacity 0.3s;
        }

        .action.message {
            background-color: #6741ff;
        }

        .action:hover {
            transform: scale(1.05);
            /* opacity: 0.85; */
            background-color: #0303ca;
        }

        .up 
        {
            width: 250px;
            text-align : center;
        }

        .Contrats {
            display: flex;
            flex-wrap: wrap;
            /* border: 2px black solid; */
            margin: 120px 80px;
            margin-bottom: 0;
        }

        .profile-container {
            margin: 20px;
        }
        .tt
        {
            position: absolute;
            top: 0;
            margin-top: 40px;
            color: white;
            font-size: 40px;
            left:40%;
        }
        .cc {
            position: relative;
    left: 12px;
        }
        .nn 
        {
            display: flex;
            flex-direction: column;
            
        }
        .nn *
        {
            color: black;
            margin-left: -20px;
            
        }
            .nn p {
                font-size: 15px;
                 font-weight: bold;
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
    <form id="form1">
        <h1 class="tt">Mes Commande</h1>
        <section class="bgg footer">
        <div class="share">
            <a href="My Actions.php?res=<?php echo $_GET["res"] ?>" class="fab las la-home"> </a>
        </div>
    </section>
        <div class="Contrats">
            <?php echo $Cart; ?>
        </div>

    </form>
</body>
</html>
