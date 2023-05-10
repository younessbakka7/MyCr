<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <!-- custom css file link  -->
        <link rel="stylesheet" href="css/style.css">
    <title>CONTACT US</title>
    <style>
        input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
/* .footer .share a
{
    height: 15rem;
    width: 15rem;
    line-height: 15rem;
    font-size: 12rem;
    color:#fff;
    border:var(--border);
    margin:.3rem;
    border-radius: 50%; 
        
} */
/* .share
{
    display: flex;
    justify-content: space-between;
} */

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

    <section class="contact" id="contact">

        <h1 class="heading"> <span>contact</span> us </h1>
        <section class="bgg footer">
        <div class="share">
            <a href="index.php" class="fab las la-home"> </a>
        </div>
    </section>
    
        <div class="row">
    
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12918.390471804685!2d-8.008125598439328!3d31.633214293387244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdafee8d931f3209%3A0x96ce34d39325c762!2z2KzZhNmK2LLYjCDZhdix2KfZg9i0IDQwMDAw!5e0!3m2!1sar!2sma!4v1649081599708!5m2!1sar!2sma" allowfullscreen="" loading="lazy"></iframe>
    
            <form action="">
                <h3>get in touch</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="name">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" placeholder="email">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" placeholder="number">
                </div>
                <input type="submit" value="contact now" class="btn">
            </form>
    
        </div>
    
    </section>

<script src="js/script.js"></script>
</body>
</html>