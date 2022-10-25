<?php
 $connection_to_db = mysqli_connect("localhost:3306", "root", "", "my-calculator" );
            if(!$connection_to_db) {
            die ("Нет связи с бд: " . mysqli_connect_error());
};

if(isset($_REQUEST['submit'])){
	$number1 = $_REQUEST['input-one'];
	$number2 = $_REQUEST['input-two'];
	$operation = $_REQUEST['operation'];
	if(!$operation || (!$number1 && $number1 != '0') || (!$number2 && $number2 != '0')) {
		$error_result = 'Не все поля заполнены';
	}
    else {
		if(!is_numeric($number1) || !is_numeric($number2)){
			$error_result = "Операнды должны быть числами";
		}
		else
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
			    if( $number2 == '0')
			    	$error_result = "На ноль делить нельзя!";
			    else
			       $result = $number1 / $number2;
			    break;
		}
	}
}
    mysqli_query (
    $connection_to_db, "INSERT INTO numbers (operand_1, operator, operand_2, result)
                                         VALUES ( '" . $_REQUEST['input-one'] . "',
                                                  '" . $_REQUEST['operation'] . "',
                                                  '" . $_REQUEST['input-two'] . "',
                                                  '" . $result . "')"
                                                  );

    $query = mysqli_query($connection_to_db, "SELECT * FROM `numbers`ORDER BY id DESC LIMIT 7");
    $result = [];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculator</title>
</head>
<body>
<div class="calculator-box">
	<div>
       <h2 class="calculator-content">Калькулятор</h2>
    </div>
	<form method='POST' class="calculate-form">
		<input type="number" name="input-one" class="input-one" placeholder="0">
		<select class="operations" name="operation">
			<option value='sum'>+</option>
			<option value='subtract'>-</option>
			<option value="multiply">*</option>
			<option value="divide">/</option>
		</select>
		<input type="number" name="input-two" class="input-two" placeholder="0">

		<input class="submit_form" type="submit" name="submit" value="Результат">

		<div class="check">
            <p>Ваш результат:</p><?php

            if(!isset($error_result)) {
                    echo $error_result = '';
                }
                else {
            	   echo "<div class='error-text'>Ошибка: $error_result</div> <br />";
                }

            if(isset($result)) {
                while($row = mysqli_fetch_assoc($query)){
                    $result = $row;
                     echo "<div class='answer-text'>id: " . $result['id'] . " </div> <br />";
                     echo "<div class='answer-text'>Ответ: " . $result['result'] . " </div> <br />";
                     echo "<div class='answer-text'>Оператор: " . $result['operator'] . " </div> <br />";
                        }
                }

            ?>

        </div>

	</form>
	</div>
</body>
</html>


