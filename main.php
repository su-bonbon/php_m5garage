<?php
    session_start();
    $fname = $_SESSION['fname'];
    $employeeID = $_SESSION['employeeID'];
?>

<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M5 Garage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>






    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Logo on the left -->
            <a class="navbar-brand" href="main.php">
                <img src="img/logo.png" class="img-fluid logo-image" alt="Logo" style="max-width: 200px; height: auto;">
            </a>
    
            <!-- Navbar toggler button for responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <!-- Navbar after log-in links aligned to the right -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link"  href="inventory.php">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="createcar.html">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="payment.php">Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="home.html">Sign Out</a>
                    </li>
                </ul>
            </div>
            <a class="navbar-brand" href="<?php echo 'edituser.php?employeeID=' . $_SESSION['employeeID']; ?>">
                <i class="fa-solid fa-user-pen img-fluid logo-image usericon"></i>
            </a>
        </div>
    </nav>
    
    <div>


    </div>
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="2000">
            <img src="img/car32.jpg" class="d-block w-100 h-100" alt="...">
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="img/car31.jpg" class="d-block w-100 h-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/car33.jpg" class="d-block w-100 h-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
        <div class="carousel-caption d-flex justify-content-center align-items-center vh-100">
            <div class="text-center">
                <p class="fw-semibold" style="font-size: 10em;">Welcome, <?php echo $fname; ?></p>
                <p class="fs-3">We are M5 Garage</p>
            </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>