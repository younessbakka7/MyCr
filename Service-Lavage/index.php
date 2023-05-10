<?php 


try {
    $cn = new PDO("mysql:host=localhost;dbname=dr_car;port=3306;charset=utf8", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    echo 'Erreur de connexion: ' . $e->getMessage();
}



session_start();
$CodeUt = $_SESSION["ID_UT"];
if (array_key_exists('Reserver', $_POST))
    {
        if(isset($_POST["Date"]) && isset($_POST["hours"]))
        {
            if(!empty($_POST["Date"]) && !empty($_POST["hours"]))
            {
                
                $RDV = $cn->prepare("SELECT * FROM rdv WHERE Date_R_RV = ? AND Hour = ? AND Type_RV = 'Lavage'");
                $RDV -> execute(array($_POST["Date"],$_POST["hours"]));
                if($RDV->rowCount() == 0)
                {
                    $Date = date("Y-m-d");
                    $DES = $_POST["FULLNAME"]." - ".$_POST["NUMBER"]." - ".$_POST["OFFER"];
                    $UTTable = $cn -> prepare("INSERT INTO rdv VALUES(NULL,?,'Lavage',?,?,?,?,'Demander')");
                    $UTTable->execute(array($CodeUt,$Date,$_POST["Date"],$_POST["hours"],$DES));
                    $UTTable->closeCursor();
                    
                    echo "<script>alert('Bien Reserver !!!');</script>";
                }
                else
                {
                    echo "<script>alert('Date Non Desponible');</script>";
                }
            }
        }
        
    }


?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lavage</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="main.css">
        <!-- <script>
            var y = new Date().getFullYear();
            var m = new Date().getMonth();
            var d = new Date().getDate();
            var Date = y+"-"+m+"-"+d;
            document.getElementById("D")..setAttribute("min", Date);
        </script> -->
        <style>
            .form-row input[type="text"],input[type="number"] ,select
            {
                color:black;
                font-weight: bold;
            }
            input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
        </style>
    </head>
    <body>
        
        <section class = "banner">
            <h2>BOOK YOUR TURN NOW</h2>
            <div class = "card-container">
                <div class = "card-img">
                    <!-- image here -->
                </div>

                <div class = "card-content">
                    <h3>Reservation</h3>
                    <form method="POST">
                        <div class = "form-row">
                        <input type="date" name="Date" id="D" >    
                            <select name = "hours">
                                <option value = "hour-select">Select Hour</option>
                                <option value = "10">10: 00</option>
                                <option value = "11">11: 00</option>
                                <option value = "12">12: 00</option>
                                <option value = "13">13: 00</option>
                                <option value = "14">14: 00</option>
                                <option value = "15">15: 00</option>
                                <option value = "16">16: 00</option>
                                <option value = "17">17: 00</option>
                                <option value = "18">18: 00</option>
                                <option value = "19">19: 00</option>
                                <option value = "20">20: 00</option>
                                <option value = "21">21: 00</option>
                                <option value = "22">22: 00</option>
                            </select>
                        </div>

                        <div class = "form-row">
                            <input  type = "text" name="FULLNAME" placeholder="Full Name">
                            <input type = "number" name="NUMBER" placeholder="Phone Number">
                        </div>

                        <div class = "form-row">
                        <select name="OFFER">
                                <option value = "hour-select">Select Offer</option>
                                <option value = "FULL" id="HOV">FULL WASH</option>
                                <option value = "STANDAR">STANDAR WASH</option>
                                <option value = "BASIC">BASIC WASH</option>
                            </select>
                            <input type = "submit" name="Reserver" value = "Reserver">
                            <a href="../Our Services.php" style="text-decoration:none;"><button style="color: #fff;background: #f2745f;padding: 12px 0;border-radius: 4px;cursor: pointer;height:47px;width:80px;border:none;margin-top:14px !important;"  type = "button" >Go Back</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        
    </body>
</html>