<?php
require_once 'include.inc.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth; 
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="logo">
            <img src="sofiz.webp" alt="Logo">
        </a>
        <ul class="menu">
            <li style="--i: 0"><a href="#home">Home</a></li>
            <li style="--i: 1"><a href="#about">About</a></li>
            <li style="--i: 2"><a href="#services">Services</a></li>
            <li style="--i: 3"><a href="#portfolio">Portfolio</a></li>
            <li style="--i: 4"><a href="#contact">Contact</a></li>
        </ul>
        <button class="btn">Reach out</button>
    </nav>

    <section id="home" class="home">
        <div class="home-txt">
            <h1>
                Welcome to <span>My Portfolio</span>
            </h1>
            <p>this is my jorney for the new start.</p>
            <button class="btn">Explore More</button>
        </div>
        <div class="home-img">
            <img src="mine.jpeg" alt="My Picture">
        </div>
    </section>

    <main>
        <section id="about" class="dynamic-section">
            <h2>About</h2>
            <?php $controler->displaySection('About'); ?>
        </section>

        <section id="services" class="dynamic-section">
            <h2>Services</h2>
            <?php $controler->displaySection('Services'); ?>
        </section>

        <section id="portfolio" class="dynamic-section">
            <h2>Portfolio</h2>
            <?php $controler->displaySection('Portfolio'); ?>
        </section>

        <section id="contact" class="dynamic-section">
            <h2>Contact</h2>
            <?php $controler->displaySection('Contact'); ?>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2025  Portfolio. All rights reserved.</p>
    </footer>
</body>
</html>
