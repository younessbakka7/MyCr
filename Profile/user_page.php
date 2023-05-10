<?php
try {
   $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
   echo 'Erreur de connexion: ' . $e->getMessage();
}
session_start();

      $Utilisateur = $cn->prepare("SELECT * FROM utilisateur WHERE Code_Ut = ?");
      $Utilisateur -> execute(array($_SESSION["ID_UT"]));
      $Lign = $Utilisateur->fetch(PDO::FETCH_ASSOC);

      $where = "../index.php";
      $maa = "user_profile_update.php";
      if(isset($_GET['res']) == true)
      {
         if($_GET["res"] != NULL)
         {
            if($_GET["res"] == "ma")
            {
               $maa = "user_profile_update.php?res=ma";
               $where = "../Dr.Car Market/Market.php";
            }
            else if($_GET["res"] == "admin")
            {
               $maa = "user_profile_update.php?res=admin";
               $where = "../ADMIN/index.php";
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

   <title>user page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h1 class="title"> <span><?php echo $Lign['Role_Ut']; ?></span> profile page </h1>

<section class="profile-container">

<form action="Profile_Tret.php" method="post">
   <div class="profile">
      <img src="<?php echo $Lign['Img_Ut']; ?>" alt="">
      <h3> <?php echo $Lign['Nom_Ut']." ".$Lign['Prenom_Ut']; ?> </h3>
      <a href="<?php echo $maa ?>" class="btn">update profile</a>
      <a href="<?php echo $where ?>" class="option-btn">go back</a>
      <input type="submit" value="logout" name="logout" class="delete-btn">
      
      

   </div>
   </form>
</section>

</body>
</html>