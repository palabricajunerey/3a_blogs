<?php 
if(!isset($pwedeMabisita)){
    header("location: index.php");
}
// if(!defined('ENABLED_PAGE')){
//     header("location: index.php");
// }
try{
    $host  = "localhost";
    $dbname = "3a_blog";
    $user = "root";
    $password = "";

    $conn = new PDO ("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    // if($conn == true){
    //     echo "Database is connected";
    // }
}catch(PDOException $e){
    echo $e->getMessage();
}
?>