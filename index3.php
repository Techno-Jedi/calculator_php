<?php
session_start();
echo "Опренд1:" . $_SESSION['number1'] . "<br />";
echo "Опренд2:" . $_SESSION['number2'] . "<br />";
echo "Оператор:" . $_SESSION['operation'] . "<br />";
echo "Результат:" . $_SESSION['result'];