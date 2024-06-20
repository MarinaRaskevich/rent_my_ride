<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Marmelad&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/dashboard/style.css">
    <title>Dashboard</title>
</head>

<body>

    <div class="container">
        <div class="top">
            <div class="brand">
                <img class="logo" src="/public/assets/img/car.png" alt="logo">
                <p class="brandName">Rent My Ride</p>
            </div>
            <div class="access">
                <img class="access_avatar" src="/public/assets/img/default-avatar.png" alt="">
                <div class="access_data">
                    <p><span>Username</span></p>
                    <p>Admin</p>
                </div>
            </div>
        </div>
        <div class="container_navbar">
            <div class="navbar">
                <div class="navbar_home">
                    <img src="/public/assets/img/home.png" alt="">
                    <a href="/controllers/dashboard/home-ctrl.php">Home</a>
                </div>
                <div>
                    <img src="/public/assets/img/icon1.png" alt="">
                    <a href="/controllers/dashboard/categories/list-ctrl.php">Gestion des catégories</a>
                </div>
                <div>
                    <img src="/public/assets/img/car.png" alt="">
                    <a href="/controllers/dashboard/vehicles/list-ctrl.php">Gestion des véhicules</a>
                </div>
                <div>
                    <img src="/public/assets/img/Calendar_Days.png" alt="">
                    <a href="">Réservations</a>
                </div>
                <div>
                    <img src="/public/assets/img/user.png" alt="">
                    <a href="">Clients</a>
                </div>
            </div>
        </div>
        <div class="content">