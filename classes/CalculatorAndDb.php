<?php
require_once("classes/Database.php");
class CalculatorAndDb {
public function __construct() {
Database::connect();
}
    public function saveResultBd($number1, $number2, $operation, $result) {

            Database::query("INSERT INTO numbers (operand_1, operator, operand_2, result)
                             VALUES ( '" . $_REQUEST['input-one'] . "',
                                      '" . $_REQUEST['operation'] . "',
                                      '" . $_REQUEST['input-two'] . "',
                                      '" . $result . "')");
    }
    public function fetchResultFromBD() {

        $query = Database::query("SELECT * FROM `numbers`ORDER BY id DESC LIMIT 7");
        $result = [];
        while ($result =Database::fetch($query)) {
          $result;
        }
    }
};
?>
