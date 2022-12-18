<?php
session_start();
if(isset($_REQUEST['submit'])){
    $_SESSION["number1"] = $_REQUEST["input-one"];
    $_SESSION["number2"] = $_REQUEST["input-two"];
    $_SESSION["operation"] = $_REQUEST["operation"];
    $number1 = $_SESSION['number1'];
    $number2 = $_SESSION['number2'];
    $operation = $_SESSION['operation'];

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
	<form method='post' class="calculate-form">
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
            if(!empty($result)){
              $_SESSION['result'] = $result;
              $exp = $_SESSION['result'];
            }
            if(isset($exp)) {
                    echo "<div class='answer-text'>Опренд1: $number1 </div>";
                	echo "<div class='answer-text'>Опренд2: $number2 </div>";
                	echo "<div class='answer-text'>Опрератор:  $operation </div>";
                	echo "<div class='answer-text'>Результат: $exp </div>";
                }
            if(isset($error_result)) {
                   echo "<div class='error-text'>Ошибка: $error_result</div>";
                }
            ?>
        </div>
	</form>
	</div>
</body>
</html>
