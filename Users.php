<?php

    session_start();

    require_once("Database.php");

    class Users{
        private $name;
        private $email;
        private $password;
        private $password_confirm;


        public function __construct($email, $password, $password_confirm="",$name=""){
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->password_confirm = $password_confirm;

        }

        public function register(){

            $error = false;
            $treatment = true;
            global $errorEmail;
            global $errorName;
            global $errorPassword;
            global $successMessage;

            if($this->name == NULL && $this->email == NULL && $this->password == NULL && $this->password_confirm ==NULL){
                $treatment = false;
                //exit(84);
            }
            if(empty($this->name) && empty($this->email) && empty($this->password) && empty($this->password_confirm)){
                $treatment = false;
                //exit(84);
            }

            if(strlen($this->name)<3 || strlen($this->name)>10){
                $errorName = "<p class='text-red-500'>Invalid Name</p>";
                $treatment = false;
                //exit(84);
            } else {
                $errorName = "";
                $this->name = trim(strip_tags($this->name));
                $this->name = stripcslashes($this->name);
                $name = preg_replace(" ","",$name);
            }
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $errorEmail = "<p class='text-red-500'>Invalid Email</p>";
                $treatment = false;
                //exit(84);
            } else {
                $errorEmail = "";
                $this->email=trim(strip_tags($this->email));
            }
            if(strlen($this->password)<3 || strlen($this->password)>10){
                $errorPassword = "<p class='text-red-500'>Invalid Password or Password Verification</p>";
                $treatment = false;
            }elseif($this->password !== $this->password_confirm){
                $errorPassword = "<p class='text-red-500'>Invalid Password or Password Verification</p>";
                $treatment = false;
                //exit(84);
            } else {
                $errorPassword = "";
                $this->password = password_hash($this->password,PASSWORD_DEFAULT);
            }

            //Si tout ok alors connecter à la base de données
            if($treatment){
                $connect = new Database("boostrap");
                $db = $connect->connect_db();
                if($db != null ){
                    try {
                        //Vérifier si l'email existe déjà dans la base 
                        $recup = $db->prepare("SELECT * FROM users WHERE email = ?");
                        $recup->execute([$this->email]);

                        if($recup->rowCount() == 0){
                            $created_at = date("Y-m-d");
                            //CREATE NEW USER IN DATABASE `$val
                            $create = $db->prepare("INSERT INTO users (name, email, password,created_at) VALUES (?,?,?,?)");
                            $create->execute([$this->name,$this->email,$this->password, $created_at]);
                            $successMessage = "<p class='text-green-700'>User created</p>";
                            //exit(0);
                        }
                    } catch (PDOException $excep) {
                        $errorMessage = "PDO ERROR:  {$excep->getMessage()} in {$excep->getFile()} line {$excep->getLine()} \n";

                        file_put_contents(ERROR_LOG_FILE, $errorMessage, FILE_APPEND);
                        //echo "PDO ERROR: {$excep->getMessage()} storage in ". ERROR_LOG_FILE ."\n";
                        //exit(84);
                    }
                }
            }
        }

        public function login($location){
            $error = false;
            $treatment = true;
            global $errorEmail;
            global $errorPassword;

            if($this->email == NULL && $this->password == NULL){
                $treatment = false;
                //exit(84);
            }
            if(empty($this->email) && empty($this->password)){
                $treatment = false;
                //exit(84);
            }

            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $errorEmail = "<p class='text-red-500'>Invalid Email</p>";
                $treatment = false;
                //exit(84);
            } else {
                $errorEmail = "";
                $this->email=trim(strip_tags($this->email));
            }

            if(strlen($this->password)<3 || strlen($this->password)>10){
                $errorPassword = "<p class='text-red-500'>Invalid Password or Password Verification</p>";
                $treatment = false;
            }else {
                $errorPassword = "";
                $this->password = strip_tags($this->password);
            }

            //si tout ok alors start treatment
            if($treatment){
                $connect = new Database("boostrap");
                $db = $connect->connect_db();
                if($db != null ){
                    try {
                        //get password if email existe
                        $recup = $db->prepare("SELECT * FROM users WHERE email = ?");
                        $recup->execute([$this->email]);

                        if($recup ->rowCount() > 0){
                            $row = $recup->fetch();
                            //print_r($row);
                            $pass_hash = $row["password"];

                            if(password_verify($this->password, $pass_hash)){
                                $name = $row["name"];
                                $_SESSION["name"] = $name;
                                //print_r($_SESSION["name"]);
                                header("Location: $location");
                            }
                        }

                    } catch (PDOException $excep) {
                        $errorMessage = "PDO ERROR:  {$excep->getMessage()} in {$excep->getFile()} line {$excep->getLine()} \n";

                        file_put_contents(ERROR_LOG_FILE, $errorMessage, FILE_APPEND);
                        //echo "PDO ERROR: {$excep->getMessage()} storage in ". ERROR_LOG_FILE ."\n";
                        //exit(84);
                    }
                }
            }

        }
    }

?>