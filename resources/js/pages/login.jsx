import React from 'react';
import { Link } from 'react-router-dom';
import '../pages/home.css';
const Login = () => {
  return (
    <div>
  <div> 
  <form>
  <input type="text" placeholder="Search..."/>
  <button type="submit">Search</button>
</form>
  <ul>
  <li ><a href="#home">Home</a></li>
  <li><a href="#news">Voiture</a></li>
  <li><a href="#Accesoire">Accesoire</a></li>
  <li><a href="#admin">Admin</a></li>
  <li className='tfo' ><a href="logout"  >logout</a></li>
  </ul>
  <div className='container'>
  <img  src="ome-img.jpeg"  width="100%" height="100%" />
  <h1 class="h1">MyCr</h1>
  <div class="topleft">Decidedly Sporty Design, Accentuated By The Wheels As Standard. The Rear Has A Gritty Appearance Thanks To The Silver Skid Plate That Ensures Greater Safety In Off-Road Conditions.</div>
  <a href='#' className='more'>autre service</a>
  </div>
  </div> 

  <div className='aboutus'>
    <h1 className='us'>About Us</h1>
    <img className='img' src="about.jpeg" alt="" />
    <div className='text'>
    <h3>What Makes Our Services Special?</h3>
    <p>No Key Transfer With Our Technicians.
Leave Your Car Unlocked Or Request For Your Technician To Contact You.</p><br /><br />

    </div>
    

  </div >
  <div className='row' >
    <h1 className='POPULAR'>POPULAR BRANDS</h1>
  <div className='bobila'>
  <img src="ALpha.png" alt="" width="100%"/>
  </div>
  <div className='bobila'>
  <img src="mercedes.png" alt="" width="100%" />
  </div>
  <div className='bobila'>
  <img src="Suz.png" alt="" width="100%"  />
  </div>

  <div className='bobila'>
  <img src="BMW.png" alt="" width="100%"  />
  </div>
  <div className='bobila'>
  <img src="Wolswagen.png" alt="" width="100%"  />
  </div>
  <div className='bobila'>
  <img src="SKODAA.png" alt="" width="100%"  />
  </div>





  
  
  </div>
    

  <div class="grid-container">
  <div>
    <img src="BMW8.png" alt="" />
    <h1 className='cahd'>BMW X4</h1>
    <p className='cahd'>10.000 DH</p>
  </div>
  <div>
    <img src="BMW8.png" alt="" />
    <h1 className='cahd'>BMW X4</h1>
    <p className='cahd'>10.000 DH</p>
  </div>
  <div>
    <img src="BMW8.png" alt="" />
    <h1 className='cahd'>BMW X4</h1>
    <p className='cahd'>10.000 DH</p>
  </div>
  <div>
    <img src="BMW8.png" alt="" />
    <h1 className='cahd'>BMW X4</h1>
    <p className='cahd'>10.000 DH</p>
  </div>



  </div>  

  <footer className="footer">
      <p>MyCr</p>
      <p>younessbakka7@gmail.com</p>
    <div class="credit">created by <span>youness benbakka</span> | all rights reserved</div>
    </footer>




  </div>
















  );
}

export default Login;
