<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autofocus</title>
    <link rel="icon" type="image/x-icon" href="img/autofocus.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<script>
    // document.addEventListener("DOMContentLoaded", function() {
    //     const floating = document.getElementById('floating');
    //     const fixed = document.getElementById('fixed');
    //     if (floating && fixed) {
    //         window.addEventListener("scroll", function() {
    //             if (window.scrollY > 80) {
    //                 floating.classList.add('opacity-100');
    //                 floating.classList.remove('opacity-0');
    //                 fixed.classList.add('-translate-y-full');
    //             } else {
    //                 floating.classList.add('opacity-0');
    //                 floating.classList.remove('opacity-100')
    //                 fixed.classList.remove('-translate-y-full');
    //             }
    //         });
    //     }
    // });
</script>

<body class="min-h-screen font-[poppins]">
    <div id="fixed" class="sticky top-0 z-[100] top-0">
        <div class=" top-0 bg-zinc-800 z-[10] flex items-center justify-between py-4 px-[13.5rem] top-0" href="home.php">
            <nav class="flex items-center justify-between w-full">
                <a class="flex items-center" href="/">
                    <img src="../img/autofocus.png" alt="Logo" class="h-10 w-10 mr-1">
                    <h1 class="text-xl  font-[poppins] font-bold">AUTOFOCUS</h1>
                </a>
                <div class="flex justify-between items-center gap-4">
                    <div>
                        <p><?php
                            echo $_SESSION['username'];
                            ?></p>
                    </div>
                    <div>
                        <a href="/auth/logout.php" class="flex justify-items-center mt-[0.33rem] button w-[2rem] h-[2rem] border-stone-50 border-2 rounded-lg px-auto pl-[0.1rem] pt-[0.1rem]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
                                <path d="m16 17 5-5-5-5" />
                                <path d="M21 12H9" />
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="px-4 bg-green-500">
            <nav class="flex items-center justify-between w-full h-[3.2rem] px-[12.5rem]">
                <div class="flex items-center gap-10 font-[poppins] font-small">
                    <a href="/product">
                        PRODUCT
                    </a>
                    <a href="/news">
                        NEWS
                        </ah>
                        <a href="/#contact">
                            CONTACT
                        </a>
                </div>
                <a href="../user/cart.php"
                    class="flex item-center justify-center p-[0.6rem] button w-[5rem] h-[2.5rem] bg-teal-700 rounded-xl gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                        <circle cx="8" cy="21" r="1" />
                        <circle cx="19" cy="21" r="1" />
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                    </svg>
                    <h1 class="font-[poppins] font-small">
                        CART
                    </h1>
                </a>
                <a href="../user/order_history.php"
                    class="flex item-center justify-center p-[0.6rem] button w-[5rem] h-[2.5rem] bg-teal-700 rounded-xl gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-history-icon lucide-history"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M12 7v5l4 2"/></svg>
                    <h1 class="font-[poppins] font-small">
                        history
                    </h1>
                </a>
            </nav>
        </div>
    </div>
</body>