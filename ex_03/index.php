<?php

    session_start();

    global $name;
    $name = $_SESSION["name"];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="../src/output.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <title>Home</title>
    </head>
    <body class="flex justify-center items-center bg-[url('../welcome.jpg')] bg-cover bg-center bg-no-repeat h-screen">
        <div class="shadow-2xl bg-transparent rounded-lg p-20 w-[30%]">
            <section class="relative">
                <h5 class="text-3xl font-semibold mb-2 text-orange-400">Welcome <?php echo $name; ?></h5>
                <button class="bg-red-400 py-2 px-5 rounded-lg shadow-lg text-white absolute -right-5 -bottom-10 cursor-pointer"><a href="logout.php">Logout</a></button>
            </section>
        </div>
    </body>
</html>