<?php

include "config/db_conn.php";
//creating an instance of db_connection 
$db = new DB_connection();


if(isset($_GET['id'])){
    $order_id = $_GET['id'];
    $sql = "DELETE FROM orders WHERE order_id = '$order_id'";

    $deleteMeal = $db->connect()->query($sql);

    if($deleteMeal){
        header('Location: restaurant_orders.php?message=success');
    }

}