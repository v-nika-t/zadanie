<?php

    $color=[
    
        'red','blue','green','yellow','lime','magenta','black','gold','gray','tomato'

     ];


     $g=0;
     $lengarray=count($color);

?>



<table>
    <tr>

<?php for ($i=0; $i<25; $i++){

    $key=array_rand($color);
    while($key == $g){
        
        $key=array_rand($color);
        
     } 

if($i%5 == 0){ ?>
   
    </tr>
    <tr>
    
<?php } ?>
        
    <td style="color:<?=$color[$key] ?>"><?= $color[$g] ?></td> 
 
<?php 
   
    if($g ==($lengarray-1)){
        
        $g=0;
        
     } else {
         
        $g++;
     }
  
  
   
         } ?>
   </tr>
</table>