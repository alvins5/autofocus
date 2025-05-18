<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autofocus</title>
    <link rel="icon" type="image/x-icon" href="img/autofocus.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        
        *{
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        
        body {
            background: linear-gradient(rgba(30, 30, 30, 0.795), rgba(30, 30, 30, 0.795)), 
                       url('img/camera-bg.jpg') no-repeat center center/cover;  
            color: white;
            scroll-behavior: smooth;
        }

        .hover-button {
            overflow-x: hidden;
            position: relative;
            width: 8rem;
            padding: 0.5rem;
            height: 3rem;
            background-color: black;
            color: white;
            border: none;
            border-radius: 0.375rem;
            font-size: 1.25rem;
            font-weight: bold;
            cursor: pointer;
            z-index: 10;
        }
        .hover-button span {
            position: absolute;
            width: 9rem;
            height: 8rem;
            top: -2rem;
            left: -0.5rem;
            transform: rotate(12deg) scaleX(0);
            transition: transform 1s;
            transform-origin: left;
        }
        .hover-button:hover span {
            transform: rotate(12deg) scaleX(1);
        }
        .hover-button span:nth-child(2) {
            background-color: white;
            transition-duration: 0.5s;
        }
        .hover-button span:nth-child(3) {
            background-color: #9f7aea;
            transition-duration: 0.7s;
        }
        .hover-button span:nth-child(4) {
            background-color: #6b46c1;
            transition-duration: 1s;
        }
        .hover-button span:nth-child(5) {
            top: 0.625rem;
            left: 1.5rem;
            z-index: 10;
            opacity: 0;
            transition: opacity 1s;
        }
        .hover-button:hover span:nth-child(5) {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .flex-col-reverse {
                flex-direction: column-reverse;
            }
            .text-center {
                text-align: center;
            }
            .w-full {
                width: 100%;
            }
            .h-auto {
                height: auto;
            }
            .hidden {
                display: none;
            }
            .block {
                display: block;
            }


            .main-content img{
                margin-left: -10px;
            }

            .main-content h1{
                margin-left: -10px;
            }
            
            .main-content p{
                margin-left: -10px;
            }

            .main-content button{
                margin-left: -10px;
            }

        }
        .mobile-menu {
            transition: max-height 0.3s ease-in-out;
            overflow: hidden;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function toggleMenu() {
            const menu = document.getElementById('mobile-menu');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                menu.style.maxHeight = menu.scrollHeight + "px";
            } else {
                menu.style.maxHeight = null;
                menu.addEventListener('transitionend', () => {
                    menu.classList.add('hidden');
                }, { once: true });
            }
        }
    </script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex flex-col justify-between">
    <!-- Navbar -->
    <nav class="p-4 flex justify-between items-center">
        <div class="flex items-center">
            <img src="img/autofocus.png" alt="Autofocus logo" class="h-10 w-10 mr-2">
            <span class="text-xl font-bold">AUTOFOCUS</span>
        </div>
        <div class="hidden md:flex space-x-10">
            <a href="produk2.html" class="text-white hover:text-gray-300">PRODUCT</a>
            <a href="news2.html" class="text-white hover:text-gray-300">NEWS</a>
            <a href="#" class="text-white hover:text-gray-300">CONTACT</a>
        </div>
        <div class="hidden md:flex items-center space-x-2">
    <a href="logout.php">
        <button class="relative inline-block p-px font-semibold leading-6 text-white bg-neutral-900 cursor-pointer rounded-2xl transition-all duration-300 ease-in-out hover:scale-105 active:scale-95">
            <span class="absolute inset-0 rounded-2xl bg-gradient-to-r from-emerald-500 via-cyan-500 to-sky-600 p-[2px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
            <span class="relative z-10 block px-6 py-3 rounded-2xl bg-neutral-950">
                <div class="relative z-10 flex items-center space-x-3">
                    <span class="transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">Logout</span>
                    <img src="img/add-user.png" class="w-7 h-7 transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">
                </div>
            </span>
        </button>
    </a>
    <button class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group" type="button">
        <div class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500">
            <img src="img/shopping-cart.png" height="25px" width="25px">
        </div>
        <p class="translate-x-2">Cart</p>
    </button>
</div>
        <div class="md:hidden flex items-center">
            <button onclick="toggleMenu()" class="text-white focus:outline-none">
                <i class="fas fa-bars fa-2x"></i>
            </button>
        </div>
    </nav>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu hidden md:hidden p-4 max-h-0">
        <a href="produk2.html" class="block text-white hover:text-gray-300 mb-2">PRODUCT</a>
        <a href="news2.html" class="block text-white hover:text-gray-300 mb-2">NEWS</a>
        <a href="#" class="block text-white hover:text-gray-300 mb-2">CONTACT</a>
        <div class="relative group mb-2">
            <a href="login.php"><button class="relative inline-block p-px font-semibold leading-6 text-white bg-neutral-900 cursor-pointer rounded-2xl transition-all duration-300 ease-in-out hover:scale-105 active:scale-95 w-full">
                <span class="absolute inset-0 rounded-2xl bg-gradient-to-r from-emerald-500 via-cyan-500 to-sky-600 p-[2px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                <span class="relative z-10 block px-6 py-3 rounded-2xl bg-neutral-950">
                    <div class="relative z-10 flex items-center space-x-3 justify-center">
                        <span class="transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">Logout</span>
                        <img src="img/arrow.png" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">    
                    </img>
                    </div>
                </span>
            </button></a>
        </div>
        <button class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group" type="button">
            <div class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500">
                <img src="img/shopping-cart.png" viewBox="0 0 1024 1024" height="25px" width="25px">
                </img>
            </div>
            <p class="translate-x-2">Cart</p>
        </button>
    </div>
    <!-- Search Bar -->
 <div class="main-content">
    <div class="container mx-auto mt-4 px-4 flex justify-center">
        <div class="relative">
            <input placeholder="Search..." class="input shadow-lg bg-stone-900 focus:border-2 border-gray-300 px-5 py-3 rounded-xl w-56 transition-all focus:w-64 outline-none" name="search" type="search" />
        </div>
    </div>
    <!-- Home -->
    <div id="home" class="main-content container mx-auto mt-8 relative px-4">
        <div class="relative p-4 rounded-lg flex flex-col md:flex-row items-center md:items-start">
            <img src="img/kamera.jpg" class="w-full ml-20 md:w-2/5 object-cover rounded-lg">
            <div class="text-white p-4 w-full md:w-1/2 text-center md:text-left">
                <h1 class="ml-10 text-4xl font-bold">Lorem ipsum dolor sit amet.</h1>
                <p class="ml-10 mt-6 text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam condimentum ex vitae finibus sollicitudin.</p>
                <a href="https://api.whatsapp.com/send/?phone=%2B6281226912799&text&type=phone_number&app_absent=0"><button class="ml-10 mt-3 group-hover:before:duration-500 group-hover:after:duration-500 after:duration-500 hover:border-emerald-300  duration-500 before:duration-500 hover:duration-500 underline underline-offset-2 hover:after:-right-8 hover:before:right-12 hover:before:-bottom-8 hover:before:blur hover:underline hover:underline-offset-4  origin-left hover:decoration-2 hover:text-emerald-300 relative bg-neutral-800 h-16 w-64 border text-left p-3 text-gray-50 text-base font-bold rounded-lg  overflow-hidden  before:absolute before:w-12 before:h-12 before:content[''] before:right-1 before:top-1 before:z-10 before:bg-blue-400 before:rounded-full before:blur-lg  after:absolute after:z-10 after:w-20 after:h-20 after:content['']  after:bg-emerald-300 after:right-8 after:top-3 after:rounded-full after:blur-lg">
                  Get in Touch
                </button></a>
                  
                  
            </div>
        </div>
    </div>
</div>
    <!-- Product -->
    <div id="product" class="container mx-auto p-4">
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">
                Most Popular Brand
            </h2>
            <div class="bg-white p-4 rounded-lg items-center grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-gray-900">
                <img alt="SONY logo" class="ml-7 lg:ml-20" height="100" src="img/sony.jpg" width="100"/>
                <img alt="FUJIFILM logo" class="ml-3 lg:ml-20" height="100" src="img/fujifilm.png" width="100"/>
                <img alt="Canon logo" class="ml-7 lg:ml-20" height="100" src="img/canon.png" width="100"/>
                <img alt="Nikon logo" class="ml-3 mb-3 lg:ml-20" height="100" src="img/nikon.png" width="100"/>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-semibold mb-4">
                Product Category
            </h2>
            <div class="bg-white p-4 rounded-lg grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-gray-900">
                <div class="flex flex-col items-center">
                    <img alt="Digital Camera" class="h-24 mb-2" height="100" src="img/digitalcam.avif" width="100"/>
                    <span>
                        Digital Cameras
                    </span>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Lenses" class="h-24 mb-2" height="100" src="img/lenses.jpg" width="100"/>
                    <span>
                        Lenses
                    </span>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Accessories" class="h-19 mt-4 mb-5" height="100" src="img/accessories.webp" width="100"/>
                    <span>
                        Accessories
                    </span>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Video Camera" class="h-24 mb-2" height="100" src="img/videocamera.webp" width="100"/>
                    <span>
                        Video Cameras
                    </span>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Tripods" class="h-30 mb-2" height="100" src="img/Tripod.jpg" width="100"/>
                    <span>
                        Tripods
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- About -->
    <div id="about" class="container mx-auto p-4 mt-10">
        <div class="flex flex-col md:flex-row justify-between items-start">
            <div class="flex flex-col items-start space-y-4 md:w-1/2">
                <div class="flex items-center space-x-4">
                    <img src="img/autofocus.png" alt="Autofocus logo" class="w-12 h-12"/>
                    <h2 class="text-3xl font-bold">AUTOFOCUS</h2>
                </div>
                <div>
                    <h2 class="text-xl font-semibold">About AutoFocus</h2>
                    <p class="mt-2 text-sm md:text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam massa velit, scelerisque eget justo in, viverra convallis tortor. Aliquam ut lacus a ex suscipit faucibus. Nulla scelerisque laoreet luctus.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold">We are also on:</h3>
                    <div class="flex space-x-4 mt-2">
                        <a href="#" class="text-3xl"><i class="fab fa-instagram text-pink-500"></i></a>
                        <a href="#" class="text-3xl"><i class="fab fa-youtube text-red-600"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 md:mt-0 md:w-1/2 md:pl-8">
                <h2 class="text-xl font-semibold">Head Office</h2>
                <p class="mt-2 text-sm md:text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam massa velit, scelerisque eget justo in, viverra convallis tortor. Aliquam ut lacus a ex suscipit faucibus. Nulla scelerisque laoreet luctus.</p>
                <div class="mt-4"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1175.2814731311917!2d110.39251422144746!3d-7.772862160425379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a583a61290129%3A0x668d51a34b3a7ee8!2sSMK%20Negeri%202%20Depok%20-%20Sleman!5e0!3m2!1sid!2sid!4v1741142724042!5m2!1sid!2sid" width="330" height="125" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            </div>
        </div>
    </div>
    <footer class="bg-emerald-500 text-center py-4">
        <p>Copyright © 2025 Autofocus</p>
    </footer>
