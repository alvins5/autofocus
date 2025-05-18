    <?php
    session_start();
    include "header.php";

    ?>
<div class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg backdrop-blur-xl">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Lupa Password</h2>
        <p class="text-gray-600 text-center mb-4">Masukkan email Anda untuk mengatur ulang password.</p>

        <form method="POST" action="send_reset.php" class="space-y-4">
            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 text-gray-700" />
            <button type="submit" class="w-full py-2 text-white bg-emerald-600 rounded-lg hover:bg-purple-700 transition duration-200">
                Kirim Link Reset
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="login.php" class="text-emerald-500 hover:underline">Kembali ke Login</a>
        </div>
    </div>
</div>
    <?php
    include "footer.php";