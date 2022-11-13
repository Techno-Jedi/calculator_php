<?php
session_start();
require_once("classes/Database.php");
require_once("classes/DatabaseOperations.php");
$number1 = $_REQUEST['input-one'];
$number2 = $_REQUEST['input-two'];
$operation = $_REQUEST['operation'];

 if (!$operation || (!$number1 && $number1 != '0') || (!$number2 && $number2 != '0')) {
   return print_r($error_result = 'Не все поля заполнены' . "<br />");
 }
  if ($number2 == '0') {
   return print_r($error_result = 'На ноль делить нельзя'. "<br />");
}
  else {
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
            $result = $number1 / $number2;
             break;
         };
     };
$instanceOfTheCalculatorClass = new DatabaseOperations();
$instanceOfTheCalculatorClass -> saveResultBd($number1, $number2, $operation, $result);
?>