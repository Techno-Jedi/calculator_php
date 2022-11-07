<?php
require_once("classes/Database.php");
require_once("classes/CalculatorAndDb.php");
$number1 = $_REQUEST['input-one'];
$number2 = $_REQUEST['input-two'];
$operation = $_REQUEST['operation'];
 function errorResult($operation, $number1, $number2){
 if (!$operation || (!$number1 && $number1 != '0') || (!$number2 && $number2 != '0')) {
    $result = 'Не все поля заполнены' . "<br />";
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
                 $result = $number1 / $number2;
                 break;
             } else {
               $result = "На ноль делить нельзя!";
                 break;
         };
     }
 }
        return $result;
    }
$res = errorResult($operation, $number1, $number2);
$instanceOfTheCalculatorClass = new CalculatorAndDb();
$instanceOfTheCalculatorClass -> saveResultBd($number1, $number2, $operation, $res);
$fetchResult = $instanceOfTheCalculatorClass -> fetchResultFromBD();
print_r($res);
?>