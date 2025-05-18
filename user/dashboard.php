<?php
require("../config/db.php");
include("../header/header-fixed-logined.php");

?>
<!-- Home -->
<div id="home" class="main-content container mx-auto mt-8 relative px-4">
    <div class="relative p-4 rounded-lg flex flex-col md:flex-row items-center md:items-start">
        <img src="../img/kamera.jpg" class="w-full ml-20 md:w-2/5 object-cover rounded-lg">
        <div class="text-white p-4 w-full md:w-1/2 text-center md:text-left">
            <h1 class="ml-10 text-4xl font-bold">Lorem ipsum dolor sit amet.</h1>
            <p class="ml-10 mt-6 text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam condimentum
                ex vitae finibus sollicitudin.</p>
            <a href="https://api.whatsapp.com/send/?phone=%2B6281226912799&text&type=phone_number&app_absent=0"><button
                    class="ml-10 mt-3 group-hover:before:duration-500 group-hover:after:duration-500 after:duration-500 hover:border-emerald-300  duration-500 before:duration-500 hover:duration-500 underline underline-offset-2 hover:after:-right-8 hover:before:right-12 hover:before:-bottom-8 hover:before:blur hover:underline hover:underline-offset-4  origin-left hover:decoration-2 hover:text-emerald-300 relative bg-neutral-800 h-16 w-64 border text-left p-3 text-gray-50 text-base font-bold rounded-lg  overflow-hidden  before:absolute before:w-12 before:h-12 before:content[''] before:right-1 before:top-1 before:z-10 before:bg-blue-400 before:rounded-full before:blur-lg  after:absolute after:z-10 after:w-20 after:h-20 after:content['']  after:bg-emerald-300 after:right-8 after:top-3 after:rounded-full after:blur-lg">
                    Get in Touch
                </button>
            </a>
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
        <div
            class="bg-white p-4 rounded-lg items-center grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-gray-900">
            <img alt="SONY logo" class="ml-7 lg:ml-20" height="100" src="../img/sony.jpg" width="100" />
            <img alt="FUJIFILM logo" class="ml-3 lg:ml-20" height="100" src="../img/fujifilm.png" width="100" />
            <img alt="Canon logo" class="ml-7 lg:ml-20" height="100" src="../img/canon.png" width="100" />
            <img alt="Nikon logo" class="ml-3 mb-3 lg:ml-20" height="100" src="../img/nikon.png" width="100" />
        </div>
    </div>
    <div>
        <h2 class="text-xl font-semibold mb-4">
            Product Category
        </h2>
        <div
            class="bg-white p-4 rounded-lg grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-gray-900">
            <div class="flex flex-col items-center">
                <img alt="Digital Camera" class="h-24 mb-2" height="100" src="../img/digitalcam.avif" width="100" />
                <span>
                    Digital Cameras
                </span>
            </div>
            <div class="flex flex-col items-center">
                <img alt="Lenses" class="h-24 mb-2" height="100" src="../img/lenses.jpg" width="100" />
                <span>
                    Lenses
                </span>
            </div>
            <div class="flex flex-col items-center">
                <img alt="Accessories" class="h-19 mt-4 mb-5" height="100" src="../img/accessories.webp" width="100" />
                <span>
                    Accessories
                </span>
            </div>
            <div class="flex flex-col items-center">
                <img alt="Video Camera" class="h-24 mb-2" height="100" src="../img/videocamera.webp" width="100" />
                <span>
                    Video Cameras
                </span>
            </div>
            <div class="flex flex-col items-center">
                <img alt="Tripods" class="h-30 mb-2" height="100" src="../img/Tripod.jpg" width="100" />
                <span>
                    Tripods
                </span>
            </div>
        </div>
    </div>
</div>
<?php
include("../footer/footer.php");
?>