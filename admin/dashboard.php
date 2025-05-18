<?php
session_start();
require '../admin/access_admin.php';
require '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../auth/login.php');
    exit;
}

include __DIR__ . '/../header/header-fixed-logined.php';
?>

    <div id="home" class="main-content container mx-auto mt-8 relative px-4">
        <div class="relative p-4 rounded-lg flex flex-col md:flex-row items-center md:items-start">
            <img src="../img/kamera.jpg" class="w-full ml-20 md:w-2/5 object-cover rounded-lg">
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
                <img alt="SONY logo" class="ml-7 lg:ml-20" height="100" src="../img/sony.jpg" width="100"/>
                <img alt="FUJIFILM logo" class="ml-3 lg:ml-20" height="100" src="../img/fujifilm.png" width="100"/>
                <img alt="Canon logo" class="ml-7 lg:ml-20" height="100" src="../img/canon.png" width="100"/>
                <img alt="Nikon logo" class="ml-3 mb-3 lg:ml-20" height="100" src="../img/nikon.png" width="100"/>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-semibold mb-4">
                Product Category
            </h2>
            <div class="bg-white p-4 rounded-lg grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-gray-900">
                <div class="flex flex-col items-center">
                    <img alt="Digital Camera" class="h-24 mb-2" height="100" src="../img/digitalcam.avif" width="100"/>
                    <span>
                        Digital Cameras
                    </span>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Lenses" class="h-24 mb-2" height="100" src="../img/lenses.jpg" width="100"/>
                    <span>
                        Lenses
                    </span>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Accessories" class="h-19 mt-4 mb-5" height="100" src="../img/accessories.webp" width="100"/>
                    <span>
                        Accessories
                    </span>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Video Camera" class="h-24 mb-2" height="100" src="../img/videocamera.webp" width="100"/>
                    <span>
                        Video Cameras
                    </span>
                </div>
                <div class="flex flex-col items-center">
                    <img alt="Tripods" class="h-30 mb-2" height="100" src="../img/Tripod.jpg" width="100"/>
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
                    <img src="../img/autofocus.png" alt="Autofocus logo" class="w-12 h-12"/>
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

