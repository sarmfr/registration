<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System with Image Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mb-8">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Register</h2>
        <form action="register.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar</label>
                <input type="file" name="avatar" id="avatar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Register</button>
        </form>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p class='mt-4 text-sm text-center " . (strpos($_SESSION['message'], 'successful') !== false ? "text-green-600" : "text-red-600") . "'>{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        ?>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Registered Users</h2>
        <?php
        include 'db_connect.php';
        $result = $conn->query("SELECT id, username, email FROM users");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='flex items-center justify-between space-x-4 mb-4'>
                    <div class='flex items-center space-x-4'>
                        <img src='get_avatar.php?id={$row['id']}' alt='Avatar' class='w-12 h-12 rounded-full object-cover'>
                        <div>
                            <p class='font-medium text-gray-800'>{$row['username']}</p>
                            <p class='text-sm text-gray-500'>{$row['email']}</p>
                        </div>
                    </div>
                    <div class='flex space-x-2'>
                        <a href='edit_user.php?id={$row['id']}' class='px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200'>Edit</a>
                        <a href='delete_user.php?id={$row['id']}' class='px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                    </div>
                  </div>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>