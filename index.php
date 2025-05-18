<?php
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        include 'home.php';
        break;
    case '/login':
        include 'auth/login.php';
        break;
    case '/register':
        include 'auth/register.php';
        break;
    case '/product':
        include 'produk/produk2.php';
        break;
    case '/forgot_password':
        include 'auth/forgot_password.php';
        break;
    default:
        http_response_code(404);
        include '404.php';
        break;
}