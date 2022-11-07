<?php
session_start();
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = date("H:i:s");
}
echo $_SESSION['time'];
$temp_file = tempnam(sys_get_temp_dir(), 'Tux');

echo $temp_file;
?>