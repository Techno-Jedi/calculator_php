<?php
session_start();
require_once("classes/Database.php");
require_once("classes/DatabaseOperations.php");
$instanceOfTheCalculatorClass = new DatabaseOperations();
$fetchResult = $instanceOfTheCalculatorClass -> fetchResultFromBD();
echo $_SESSION["result"] = $fetchResult;
