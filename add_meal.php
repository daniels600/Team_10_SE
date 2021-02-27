<?php
include "config/db_conn.php";
//creating an instance of db_connection 
$db = new DB_connection();

if(isset($_GET['error'])){
    $err_message = "Invalid Data Provided";
}


if(isset($_POST['submit'])){

     //Getting all the post or submitted input values
     $mealName =$db->connect()->real_escape_string($_POST['mealName']);
     $mealPrice = $db->connect()->real_escape_string($_POST['mealPrice']);
     $image_name = $_FILES['image']['name'];
     $image_type = $_FILES['image']['type']; // getting the type to check if it is an image
     $dst = "meal_images/". $image_name;
     $restaurant_id = 1;

     // checking file upload if it is an image
     if (!empty($_FILES['image']['tmp_name']) && file_exists($_FILES['image']['tmp_name'])) {
        $data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $allowed = array("image/jpeg", "image/gif", "image/png", "image/jpg");

        if (!in_array($image_type, $allowed)) {
            //$error_message = 'Only jpg, gif, and png files are allowed.';
            header("Location: add_meal.php?error=wrongImage");
            exit();
        } else {
            move_uploaded_file($_FILES['image']['tmp_name'], $dst);
        }
    }

    $sql = "INSERT INTO `menu`(`restaurant_id`, `meal_name`, `meal_price`, `meal_image`) 
    VALUES (?,?,?,?)";
    $stmt = $db->connect()->prepare($sql);
    $stmt->bind_param('dsss', $restaurant_id,$mealName,$mealPrice,$dst);

    //checking the execution of the query statement
    if ($stmt->execute()) {
        header("Location: add_meal.php?message=success");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Meal</title>
    <link rel="icon" href="../../assets/images/imageedit_28_3939584200.png" type="image/png">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="../../assets/css/parsley.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Meal Details</h3>
                                </div>
                                <?php
                                //Showing a message if any and redirect to the Dashboard after 1.5 secs
                                if (isset($err_message)) {
                                    echo '<div class="alert alert-danger">' .
                                    '<li style="text-align:center">'.$err_message.'</li>'
                                    . '</div>';
                                }

                                ?>
                                <div class="card-body">
                                    <!-- Using parsley js to validate the form inputs -->
                                    <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST' enctype="multipart/form-data" data-parsley-validate>
                                        <div class="form-group">
                                            <label class="small mb-1">Meal name</label>
                                            <input class="form-control py-4"  type="text" placeholder="Enter meal name" data-parsley-required="true"  data-parsley-trigger="keyup" data-parsley-pattern="^[a-zA-Z ]+$"name='mealName' />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="nationality">Meal Price</label>
                                            <input class="form-control py-4"  type="number" placeholder="Enter meal price" data-parsley-required="true"  data-parsley-trigger="keyup" data-parsley-pattern="^[0-9]+$"name='mealPrice'/>
                                        </div>
                                     
                                        <div class="form-group">
                                            <p><input type="file" accept="image/*" name="image" id="file" onchange="loadFile(event)" style="display: none;"></p>
                                            <p><label class="btn btn-primary"for="file" style="cursor: pointer;">Upload Meal Image</label></p>
                                            <p><img id="output" width="200" name="image"/></p>
                                           
                                        </div>
                                        <?php if(isset($_GET['error'])){if($_GET['error'] == 'wrongImage') {echo "Upload a *jpeg  *gif *png *jpg";}}?>
                                        <br />
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" required>Save Meal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Team 10 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
     <!-- Getting the message from the insertion of prisoner record and creating a flash message -->
    <?php if(isset($_GET['message'])) : ?>
        <div class='flash-data' data-flashdata="<? $_GET['message'];?>"></div>
    <?php endif; ?>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    // Using sweetalert to show an alert
    const flashdata = $('.flash-data').data('flashdata');

        if(flashdata) {
            Swal.fire({
                icon: 'success',
                title: 'Meal added successfully',
                allowOutsideClick: true,                  
                type: "success" 
            }).then(function () {
                window.location.href = 'restaurant_menu.php';
            });
        }

        //Preview the inserted image 
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
</body>

</html>