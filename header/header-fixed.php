<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autofocus</title>
    <link rel="icon" type="image/x-icon" href="../img/autofocus.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <audio id="bgAudio" hidden controls autoplay loop>
    <source src="someples.mp3" type="audio/mpeg">
    Browser Anda tidak mendukung tag audio.
    </audio>
</head>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const floating = document.getElementById('floating');
    const fixed = document.getElementById('fixed');
    if (floating && fixed) {
        window.addEventListener("scroll", function() {
            if (window.scrollY > 80) {
                floating.classList.add('opacity-100');
                floating.classList.remove('opacity-0');
                // floating.classList.add('block');
                fixed.classList.add('-translate-y-full');
            } else {
                // floating.classList.remove('block');
                floating.classList.add('opacity-0');
                floating.classList.remove('opacity-100')
                fixed.classList.remove('-translate-y-full');
            }
        });
    }
});
</script>
<body class="min-h-screen max-w-screen">
    <div id="fixed" class="transition-all duration-[100ms] z-[10] ease-in-out fixed w-screen">
        <div class=" top-0 bg-zinc-800 shadow-lg flex items-center justify-between p-4 px-[10rem]">
            <nav class="flex items-center justify-between w-full">
                <a href="/" class="flex items-center">
                    <img src="../img/autofocus.png" alt="Logo" class="h-10 w-10 mr-1">
                    <h1 class="text-xl  font-[poppins] font-bold">AUTOFOCUS</h1>
                </a>
                <div class="flex gap-4">
                    <div>
                        <button class="p-[0.5rem]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </button>
                    </div>
                    <div>
                        <a href="/login" class="flex item-center justify-center p-[0.4rem] button w-[5rem] h-[2.5rem] border-stone-50 border-2 rounded-lg gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-in-icon lucide-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>
                            <h1 class="font-[poppins] font-medium">
                                LOGIN
                            </h1>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="px-4 bg-green-500 px-[10rem]">
            <nav class="flex items-center justify-between w-full h-[3.2rem]">
                <div class="flex items-center gap-20 font-[poppins] font-small">
                    <h1 action="/product">
                        PRODUCT
                    </h1>
                    <h1>
                        NEWS
                    </h1>
                    <h1 href="index.php#contact">
                        CONTACT
                    </h1>
                </div>
                <button class="flex item-center justify-center p-[0.6rem] button w-[5rem] h-[2.5rem] bg-teal-700 rounded-xl gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>                
                <h1 class="font-[poppins] font-small">
                    CART
                </h1>
                </button>
            </nav>
        </div>
    </div>