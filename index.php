<?php
 $connection_to_db = mysqli_connect("localhost:3306", "root", "", "my-calculator" );
            if(!$connection_to_db) {
            die ("Нет связи с бд: " . mysqli_connect_error());
};
    $result = [];
    $number1 = $_REQUEST['input-one'];
	$number2 = $_REQUEST['input-two'];
	$operation = $_REQUEST['operation'];
    $error_result = "";
    if(!$operation || (!$number1 && $number1 != '0') || (!$number2 && $number2 != '0')){
        echo  $error_result  = 'Не все поля заполнены' . "<br />";
            }
    else{
             switch($operation){
            			case 'sum':
            			    $result = $number1 + $number2;
            			    break;
            			case 'subtract':
            			    $result = $number1 - $number2;
            			    break;
            			case 'multiply':
            			    $result = $number1 * $number2;
            			    break;
            			case 'divide':
            			    if( $number2 !== '0'){
            			    $result = $number1 / $number2;
            			      break;
            			    }
            			    else{
            			     print_r($error_result = "На ноль делить нельзя!");
            			    break;
            			};
            }
      }
    mysqli_query ( $connection_to_db, "INSERT INTO numbers (operand_1, operator, operand_2, result)
                                                          VALUES ( '" . $_REQUEST['input-one'] . "',
                                                                   '" . $_REQUEST['operation'] . "',
                                                                   '" . $_REQUEST['input-two'] . "',
                                                                   '" . $result . "')"
                                                                   );
    $query = mysqli_query($connection_to_db, "SELECT * FROM `numbers`ORDER BY id DESC LIMIT 7");
    if($query){
    while($result = mysqli_fetch_assoc($query)){
     echo $result["result"] . "<br />";
     }
  }
?>