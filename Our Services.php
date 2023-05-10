<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        
        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style.css">
    <title>Our Services</title>
    <style>
        .Rad
        {
            border: 5px solid red;
            border-radius: 5%;
            background-color: rgb(21 59 123);
            box-shadow      : 0 0 60px 5px rgba(0, 0, 0, 0.2);
            cursor : pointer;
        }
        .Imgtest
        {
            /* border: 1px solid black; */
            width: 120px;
            height: 170px;
            /* border-radius: 50%; */
        }

        .footer .brand a
{
    height: 15rem;
    width: 15rem;
    line-height: 15rem;
    font-size: 12rem;
    color:#fff;
    border:var(--border);
    margin:.3rem;
    border-radius: 50%; 
    
}
.profile-container {
    
    background-color: #fff;
    width           : 350px;
    padding         : 100px 50px 40px;
    border-radius   : 12px;
    box-shadow      : 0 0 60px 5px rgba(0, 0, 0, 0.2);
}
/* .brand
{
    display: flex;
    justify-content: space-between;
    background-color: transparent;
} */

.imgbr
{
    height: 2rem;
    width: 2rem;
    line-height: 2rem;
    font-size: 3rem;
    margin:.2rem;
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
    <!-- menu section starts  -->

<section class="menu" id="menu">

    <h1 class="heading"> our <span>Services</span> </h1>

    <section class="bgg footer">
        <div class="share">
            <a href="index.php" class="fab las la-home"> </a>
        </div>
    </section>


    <div class="box-container">

        <div class="Rad box">
            <img class="Imgtest" src="images/sale.png" alt="">
            <br />
            <h3 style="text-transform: uppercase; font-size: 34px;padding-top: 30px;">car sale</h3>
            <br />
            <a href="Dr.Car Market/Market.php" class="BTNR btn">Get Service</a>
        </div>

        <div class="Rad box">
            <img class="Imgtest" src="images/partts.png" alt="">
            <br />
            <h3 style="text-transform: uppercase; font-size: 34px;padding-top: 30px;">parts sale</h3>
            <br />
            <a href="Dr.Car Market/Market.php" class="BTNR btn">Get Service</a>
        </div>

        <div class="Rad box">
            <img class="Imgtest" src="images/111.png" alt="">
            <br />
            <h3 style="text-transform: uppercase; font-size: 34px;padding-top: 30px;">Wash Service</h3>
            <br />
            <a href="Service-Lavage/index.php" class="BTNR btn">Get Service</a>
        </div>

        <div class="Rad box">
            <img class="Imgtest" src="images/12.png" alt="">
            <br />
            <h3 style="text-transform: uppercase; font-size: 34px;padding-top: 30px;">technical visit Service</h3>
            <br />
            <a href="Service-Technical-Visit/index.php" class="BTNR btn">Get Service</a>
        </div>

        <div class="Rad box">
            <img class="Imgtest" src="images/LL.jpg" alt="">
            <br />
            <h3 style="text-transform: uppercase; font-size: 34px;padding-top: 30px;">car repair Service</h3>
            <br />
            <a href="Service-Repair/index.php" class="BTNR btn">Get Service</a>
        </div>

        <div class="Rad box">
            <img class="Imgtest" src="images/assur.png" alt="">
            <br />
            <h3 style="text-transform: uppercase; font-size: 34px;padding-top: 30px;">assurance Service</h3>
            <br />
            <a href="Assurence.php" class="BTNR btn">Get Service</a>
        </div>

    </div>

</section>

<!-- menu section ends -->
<script src="js/script.js"></script>
</body>
</html>