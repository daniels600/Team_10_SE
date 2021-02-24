<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="team_10";
    
    if(!($conn = new mysqli($servername, $username, $password, $dbname))){
        alert("Connection has failed.");
    } 
    $sql = "SELECT menu.menu_id,menu.meal_name, menu.meal_price,restaurants.restaurant_name, menu.meal_image 
    FROM menu,restaurants WHERE menu.restaurant_id = restaurants.restaurant_id";
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
                    <th>Picture</th>
                </tr>
                <?php
                    
                    while($row = $query->fetch_assoc()){
                        echo "<tr>
                        <td>".$row['meal_name']."</td>
                        <td>".$row['meal_price']."</td>
                        <td>".$row['restaurant_name']."</td>
                        <td>Image</td>
                        <td><button type='submit' name ='order' value =".$row['menu_id'].">Order</button></td>
                        </tr>";
                    }
                ?>
            </table>
        <form>
    </body>
</html>
