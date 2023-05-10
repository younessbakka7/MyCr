<?php 

try {
    $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
}
session_start();

if($_SESSION["ID_UT"] == NULL)
{
    header('Location:'.'../Login/index.php?er=OBCN');
}
if(isset($_SESSION["ID_UT"]) && isset($_SESSION["Role"]))
	{
		if(!empty($_SESSION["ID_UT"]) && !empty($_SESSION["Role"]))
		{
            if($_SESSION["Role"] != "Admin")
			header('Location:'.'../index.php');
		}
	}

    $UT = $cn->prepare("select * from utilisateur where Code_Ut = ?");
$UT -> execute(array($_SESSION["ID_UT"]));
$lineut = $UT->fetch(PDO::FETCH_ASSOC);



$Prod = $cn->prepare("select count(Num_C) as 'C' from commande where Date_C = ?");
$Prod -> execute(array(date("Y-m-d")));
$line = $Prod->fetch(PDO::FETCH_ASSOC);
$nbr = $line["C"];

$Viss = $cn->prepare("select * from visiteur");
$Viss -> execute();
$line = $Viss->fetch(PDO::FETCH_ASSOC);
$vist = $line["nbr"];

$Prod = $cn->prepare("SELECT SUM(p.Prix_P*l.Quan_C) as 'Total' FROM commande c INNER JOIN ligne_de_commande l ON l.Num_C=c.Num_C INNER JOIN produit p on l.Code_P=p.Code_P WHERE c.Date_C = ?''");
$Prod -> execute(array(date("Y-m-d")));
$line = $Prod->fetch(PDO::FETCH_ASSOC);
$Totale = "0";
if($Prod->rowCount() != 0)
{
$Totalee = $line["Total"];
}

