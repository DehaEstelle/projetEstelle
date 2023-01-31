<?php @session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>App Planning</title>

    <link rel="stylesheet" href="/css/style.css">

</head>
<body>

    <div class="nav-container">

        <div class="nav-bar">

            <div class="nav-burger">
                <span class="material-icons">menu</span>
            </div>

            <div class="nav-logo">
                <h1><a href="/Retrieve/index">GesAgenda</a></h1>
            </div>

            <div class="nav-links">
                <ul>
                    <li><a href="/Retrieve/index">Consultation de Planning</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </div> 
            
            <div class="nav-status">
                <!-- <div class="material-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" width="3rem" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div> -->

                <div class="dropdown">
                    <p>
                        <svg onclick="dropdownFunction()" class="dropbtn" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" width="3rem" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>
                            <?php
                            if (isset($_SESSION["user_id"])) {
                                echo $_SESSION['lastname']; 
                            }else {
                                echo '';
                            }
                            ?>
                        </span>
                    </p>

                    <div id="myDropdown" class="dropdown-content">
                        <?php if (isset($_SESSION["user_id"])) : ?>
                        <a href="/Retrieve/home">Déconnexion</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

    </div>
  
   <!-- Calandrier -->

   <div class="container-fluid">
            <nav class="navbar navbar-dark bg-primary mt-3">
                <!-- <a href="#" class="navbar-brand ml-3 text-lg" >Mon Calendrier</a> -->
            </nav> 

    <script src="/js/connexion.js"></script>
</body>