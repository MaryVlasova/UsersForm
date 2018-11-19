<?php 

if ( basename($_SERVER['SCRIPT_FILENAME']) == 'config.php' )
  die ('Please do not load this page directly. Thanks!');

try {
    $db = new PDO("mysql:host=localhost;dbname=db_users", "root", ""); 
    $db-> exec("SET NAMES UTF8");
} catch (PDOException $e){
    print "Error!: Нет подключения к базе данных. Пожалуйста, обратитесь к специалистам " . "<br/>";
    die();
}