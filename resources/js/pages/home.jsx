

import React from 'react';
import{useState} from 'react';




export default function home() {

const [nom, setNom]=useState("")
const [email, setEmail]=useState("")




  
  return (
    <>
    
<div className='tool'>


  <h1 className='log'>Login</h1>
  <form className='form' action='#' method='POST'>
    <label >Nom</label><br />


    <input value={nom}  type="text" placeholder='Nom' name='nom' onChange={setNom((e) => {
      e.target.value()
    })} required/><br />

    
    <label  >Email</label><br />
    <input type="Email" name='email' placeholder='Email' value={email}  onChange={setEmail((e) => {
      e.target.value()
    })} required/><br />
  <button>sub</button>
  
  </form>
  </div>

      
    </>
  )
}