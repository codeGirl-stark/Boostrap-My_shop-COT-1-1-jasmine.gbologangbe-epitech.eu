<?php

    session_start();
    
    const ERROR_LOG_FILE ="../error.log";

    require("../Users.php");

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirmation'];

        $create = new Users($email, $password, $password_confirm,$name);
        $create->register();
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="../src/output.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <title>Register</title>
    </head>
    <body class="flex justify-center items-center bg-sky-200">
        <form action="" method="POST" class="shadow-2xl mt-[8%] bg-pink-50 rounded-lg p-10 w-[30%]">
            <h3 class="text-4xl text-center font-semibold text-blue-700">Sign Up</h3>
            <?php if(!empty($successMessage)) echo $successMessage;?>
            <div class="my-5 flex flex-col">
                <label for="name" class="mb-2">Your Name*</label>
                <input type="text" name="name" id="name" placeholder ="Name" required class="border border-gray-50 p-3 shadow-lg rounded-2xl"/>
                <?php if(!empty($errorName)) echo $errorName;?>
            </div>
            <div class="my-5 flex flex-col">
                <label for="email" class="mb-2">Your email*</label>
                <input type="email" name="email" id="email" placeholder="Email" required class=" border border-gray-50 p-3 shadow-lg rounded-2xl"/>
                <?php if(!empty($errorEmail)) echo $errorEmail;?>
            </div>
            <div class="my-5 flex flex-col">
                <label for="password" class="mb-2">Enter password*</label>
                <input type="password" name="password" id="" placeholder="password" required class="border border-gray-50 p-3 shadow-lg rounded-2xl"/>
                <?php if(!empty($errorPassword)) echo $errorPassword;?>
            </div>

            <div class="my-5 flex flex-col">
                <label for="password_confirmation" class="mb-2">Confirm password*</label>
                <input type="password" name="password_confirmation" placeholder="password_confirmation" id="password_confirmation" class="border border-gray-50 p-3 shadow-lg rounded-2xl"/>
            </div>
            <input type="submit" value="Register" name="submit" class="mt-2 border-2 w-[100%] bg-blue-500 font-semibold text-lg text-white p-2 rounded-lg"/>
        </form>
    </body>
</html>