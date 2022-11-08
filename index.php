<?php
require_once("classes/Database.php");
require_once("classes/databaseOperations.php");
$number1 = $_REQUEST['input-one'];
$number2 = $_REQUEST['input-two'];
$operation = $_REQUEST['operation'];
$error_result = "";

 if (!$operation || (!$number1 && $number1 != '0') || (!$number2 && $number2 != '0')) {
   return print_r($error_result = 'Не все поля заполнены' . "<br />");
 } else {
     switch ($operation) {
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
             if ($number2 !== '0') {
                 echo $error_result = $number1 / $number2;
                 break;
             } else {
               $result = "На ноль делить нельзя!";
                 break;
         };
     }
 }

$instanceOfTheCalculatorClass = new databaseOperations();
$instanceOfTheCalculatorClass -> saveResultBd($number1, $number2, $operation, $result);
$fetchResult = $instanceOfTheCalculatorClass -> fetchResultFromBD();
print_r($result);
?>