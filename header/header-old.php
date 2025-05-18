<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autofocus</title>
    <link rel="icon" type="image/x-icon" href="img/autofocus.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <audio id="bgAudio" hidden controls autoplay loop>
    <source src="someples.mp3" type="audio/mpeg">
    Browser Anda tidak mendukung tag audio.
    </audio>

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
<body class="bg-gray-900 text-white min-h-screen flex flex-col justify-between ">
    <!-- Navbar -->
    <nav class="p-4 flex justify-between items-center sticky top-0 bg-zinc-800 shadow-lg z-50 ">
        <div class="flex items-center">
            <img src="../img/autofocus.png" alt="Autofocus logo" class="h-10 w-10 mr-2">
            <span class="text-xl font-bold">AUTOFOCUS</span>
        </div>
        <div class="hidden md:flex space-x-10">
            <a href="produk.php" class="text-white hover:text-gray-300">PRODUCT</a>
            <a href="news.php" class="text-white hover:text-gray-300">NEWS</a>
            <a href="index.php#" class="text-white hover:text-gray-300">CONTACT</a>
        </div>
        <div class="hidden md:flex space-x-4 items-center">
            <div class="relative group">
                <a><button class="relative inline-block p-px font-semibold leading-6 text-white bg-neutral-900 cursor-pointer rounded-2xl transition-all duration-300 ease-in-out hover:scale-105 active:scale-95">
                    <span class="relative z-10 block px-6 py-3 rounded-2xl bg-neutral-950">
                        <div class="relative z-10 flex items-center space-x-3">
                            <span class="transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">Login</span>
                            <img src="img/arrow.png" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">    
                            </img>
                        </div>
                    </span>
                </button></a>
            </div>
            <div class="relative group">
                <a href="register.php"><button class="relative inline-block p-px font-semibold leading-6 text-white bg-neutral-900 cursor-pointer rounded-2xl transition-all duration-300 ease-in-out hover:scale-105 active:scale-95">
                    <span class="absolute inset-0 rounded-2xl bg-gradient-to-r from-emerald-500 via-cyan-500 to-sky-600 p-[2px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                    <span class="relative z-10 block px-6 py-3 rounded-2xl bg-neutral-950">
                        <div class="relative z-10 flex items-center space-x-3">
                            <span class="transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">Register</span>
                            <img src="img/add-user.png" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">
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
        <div class="md:hidden flex items-center">
            <button onclick="toggleMenu()" class="text-white focus:outline-none">
                <i class="fas fa-bars fa-2x"></i>
            </button>
        </div>
    </nav>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="mobile-menu hidden md:hidden p-4 max-h-0">
        <a href="produk.php" class="block text-white hover:text-gray-300 mb-2">PRODUCT</a>
        <a href="news.html" class="block text-white hover:text-gray-300 mb-2">NEWS</a>
        <a href="#" class="block text-white hover:text-gray-300 mb-2">CONTACT</a>
        <div class="relative group mb-2">
            <a href="login.php"><button class="relative inline-block p-px font-semibold leading-6 text-white bg-neutral-900 cursor-pointer rounded-2xl transition-all duration-300 ease-in-out hover:scale-105 active:scale-95 w-full">
                <span class="absolute inset-0 rounded-2xl bg-gradient-to-r from-emerald-500 via-cyan-500 to-sky-600 p-[2px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                <span class="relative z-10 block px-6 py-3 rounded-2xl bg-neutral-950">
                    <div class="relative z-10 flex items-center space-x-3 justify-center">
                        <span class="transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">Login</span>
                        <img src="img/arrow.png" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">    
                    </img>
                    </div>
                </span>
            </button></a>
        </div>
        <div class="relative group mb-2">
            <button class="relative inline-block p-px font-semibold leading-6 text-white bg-neutral-900 cursor-pointer rounded-2xl transition-all duration-300 ease-in-out hover:scale-105 active:scale-95 w-full">
                <span class="absolute inset-0 rounded-2xl bg-gradient-to-r from-emerald-500 via-cyan-500 to-sky-600 p-[2px] opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                <span class="relative z-10 block px-6 py-3 rounded-2xl bg-neutral-950">
                    <div class="relative z-10 flex items-center space-x-3 justify-center">
                        <span class="transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">Register</span>
                        <img src="img/add-user.png" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 transition-all duration-500 group-hover:translate-x-1.5 group-hover:text-emerald-300">
                        </img>
                    </div>
                </span>
            </button>
        </div>
        <button class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group" type="button">
            <div class="bg-green-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500">
                <img src="img/shopping-cart.png" viewBox="0 0 1024 1024" height="25px" width="25px">
                </img>
            </div>
            <p class="translate-x-2">Cart</p>
        </button>
    </div>