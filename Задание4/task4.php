<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Задание 4</title>
</head>
<body>

<form action="#" method="post">

    <input type="text" name="name" value="<?= $_POST['name'] ?>">

    <input type="submit">

</form>


<?php

    $value=trim($_POST['name']);
    $value=strip_tags($value);
    
    
    if($_POST['name']){
    
        include 'simple_html_dom.php';

        $html = file_get_html( 'https://terrikon.com/football/italy/championship/archive ' ); 


        foreach ($html-> find ('#container .content-site .maincol .tab .news a') as $element) 
            $array_a[$element->plaintext]=$element-> href ;

        foreach($array_a as $key=>$array){
    
            $html = file_get_html( 'https://terrikon.com'.$array);
            foreach ($html-> find ('#container .content-site .maincol .tab ".colored big" td ')  as $element) 
                $z[]=$element-> plaintext;
  
            if(array_search($value,$z)){
           
                echo "<b>Сезон:</b> ".$key.". <b>Место:</b> ".$z[array_search($value,$z)-1]."<br><br>";
    
             }
            $z=null; 
           
         }




       }

?>


</body>
</html>