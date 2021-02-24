<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="team_10";
    
    if(!($conn = new mysqli($servername, $username, $password, $dbname))){
        alert("Connection has failed.");
    } 
    if(isset($_GET["delete"])){
        $delete= $_GET["delete"];
        $sql = "DELETE from orders where order_id = $delete";
        $conn->query($sql);
    }
    $sql = "SELECT orders.order_id, menu.meal_name,menu.meal_price,restaurants.restaurant_name, 
    orders.created_at FROM `orders`, `menu` LEFT JOIN restaurants on 
    restaurants.restaurant_id = menu.restaurant_id WHERE menu.menu_id = orders.menu_id 
    and orders.user_id = ".$_SESSION["User"][1];
    $query = $conn->query($sql);

    

?>
<html>
    <body>
        <form>
            <table>
                <tr>
                    <th>Meal Name</th>
                    <th>Meal Price</th>
                    <th>Restaurant Name</th>
                    <th>Created At</th>
                </tr>
                <?php
                    
                    while($row = $query->fetch_assoc()){
                        echo "<tr>
                        <td>".$row['meal_name']."</td>
                        <td>".$row['meal_price']."</td>
                        <td>".$row['restaurant_name']."</td>
                        <td>".$row['created_at']."</td>
                        <td><button type='submit' name ='delete' value =".$row['order_id'].">Delete</button></td>
                        </tr>";
                    }
                ?>
            </table>
        <form>
    </body>
</html>
