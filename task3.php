<?php


$array=explode(' ',$argv['1']);
asort($array);
$rule="/^-?\d*\.{0,1}\d+$/";
foreach($array as $ar){
    
    if(preg_match($rule, $ar)){
       
        echo  $ar." ";
     
     }
};


?>
