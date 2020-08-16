<?php

$dengi=100;

CONST TYPE_DB="mysql";
CONST DB_USER='root';
CONST DB_PASS="";
CONST DB_NAME_BASE='zadanie5';
CONST DB_HOST='localhost';
CONST DB_PORT=3307;


try {
    
    $db=new PDO(TYPE_DB . ':host=' . DB_HOST . ';port='.DB_PORT.';dbname='.DB_NAME_BASE, DB_USER, DB_PASS);
 
    
// Задание a

    $result= $db->query('select * from `persons`');   


    while($qw=$result->fetch()){
    
     
        $array[$qw['id']]=['fullname'=>$qw["fullname"],'balance'=>100];
     
    
     }

     $result= $db->query('select * from `transactions`');


     while($row= $result->fetch() )	{
    
         $id_from=$row['from_person_id'];
         $id_to=$row['to_person_id'];
         $result_balance= $array[$id_from]['balance']-$row['amount'];
 
         if($result_balance >= 0){
         
             $array[$id_from]['balance']=$result_balance;
             $array[$id_to]['balance']=$row['amount'] + $array[$id_to]['balance'];
        
         
         } else {
         
             echo "Транзакция №". $row['transaction_id']."невозможна. У клиента ".$array[$row['from_person_id']]['fullname']." недостаточно средств";
         
         }
    
    
       };
     
    
       foreach($array as $x){
    
           echo "Баланс ".$x['fullname']." составляет: ".$x['balance'];
           echo " <br><br>";
    
       }

    
//Задание b

    $result_from= $db->query('select COUNT(*) as `count`, `transactions`.`from_person_id` as `id`,`table2`.`name` as `city` from `transactions`  
	                         inner join (select `persons`.`id`,`cities`.`name` from `persons` 
                             inner join `cities` on `persons`.`city_id`=`cities`.`id`) as `table2`
                             on `transactions`.`from_person_id`=`table2`.`id`
                             GROUP BY `from_person_id`  ;');

    $result_to= $db->query('select COUNT(*) as `count`, `transactions`.`to_person_id` as `id`,`table2`.`name` as `city` from `transactions`  
	                       inner join (select `persons`.`id`,`cities`.`name` from `persons` 
                           inner join `cities` on `persons`.`city_id`=`cities`.`id`) as `table2`
                           on `transactions`.`to_person_id`=`table2`.`id`
                          GROUP BY `to_person_id`  ;');

    $x=[];
    for($i=0; $row=$result_from->fetch(); $i++){

        $x[$row[1]]['value']=$row[0];
        $x[$row[1]]['city']=$row[2];

    };


    for($i=0; $row2=$result_to->fetch(); $i++){

        if($x[$row2[1]]){
             
            $x[$row2[1]]['value']+=$row2[0];
           
        } else {
             
              $x[$row2[1]]['value']=$row2[0];
              $x[$row2[1]]['city']=$row2[2]; 
        }

     };  

  
     $r=array_keys($x, max($x));
    
     foreach($r as $k){
    
         echo '<b>'.$x[$k]['city'].'</b>';
         echo "-это  город, представителя который участвовали в передаче денег наибольшее количество раз<br><br>";
    
      }

//Задание в
    
    $result_B= $db->query('select `transactions` .`transaction_id` as `id`, `table1`.`name_from` as `city` from `transactions`  
	                   inner join (select `cities`.`name` as `name_from`,`persons`.`id` as `id_to` from `persons` 
                       inner join `cities` on `persons`.`city_id`=`cities`.`id`) as `table1`
                       on `transactions`.`from_person_id`=`table1`.`id_to`
                       inner join (select `cities`.`name` as `name_to`,`persons`.`id` as `id_from` from `persons` 
                       inner join `cities` on `persons`.`city_id`=`cities`.`id`) as `table2`
                       on `transactions`.`to_person_id`=`table2`.`id_from`
                       where `table1`.`name_from`=`table2`.`name_to`  ;');    
   
    while($b=$result_B->fetch()){
    
        echo "<b>".$b['id']."</b>-это номер транзакция, где передача денег осуществлялась между представителями одного города, а именно <b>".$b['city']."</b>";
     
    }    
    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();

}







?>