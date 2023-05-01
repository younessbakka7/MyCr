import React from 'react';
import { Link } from 'react-router-dom';
import '../pages/accsesoir.css';
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



  <div class="grid-container">
  <div>
    <img className='img1' src="batri1.png" alt="" />
    <h1 className='cahd'>BMW X4</h1>
    <p className='cahd'>10.000 DH</p>
   <button className='btn-shop'>Shop</button>
  </div>
  
  <div>
    <img className='img1' src="btri2.png" alt="" />
    <h1 className='cahd'>BMW X4</h1>
    <p className='cahd'>10.000 DH</p>
    <button className='btn-shop'>Shop</button>
  </div>
  
  <div>
    <img className='img1' src="bm1.png" alt="" />
    <h1 className='cahd'>BMW f4</h1>
    <p className='cahd'>16.000 DH</p>
    <button className='btn-shop'>Shop</button>
  </div>
  <div>
    <img className='img1' src="michelin.png" alt="" />
    <h1 className='cahd'>BMW </h1>
    <p className='cahd'>5000DH</p>
    <button className='btn-shop'>Shop</button>
  </div>
  <div>
    <img className='img1' src="mz2.png" alt="" />
    <h1 className='cahd'>BMW X</h1>
    <p className='cahd'>9000 DH</p>
    <button className='btn-shop'>Shop</button>
  </div>
  <div>
    <img className='img1' src="mzd1.png" alt="" />
    <h1 className='cahd'>BMW X10</h1>
    <p className='cahd'>1500 DH</p>
    <button className='btn-shop'>Shop</button>
  </div>
  <div>
    <img className='img1' src="michelin.png" alt="" />
    <h1 className='cahd'>BMW </h1>
    <p className='cahd'>1500 DH</p>
    <button className='btn-shop'>Shop</button>
  </div>
  <div>
     <img className='img1' src="bm1.png" alt="" />
    <h1 className='cahd'>BMW f4</h1>
    <p className='cahd'>1500 DH</p>
    <button className='btn-shop'>Shop</button>
  
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
