<?php
require_once("classes/Database.php");
require_once("classes/Calculator.php");
$number1 = $_REQUEST['input-one'];
$number2 = $_REQUEST['input-two'];
$operation = $_REQUEST['operation'];
$error_result = "";

if (!$operation || (!$number1 && $number1 != '0') || (!$number2 && $number2 != '0')) {
    echo $error_result = 'Не все поля заполнены' . "<br />";
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
                print_r($error_result = "На ноль делить нельзя!");
                break;
            };
    }
}

// $res = new CalculatorOperation();

$instanceOfTheCalculatorClass = new Calculator();
// if (!$connection_to_db) {
//     die("Нет связи с бд: " . mysqli_connect_error());
// }

$instanceOfTheCalculatorClass -> saveResultBd($number1, $number2, $operation, $result);
$fetchResult = $instanceOfTheCalculatorClass -> fetchResultFromBD();
print_r($result);

// class CalculatorOperation {
    
//     function errorResult($operation, $number1, $number2, $error_result){
//         if($operation == "sum"){
//             $result = $number1 + $number2;
//         }
//         // if($operation == "subtract"){
//         //     $result = $number1 - $number2;
//         // }
//         // if($operation == "multiply"){
//         //     $result = $number1 * $number2;
//         // }
//         // if ($number2 !== '0') {
//         //     $result = $number1 / $number2;
    
//         // } else {
//         //     print_r($error_result = "На ноль делить нельзя!");
        
//         // }
//         return $result;
//     }
// }
class Database{
    private $connection_to_db;
    public function __construct(){
         $this->connection_to_db = mysqli_connect("localhost:3306", "root", "", "my-calculator");
     }
    protected function query($sqlStr){
        return mysqli_query($this->connection_to_db, $sqlStr);
    }
    protected function fetch($query) {
        return mysqli_fetch_assoc($query);
    }
};
class Calculator extends Database{
    public function saveResultBd($number1, $number2, $operation, $result) {
        mysqli_query(
            $this->connection_to_db, "INSERT INTO numbers (operand_1, operator, operand_2, result)
    VALUES ( '" . $_REQUEST['input-one'] . "',
             '" . $_REQUEST['operation'] . "',
             '" . $_REQUEST['input-two'] . "',
             '" . $result . "')"
        );
    }
    public function fetchResultFromBD() {
        $query = $this->query("SELECT * FROM `numbers`ORDER BY id DESC LIMIT 7");
        $result = [];
        while ($result = $this->fetch($query)) {
            return  $result;
        }
        return $result;
    }
};
?>