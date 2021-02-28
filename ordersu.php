<?php
    session_start();

    include "config/db_conn.php";
    //creating an instance of db_connection 
    $db = new DB_connection();

    if(isset($_GET['id'])){
        $menu_id = $_GET['id'];
    }

    //Checking if the user has a session created 
    if (isset($_SESSION["user_loggedIn"])) {

        if(isset($_SESSION['menu_id'])){
            $menu_id = $_SESSION['menu_id'];
        }
    
        $user_id = isset($_SESSION['user_id'])? $_SESSION['user_id'] : "";
    
        $restaurant_id = $_SESSION['admin_id'];
        
        //query to insert an order into the database 
        $query = "INSERT INTO orders(restaurant_id,menu_id,user_id) VALUES('$restaurant_id','$menu_id','$user_id')";
    
        //executing the query and checking if it is successful
        $result = $db->connect()->query($query);
    
        //redirecting based on the result of the execution
        if($result){
            header('Location: index.php?message=success');
        }else{
            echo mysqli_error($result);
            exit;
            header("Location: restaurant_menu.php");
        }
        
        
    }else{
        header('Location: sign-up.php?ordering=yes');
        $_SESSION['ordering'] = true;
        $_SESSION['menu_id'] = $menu_id;
    }


    

?>

