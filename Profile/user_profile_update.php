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

      $ret = "user_page.php";
      if(isset($_GET['res']) == true)
      {
         if($_GET["res"] != NULL)
         {
            if($_GET["res"] == "ma")
            {
               $ret = "user_page.php?res=ma";
              
            }
            else if($_GET["res"] == "admin")
            {
               $ret = "user_page.php?res=admin";
              
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

   <title>user profile update</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<h1 class="title"> update <span><?php echo $Lign['Role_Ut']; ?></span> profile </h1>

<section class="update-profile-container">

   

   <form action="Profile_Tret.php" method="post" enctype="multipart/form-data">
      <img src="<?php echo $Lign['Img_Ut']; ?>" alt="">
      <div class="flex">
         <div class="inputBox">
            <span>Nom : </span>
            <input type="text" name="name" required class="box" placeholder="enter Votre Nom" value="<?php echo $Lign['Nom_Ut']; ?>">
            <span>Login : </span>
            <input type="text" name="login" required class="box" placeholder="enter your Login" value="<?php echo $Lign['Login_Ut']; ?>">
            <span>profile pic : </span>
            <input type="hidden" name="old_image" value="<?php echo $Lign['Img_Ut']; ?>">
            <input type="file" name="img" class="box" accept="image/jpg, image/jpeg, image/png">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass_res" value="<?php echo $Lign['Password_Ut']; ?>">
            <span>Prenom :</span>
            <input type="text" class="box" name="prenom" placeholder="enter Votre Prenom" value="<?php echo $Lign['Prenom_Ut']; ?>">
            <span>old password :</span>
            <input type="password" class="box" name="old_pass" placeholder="Enter the Previous password" >
            <span>new password :</span>
            <input type="password" class="box" name="new_pass" placeholder="Enter the new password" >
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" value="update profile" name="update" class="btn">
         <a href="<?php echo $ret ?>" class="option-btn">go back</a>
      </div>
   </form>

</section>

</body>
</html>