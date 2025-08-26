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
        <div class="shadow-2xl bg-transparent rounded-lg p-10 w-[30%]">
            <section class="text-center">
                <h5 class="text-4xl font-semibold text-orange-400 my-2">Welcome <?php echo $name; ?></h5>
            </section>
        </div>
    </body>
</html>