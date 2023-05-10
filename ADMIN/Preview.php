<?php 
try {
    $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
  }
  session_start();


if(isset($_GET['url']) == true)
{
   if($_GET["url"] != NULL)
   {
        $img = $_GET["url"];
   }
   else
   {
    header('Location:'.'index.php');
   }
}

else
   {
    header('Location:'.'index.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview</title>
    <style>
        img
        {
            width : 700px;
            height : 700px;
            margin-top : -7.5%;
            margin-left : 23%;
            margin-bottom : 0;
            object-fit: contain !important;
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
  position:absolute;
  top:450px;
  left:600px;
}

.checkout:hover {
  background-color: #494;
}
        </style>
</head>
<body>
    <img src="<?php echo $img ?>" alt="Product image" ></img>
    <?php 
    if(isset($_GET['res']) == true)
    {
      $a = "";
      if(isset($_GET['res']) == true)
      {
        
        if($_GET['res']=="ut")
        {
          $a = "Utilisateur.php";
        }
        else if($_GET['res']=="voi")
        {
          $a = "index.php";
        }
        
      }
      else
      {
        $a = "Commande.php";
      }
      
    }
    ?>
    <a href="<?php echo $a; ?>"><input type="button" style="cursor: pointer;margin-right:20px;background-color:orangered" class="checkout" value="Go Back"></button></a>
</body>
</html>