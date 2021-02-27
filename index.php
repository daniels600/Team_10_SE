<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home | Foodee</title>
        <script type="text/javascript" src=""></script>
        <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <header>
            <div class="navbar">
                <div>
                    <img src="svg/Top-left design.svg" alt="design">
                </div>
              <div class="Logo">
                  <img src="svg/Foodee.svg" alt="logo" id="foodee">
                  <img src="svg/Pizza icon.svg" alt="part_logo" id="pizzaicon">
              </div>
              <ul class="main-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="log-in.html">Log In</a></li>
              </ul>  
            </div>
            
        </header>
        <section style="background: rgb(236, 236, 236); margin-bottom: 30px;">
            <div class="row"  >
                <div class="column" >
                    <img src="svg/What to choose.svg" alt="body-image" id="whattocho">
                </div>
                <div class="column">
                    <img src="svg/Text.svg" alt="long-text" id="body-text">
                    <form action = "menu.php">
                        <input type="text" id="Querysearch" name="Querysearch" placeholder="  type here...">
                    
                        <img src="svg/pointer.svg" alt="pointer" id="pointer">
                    
                        <input type="submit" class="btn-query" value="Search">
                    </form>
                </div>
                
            </div>
        </section >
        <div class="loader"><span>Most Viewed</span></div>
        <section class="view-food" > 
            <div class="grid">
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src="img/Burger.jpg" alt="Burger">
                        <div class="card-container">
                            <h1 class="card-header">Burger</h1>
                            <p class="card-text">
                                Short Description
                            </p>
                            <input type="submit" class="card-btn" value="Pick me" name = "Pick">
                        </div>
                    </div>
                </div>  
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src="img/Samosa.jpg" alt="Samosa">
                        <div class="card-container">
                            <h1 class="card-header">Samosa</h1>
                            <p class="card-text">
                                Short Description
                            </p>
                            <input type="submit" class="card-btn" value="Pick me" name = "Pick">
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src="img/Rice.jpg" alt="Rice">
                        <div class="card-container">
                            <h1 class="card-header">Rice</h1>
                            <p class="card-text">
                                Short Description
                            </p>
                            <input type="submit" class="card-btn" value="Pick me" name = "Pick">
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src="img/banku-tilapia_.webp" alt="Banku">
                        <div class="card-container">
                            <h1 class="card-header">Banku & Tilpia</h1>
                            <p class="card-text">
                                Short Description
                            </p>
                            <input type="submit" class="card-btn" value="Pick me" name = "Pick">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="view-food" >
            <div class="grid">
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src="img/Fuuf.jpg" alt="Fuufu">
                        <div class="card-container">
                            <h1 class="card-header">Fufu</h1>
                            <p class="card-text">
                                Short Description
                            </p>
                            <input type="submit" class="card-btn" value="Pick me" name = "Pick">
                        </div>
                    </div>
                </div>  
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src="img/Jollof.jpg" alt="Jollof">
                        <div class="card-container">
                            <h1 class="card-header">Jollof</h1>
                            <p class="card-text">
                                Short Description
                            </p>
                            <input type="submit" class="card-btn" value="Pick me" name = "Pick">
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src="img/Waak.jpg" alt="Waakye">
                        <div class="card-container">
                            <h1 class="card-header">Waakye</h1>
                            <p class="card-text">
                                Short Description
                            </p>
                            <input type="submit" class="card-btn" value="Pick me" name = "Pick">
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="card">
                        <img class="card-img" src="img/Kebab.jpg" alt=" Kebab">
                        <div class="card-container">
                            <h1 class="card-header">Kebab</h1>
                            <p class="card-text">
                                Short Description
                            </p>
                            <input type="submit" class="card-btn" value="Pick me" name = "Pick">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>