$Prod = $cn->prepare("SELECT COUNT(l.Code_P) as 'count'  FROM commande c INNER JOIN ligne_de_commande l ON l.Num_C=c.Num_C INNER JOIN produit p on l.Code_P=p.Code_P WHERE c.Date_C = ?");
$Prod -> execute(array(date("Y-m-d")));
$cont = "0";
if($Prod->rowCount() != 0)
{
    $line = $Prod->fetch(PDO::FETCH_ASSOC);

$cont = $line["count"];
}



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(array_key_exists('Del', $_POST)) 
    {
        if(isset($_POST["Rows"]))
        {
            if(!empty($_POST["Rows"]))
            {
                
                
                    $Checks = $_POST["Rows"];
                    foreach($Checks as $Ref_V_P)
                    {
                        $Delete1 = $cn->prepare("DELETE from utilisateur where Code_Ut = ?");
                        $Delete1 -> execute(array($Ref_V_P));
                    }
                
            }
            
        }
        else
            {
             echo "<script> alert('No One Selected'); </script>";   
            }
    }
    if(array_key_exists('ADD', $_POST)) 
    {
        
                
                
        $img = "image/".$_FILES["Uimg"]["name"];
                        $Insert1 = $cn->prepare("INSERT INTO utilisateur VALUES(NULL,?,?,?,?,?,?,?)");
                        $Insert1 -> execute(array($_POST["Unom"],$_POST["Uprenom"],$_POST["Ulogin"],$_POST["Upass"],$_POST["Urole"],$_POST["Ustatu"],$img));

                        

                        
                        
      
    }
    if(array_key_exists('Save', $_POST))
    {
        $Imgg = "image/".$_FILES["Uimg2"]["name"];
        $Update = $cn->prepare("UPDATE utilisateur SET Nom_Ut=? , Prenom_Ut=? , Login_Ut=? , Password_Ut=? , Role_Ut=? , Statu_Ut=? ,Img_Ut =? WHERE Code_Ut = ?");
                        $Update -> execute(array($_POST["Unom2"],$_POST["Uprenom2"],$_POST["Ulogin2"],$_POST["Upass2"],$_POST["Urole2"],$_POST["Ustatu2"],$Imgg,$_GET["ref"]));

                        
                        echo "<script> alert('Bien Modifier'); </script>"; 

                        header('Location:'.'Utilisateur.php');
                        
                        
        
    }
}
$SS = "";
if(isset($_GET['search']) == true)
{
    $SS = $_GET['search'];
$Utilisateur = $cn->prepare('SELECT * FROM utilisateur  WHERE  Nom_Ut LIKE ? "%%" OR Prenom_Ut LIKE ? "%%"');
$Utilisateur -> execute(array($_GET['search'],$_GET['search']));
if($Utilisateur->rowCount() != 0)
{
    $Table = "";
    for ($j=0; $j < $Utilisateur->rowCount() ; $j++) 
    {
        $lineV = $Utilisateur->fetch(PDO::FETCH_ASSOC);

        $Ref         = $lineV["Code_Ut"];
        $Nom      = $lineV["Nom_Ut"];
        $Prenom      = $lineV["Prenom_Ut"];
        $Login       = $lineV["Login_Ut"];
        $Pass   = $lineV["Password_Ut"];
        $Role       = $lineV["Role_Ut"];
        $Statu = $lineV["Statu_Ut"];
        $Img1        = "../Profile/".$lineV["Img_Ut"];


        if(!isset($_GET['row']) == true)
{
   
    $Table = $Table.'<tr>
    <td><input class="form-check-input" type="checkbox" name="Rows[]" onclick="Checkone()" value="'.$Ref.'"></td>
    <td>'.$Nom.'</td>
    <td>'.$Prenom.'</td>
    <td>'.$Login.'</td>
    <td>'.$Pass.'</td>
    <td>'.$Role.'</td>
    <td>'.$Statu.'</td>
    <td><a href="Preview.php?url='.$Img1.'&res=ut"><button type="button" class="btn btn-outline-warning m-2">Show</button></a></td>
    <td><a href="Utilisateur.php?row='.$j+1 .'&ref='.$Ref.'"><button type="button" class=" btn btn-outline-info m-2">Update</button></a></td>
</tr>';

}
else
{
    if($_GET["row"] != NULL && $_GET["ref"] != NULL)
   {
       if($j+1 == $_GET["row"])
       {

    $Table = $Table.'
    <form  method="POST" enctype="multipart/form-data" >
    <tr class="text-white">
    <td><input class="form-check-input" type="checkbox" name="Rows[]" onclick="Checkone()" value="'.$Ref.'"></td>
    <th scope="col"><input class="form-control mb-3" type="text" name="Unom2" value="'.$Nom.'" aria-label="default input example" require></th>
    <th scope="col"><input class="form-control mb-3" type="text" name="Uprenom2" value="'.$Prenom.'" aria-label="default input example" require></th>
    <th scope="col"><input class="form-control mb-3" type="text" name="Ulogin2" value="'.$Login.'" aria-label="default input example" require></th>
    <th scope="col"><input class="form-control mb-3" type="text" name="Upass2" value="'.$Pass.'" aria-label="default input example" require></th>
    
    <th scope="col"><select class="form-select mb-3" name="Urole2" vlaue="'.Role.'" aria-label="Default select example" require>
       
        <option value="Utilisateur">Utilisateur</option>
        <option value="Client">Client</option>
        <option value="Admin">Admin</option>
    </select></th>

    <th scope="col"><select class="form-select mb-3" name="Ustatu2" value="'.Statu.'" aria-label="Default select example" require>
       
        <option value="Active">Active</option>
        <option value="Banned">Banned</option>
    </select></th>

    <th scope="col"><input class="form-control bg-dark" name="Uimg2"  type="file" id="formFileMultiple" accept="image/jpg, image/jpeg, image/png" require></th>
    
    <th><input type="submit" class="btn btn-outline-success m-2" name="Save" value="Save"></input>
    <a href="Utilisateur.php" ><button type="button" class="btn btn-outline-primary m-2">X</button></a>
    </th>
</tr>
</form>';   
       }
       else
       {
        $Table = $Table.'<tr>
        <td><input class="form-check-input" type="checkbox" name="Rows[]" onclick="Checkone()" value="'.$Ref.'"></td>
        <td>'.$Nom.'</td>
        <td>'.$Prenom.'</td>
        <td>'.$Login.'</td>
        <td>'.$Pass.'</td>
        <td>'.$Role.'</td>
        <td>'.$Statu.'</td>
        <td><a href="Preview.php?url='.$Img1.'&res=ut"><button type="button" class="btn btn-outline-warning m-2">Show</button></a></td>
        <td><button type="button" class=" btn btn-outline-info m-2">Update</button></td>
    </tr>';
       }


   }
   else
   {
    header('Location:'.'Utilisateur.php');
   }
}

    }
    
}
else
{
    $Table = '<span style="font-size:30px !important;color:red !important;">!!! Aucun Utilisateur !!!</span>';
}
}
else
{
$Utilisateur = $cn->prepare('SELECT * FROM utilisateur');
$Utilisateur -> execute();
if($Utilisateur->rowCount() != 0)
{
    $Table = "";
    for ($j=0; $j < $Utilisateur->rowCount() ; $j++) 
    {
        $lineV = $Utilisateur->fetch(PDO::FETCH_ASSOC);

        $Ref         = $lineV["Code_Ut"];
        $Nom      = $lineV["Nom_Ut"];
        $Prenom      = $lineV["Prenom_Ut"];
        $Login       = $lineV["Login_Ut"];
        $Pass   = $lineV["Password_Ut"];
        $Role       = $lineV["Role_Ut"];
        $Statu = $lineV["Statu_Ut"];
        $Img1        = "../Profile/".$lineV["Img_Ut"];


        if(!isset($_GET['row']) == true)
{
   
    $Table = $Table.'<tr>
    <td><input class="form-check-input" type="checkbox" name="Rows[]" onclick="Checkone()" value="'.$Ref.'"></td>
    <td>'.$Nom.'</td>
    <td>'.$Prenom.'</td>
    <td>'.$Login.'</td>
    <td>'.$Pass.'</td>
    <td>'.$Role.'</td>
    <td>'.$Statu.'</td>
    <td><a href="Preview.php?url='.$Img1.'&res=ut"><button type="button" class="btn btn-outline-warning m-2">Show</button></a></td>
    <td><a href="Utilisateur.php?row='.$j+1 .'&ref='.$Ref.'"><button type="button" class=" btn btn-outline-info m-2">Update</button></a></td>
</tr>';

}
else
{
    if($_GET["row"] != NULL && $_GET["ref"] != NULL)
   {
       if($j+1 == $_GET["row"])
       {

        $Table = $Table.'
        <form  method="POST" enctype="multipart/form-data" >
        <tr class="text-white">
        <td><input class="form-check-input" type="checkbox" name="Rows[]" onclick="Checkone()" value="'.$Ref.'"></td>
        <th scope="col"><input class="form-control mb-3" type="text" name="Unom2" value="'.$Nom.'" aria-label="default input example" require></th>
        <th scope="col"><input class="form-control mb-3" type="text" name="Uprenom2" value="'.$Prenom.'" aria-label="default input example" require></th>
        <th scope="col"><input class="form-control mb-3" type="text" name="Ulogin2" value="'.$Login.'" aria-label="default input example" require></th>
        <th scope="col"><input class="form-control mb-3" type="text" name="Upass2" value="'.$Pass.'" aria-label="default input example" require></th>
        
        <th scope="col"><select class="form-select mb-3" name="Urole2" value="'.$Role.'" aria-label="Default select example" require>
           
            <option value="Utilisateur">Utilisateur</option>
            <option value="Client">Client</option>
            <option value="Admin">Admin</option>
        </select></th>
    
        <th scope="col"><select class="form-select mb-3" name="Ustatu2" value="'.$Statu.'" aria-label="Default select example" require>
           
            <option value="Active">Active</option>
            <option value="Banned">Banned</option>
        </select></th>
    
        <th scope="col"><input class="form-control bg-dark" name="Uimg2"  type="file" id="formFileMultiple" accept="image/jpg, image/jpeg, image/png" require></th>
        
        <th><input type="submit" class="btn btn-outline-success m-2" name="Save" value="Save"></input>
        <a href="Utilisateur.php" ><button type="button" class="btn btn-outline-primary m-2">X</button></a>
        </th>
    </tr>
    </form>';   
       }
       else
       {
        $Table = $Table.'<tr>
        <td><input class="form-check-input" type="checkbox" name="Rows[]" onclick="Checkone()" value="'.$Ref.'"></td>
        <td>'.$Nom.'</td>
        <td>'.$Prenom.'</td>
        <td>'.$Login.'</td>
        <td>'.$Pass.'</td>
        <td>'.$Role.'</td>
        <td>'.$Statu.'</td>
        <td><a href="Preview.php?url='.$Img1.'&res=ut"><button type="button" class="btn btn-outline-warning m-2">Show</button></a></td>
        <td><button type="button" class=" btn btn-outline-info m-2">Update</button></td>
    </tr>';
       }


   }
   else
   {
    header('Location:'.'Utilisateur.php');
   }
}

    }
    
}
else
{
    $Table = '<span style="font-size:30px !important;color:red !important;">Aucun Utilisateur !!!</span>';
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard Utilisateur</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link href="styleee.css" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
/* width */
::-webkit-scrollbar {
  width: 8px;
  height : 8px;
  background:#191C24;
}

/* Track */
::-webkit-scrollbar-track {
  /* box-shadow: inset 0 0 5px white;  */
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #eb1616; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #bf0b0b; 
}
</style>
    <script>
        var j = 0;
        function Check()
        {
            var j =document.getElementById("ALL").checked;
            if(j==true)
            {
                var all = document.getElementsByName("Rows[]");
                var i = 0;
                for(i = 0;i< all.length;i++)
                {                
                    all[i].checked = true;
                }
                
            }
            else
            {
                var all = document.getElementsByName("Rows[]");
                var i = 0;
                for(i = 0;i< all.length;i++)
                {                
                    all[i].checked = false;
                }
                
            }
            
        }

        function Checkone()
        {
            
                var all = document.getElementsByName("Rows[]");
                var j = 0;
                var i = 0;
                for(i = 0;i< all.length;i++)
                {                
                    if(all[i].checked == false)
                    {
                        j=1;
                        break;
                    }
                }

                if(j==1)
                {
                    document.getElementById("ALL").checked = false;
                }
                else
                {
                    document.getElementById("ALL").checked = true;
                }
                
            
                
            
        }


        
        // function Supprimer()
        // {
        //     var all = document.getElementsByName("Rows");
        //         var i = 0;
        //         for(i = 0;i< all.length;i++)
        //         {                
        //             if(all[i].checked == true)
        //             {
        //                 // 


                            
        //                 //     $Delete1 = $cn->prepare("DELETE from voiture where Ref = ?");
        //                 //     $Delete1 -> execute(array(all[i].value));

        //                 //     $Delete2 = $cn->prepare("DELETE from voiture where Ref_P = ? and Type_P = 'voiture'");
        //                 //     $Delete3 -> execute(array(all[i].value));
                            
        //                 // 
        //             }
        //         }
        // }

    </script>


    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        th
        {
            text-align: center;
            vertical-align: middle;
        }
        td
        {
            text-align: center;
            vertical-align: middle;
        }
        tfoot tr th input
        {
            text-align: center;
            vertical-align: bottom;
        }
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.dropdown-item:hover {
    color: #EB1616 !important;
}
    </style>
</head>

<body>










    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Dashboard</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img  class="rounded-circle" src='<?php echo "../Profile/".$lineut["Img_Ut"] ?>' alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $lineut["Nom_Ut"]." ".$lineut["Prenom_Ut"]; ?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-tachometer-alt me-2"></i>Dashboards</a>
                        <div class="dropdown-menu bg-transparent border-0">
                        <a href="index.php" class="dropdown-item">Voiture</a>
                            <a href="Utilisateur.php" class="dropdown-item">Utilisateur</a>
                            <a href="Commande.php" class="dropdown-item">Commande</a>
                        </div>
                    </div>
                    <!-- <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div> -->
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" name="search" type="search" value="<?php echo $SS; ?>" placeholder="Search">
                </form>
                <a href="Utilisateur.php"><button type="button" class="btn btn-dark m-2">Clear</button></a>
                <div class="navbar-nav align-items-center ms-auto">
                    <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div> -->
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img  class="rounded-circle me-lg-2" src='<?php echo "../Profile/".$lineut["Img_Ut"] ?>' alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $lineut["Nom_Ut"]." ".$lineut["Prenom_Ut"]; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                        <a href="../index.php" class="dropdown-item">Visit Site</a>    
                        <a href="../Profile/user_page.php?res=admin" class="dropdown-item">My Profile</a>
                            
                            <a href="../Dr.Car Market/ToLogOut.php?log=true" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Commandes</p>
                                <h6 class="mb-0"><?php echo $nbr." Commande" ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0"><?php echo $Totalee." DH" ?> </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Produit</p>
                                <h6 class="mb-0"><?php echo $cont." Produit" ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Visiteur Online</p>
                                <h6 class="mb-0"><?php echo $vist." Visiteur" ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <!-- <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Worldwide Sales</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Salse & Revenue</h6>
                                <a href="">Show All</a>
                            </div>
                            <canvas id="salse-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Utilisateur DashBoard</h6>
                        
                    </div>
                    <div class="table-responsive">
                        <form  method="POST" enctype="multipart/form-data" >
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"><input class="form-check-input" type="checkbox" id="ALL" onclick="Check();"></th>
                                    <th scope="col">La Nom</th>
                                    <th scope="col">Le Prenom</th>
                                    <th scope="col">Login</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Le Role</th>
                                    <th scope="col">Statu</th>
                                    <th scope="col">Image</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $Table; ?>
                            </tbody>
                            <tfoot>
                                <tr class="text-white">
                                    <th scope="col"><input type="submit" class="btn btn-primary m-2" name="Del" value="Delete" ></input> </th>
                                    <th scope="col"><input class="form-control mb-3" type="text" name="Unom" aria-label="default input example" require></th>
                                    <th scope="col"><input class="form-control mb-3" type="text" name="Uprenom" aria-label="default input example" require></th>
                                    
                                    <th scope="col"><input class="form-control mb-3" type="text" name="Ulogin" aria-label="default input example" require></th>

                                    <th scope="col"><input class="form-control mb-3" type="text" name="Upass" aria-label="default input example" require></th>

                                    <th scope="col"><select class="form-select mb-3" name="Urole" aria-label="Default select example" require>
                                       
                                       <option value="Utilisateur">Utilisateur</option>
                                       <option value="Client">Client</option>
                                       <option value="Admin">Admin</option> 
                                   </select></th>
                                    
                                    <th scope="col"><select class="form-select mb-3" name="Ustatu" aria-label="Default select example" require>
                                        <option value="Active">Active</option>
                                        <option value="Banned">Banned</option>
                                    </select></th>

                                    <th scope="col"><input class="form-control bg-dark" name="Uimg" type="file" id="formFileMultiple" accept="image/jpg, image/jpeg, image/png" require></th>
                                    
                                    <th><input type="submit" class="btn btn-outline-success m-2" name="ADD" value="Ajouter"></input></th>
                                </tr>
                                
                            </tfoot>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Widgets Start -->
            <!-- <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Messages</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-secondary rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">To Do List</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex mb-2">
                                <input class="form-control bg-dark border-0" type="text" placeholder="Enter task">
                                <button type="button" class="btn btn-primary ms-2">Add</button>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox" checked>
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span><del>Short task goes here...</del></span>
                                        <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Widgets End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="index.php">DR-CAR</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    
    <script>
    const viewBtn = document.querySelector(".btn-outline-info"),
    popup = document.querySelector(".popup"),
    close = popup.querySelector(".close"),
    field = popup.querySelector(".field"),
    input = field.querySelector("input"),
    copy = field.querySelector("button");

    viewBtn.onclick = ()=>{
      popup.classList.toggle("show");
    }
    close.onclick = ()=>{
      viewBtn.click();
    }

    copy.onclick = ()=>{
      input.select(); //select input value
      if(document.execCommand("copy")){ //if the selected text copy
        field.classList.add("active");
        copy.innerText = "Copied";
        setTimeout(()=>{
          window.getSelection().removeAllRanges(); //remove selection from document
          field.classList.remove("active");
          copy.innerText = "Copy";
        }, 3000);
      }
    }
  </script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>