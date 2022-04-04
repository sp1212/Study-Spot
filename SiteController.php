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
        if (!isset($_SESSION["email"]))
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
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["userid"] = $data[0]["id"];
                    header("Location: ?command=home");
                } else {
                    $error_msg = "Wrong password.";
                }
            } else { // empty, no user found
                $insert = $this->db->query("insert into ss_users (email, password) values (?, ?);", 
                        "ss", $_POST["email"], 
                        password_hash($_POST["password"], PASSWORD_DEFAULT));
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                } else {
                    $_SESSION["email"] = $_POST["email"];
                    $data = $this->db->query("select * from ss_users where email = ?;", "s", $_POST["email"]);
                    $_SESSION["userid"] = $data[0]["id"];
                    header("Location: ?command=home");
                }
            }
        }

        include "login.php";
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

    public function logout() {
        session_destroy();
        header("Location: ?command=home");
    }

}