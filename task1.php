<?php

class First{
    
    protected $classname='First';
    protected $Letter='A';
    
    function getClassName(){
        
        echo $this->classname;
        
     }
    
     function getLetter(){
        
         echo $this->Letter;
        
     }
  
    
            }
            
class Second extends First{
    
    function  __construct(){
      
        $this->classname='Second';
        $this->Letter='B';   
       
     }
    
}



?>