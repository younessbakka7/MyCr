import React from 'react';
import  './home.css';

const Login = () => {
  return (
    <>
    <h1>HELLO IN MyCr</h1>
    <p><span>MyCr</span> with a goal to help reduce workplace accidents by providing high-quality products backed by expert advice and guidance.</p>
      <h2>inscrite vous pour suivre notre service</h2>

      <form className='form' action='' method='POST'>
      <label for="">First Name</label><br /><br />
      <input type="text" name="nom" placeholder="Nom" required/><br /><br />
      <label for="">Last Namee</label><br /><br />
      <input type="text" name="prenom" placeholder="Prenom" required/><br /><br />
      <label for="">Email</label><br /><br />
      <input type="text" name="Email" placeholder="Email" required/><br /><br />
      
      <button className="btn" name="sub">
        valide
      </button>
    </form><br /><br /><br />


    <footer className="footer">
      <p>MyCr</p>
      <p>younessbakka7@gmail.com</p>
  
    </footer>
    </>

      
      
    
  );
}

export default Login;
