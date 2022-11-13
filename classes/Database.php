<?php
class Database{
    private static $connection_to_db;
    public static function connect() {
    if(empty(self::$connection_to_db)){
    self::$connection_to_db = mysqli_connect("localhost:3306", "root", "", "my-calculator");
    }
     }
    public static function query($sqlStr) {
        return mysqli_query(self::$connection_to_db, $sqlStr);
    }
    public static function fetch($query) {
        return mysqli_fetch_assoc($query);
    }
};
?>
