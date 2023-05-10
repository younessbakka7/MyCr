<?php 
try {
    $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
}
session_start();


      if(isset($_GET['log']) == true)
      {
         if($_GET["log"] != NULL)
         {
            if($_GET["log"] == "true")
            {
                session_destroy();
                $nbr = $cn->prepare("UPDATE visiteur SET nbr =nbr-1 ");
                    $nbr -> execute();
                header('Location:'.'../Login/index.php');
            }
         }
      }
      else
      {
        header('Location:'.'Market.php');
      }

?>