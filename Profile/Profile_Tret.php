 
<?php
try {
   $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
   echo 'Erreur de connexion: ' . $e->getMessage();
}
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(array_key_exists('logout', $_POST)) 
    {
        session_destroy();
        header('Location:'.'../Login/index.php');
    }

    elseif(array_key_exists('update', $_POST))
    {
       $Nom = $_POST['name'];
       $Prenom = $_POST['prenom'];
       $Login = $_POST['login'];
       
       $Code = $_SESSION["ID_UT"];
       $image_tmp = $_FILES['img']['tmp_name'];
       $old_image = $_POST['old_image'];
       if($_POST['new_pass'] == "")
       {
            $Pass = $_POST['old_pass_res'];
       }
        else
        {
            $Pass = $_POST['new_pass'];
        }
       
       
       if(empty($_FILES["img"]["name"]))
            $Img = $_POST['old_image'];
        else
        {
            $Img = "image/".$_FILES["img"]["name"];
            unlink($old_image);
        }

      $UTTable = $cn -> prepare("UPDATE utilisateur set Nom_Ut = ?, Prenom_Ut = ? ,Login_Ut = ?,Password_Ut = ?,Img_Ut = ? WHERE Code_Ut = ?");
      $UTTable->execute(array($Nom,$Prenom,$Login,$Pass,$Img,$Code));
      $UTTable->closeCursor();
      move_uploaded_file($image_tmp,$Img);
      
      header('Location:'.'user_page.php?er=Modified');

            
    }
    
}


?>