<?php 
try {
    $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(array_key_exists('Loginbtn', $_POST)) 
    {
        if(isset($_POST["Login"]) && isset($_POST["Password"]))
        {
            if(!empty($_POST["Login"]) && !empty($_POST["Password"]))
            {
                
                $Utilisateur = $cn->prepare("SELECT * FROM utilisateur WHERE Login_Ut = ? AND Password_Ut = ?");
                $Utilisateur -> execute(array($_POST["Login"],$_POST["Password"]));
                if($Utilisateur->rowCount() != 0)
                {
                    session_start();
                    $nbr = $cn->prepare("UPDATE visiteur SET nbr =nbr+1 ");
                    $nbr -> execute();

                    $Lign = $Utilisateur->fetch();
                    if($Lign["Statu_Ut"] == "Active")
                    {
                    $_SESSION["ID_UT"] = $Lign["Code_Ut"];
                    $_SESSION["Role"] = $Lign["Role_Ut"];
                    if($Lign["Role_Ut"] == "Admin")
                    header('Location:'.'../ADMIN/');
                    elseif($Lign["Role_Ut"] == "Utilisateur" || $Lign["Role_Ut"] == "Client")
                    header('Location:'.'../index.php');
                    }
                    else
                    {
                        header('Location:'.'index.php?er=Banned');
                    }
                }
                else
                {
                    header('Location:'.'index.php?er=LOGINC');
                }

            }
            else
            {
                header('Location:'.'index.php?er=CHVD');
            }
        }
        else
        {
            header('Location:'.'index.php?er=OBCN');
        }
    }
    elseif (array_key_exists('Register', $_POST))
    {
        header('Location:'.'Register.php');
    }
    elseif (array_key_exists('Cree', $_POST))
    {
        $Utilisateur = $cn->prepare("SELECT * FROM utilisateur WHERE Login_Ut = ?");
                $Utilisateur -> execute(array($_POST["Login"]));
                if($Utilisateur->rowCount() == 0)
                {
                    
                    $UTTable = $cn -> prepare("INSERT INTO utilisateur (Nom_Ut,Prenom_Ut,Login_Ut,Password_Ut,Role_Ut,Statu_Ut) VALUES(?,?,?,?,'Utilisateur','Active')");
                    $UTTable->execute(array($_POST['Nom'],$_POST['Prenom'],$_POST['Login'],$_POST['Password']));
                    $UTTable->closeCursor();
                    header('Location:'.'Register.php?er=Ajouter');
                }
                else
                {
                    header('Location:'.'Register.php?er=NonAjouter');
                }
        
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