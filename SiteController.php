<?php
class SiteController {
    private $command;

    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
    }

    public function run() {
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

        if (!isset($_SESSION["email"]) && $this->command == "createaccount")
        {
            $this->command == "createaccount"; // repetitive but just continue
        }
        else if (isset($_SESSION["email"]) && $this->command == "createaccount")
        {
            $this->command = "home";
        }
        else if (isset($_SESSION["email"]) && $this->command == "login")
        {
            $this->command = "home";
        }
        else if (!isset($_SESSION["email"]))
        {
            $this->command = "login";
        }

        switch($this->command) {
            case "building":
                $this->building();
                break;
            case "classroom":
                $this->classroom();
                break;
            case "home":
                $this->home();
                break;
            case "profile":
                $this->profile();
                break;
            case "createaccount":
                $this->createaccount();
                break;
            case "logout":
                $this->logout();
            case "login":
            default:
                $this->login();
                break;
        }
    }
    

    // Display the login page (and handle login logic)
    public function login() {
        $error_msg = "";

        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from ss_users where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user.";
            }
            else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["userid"] = $data[0]["id"];
                    $_SESSION["timezone"] = $data[0]["timezone"];
                    header("Location: ?command=home");
                } else {
                    $error_msg = "Invalid password.";
                }
            }
            else { // empty, no user found
                $error_msg = "Account not found.";
            }
        }

        include ("login.php");
    }

    public function createaccount() {
        $error_msg = "";

        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from ss_users where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user.";
            }
            else if (!empty($data)) {
                $error_msg = "Account already exists.";
            }
            else if ($_POST["password"] != $_POST["passwordconf"]) {
                $error_msg = "Password confirmation didn't match.";
            }
            else if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST["email"]) ? FALSE : TRUE) {
                $error_msg = "Invalid email address.";
                // regex source:  https://www.w3schools.in/php/examples/email-validation-php-regular-expression
            }
            else { // empty, no user found
                $insert = $this->db->query("insert into ss_users (email, password) values (?, ?);", 
                        "ss", $_POST["email"], 
                        password_hash($_POST["password"], PASSWORD_DEFAULT));
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                }
                else {
                    $_SESSION["email"] = $_POST["email"];
                    $data = $this->db->query("select * from ss_users where email = ?;", "s", $_POST["email"]);
                    $_SESSION["userid"] = $data[0]["id"];
                    $_SESSION["timezone"] = $data[0]["timezone"];
                    header("Location: ?command=home");
                }
            }
        }

        include ("createaccount.php");
    }

    public function home() {
        include("home.php");
    }

    public function building() {
        include ("building-sample.php");
    }

    public function classroom() {
        include ("classroom-sample.php");
    }

    public function profile() {
        if (isset($_POST["timezone"])) {
            $data = $this->db->query("update ss_users set timezone = ? where ss_users.id = ?;", "ss", $_POST["timezone"], $_POST["userid"]);
            $_SESSION['timezone'] = $_POST["timezone"];
            header("Location: ?command=profile");
        }

        include ("profile.php");
    }

    public function logout() {
        session_destroy();
        header("Location: ?command=home");
    }

}