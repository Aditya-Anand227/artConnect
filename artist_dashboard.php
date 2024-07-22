<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: Artist_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <title>Artist Dashboard</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
        <p class="text-center text-gray-600 mt-4">This is your artist dashboard.</p>
    </div>
</body>
</html>
