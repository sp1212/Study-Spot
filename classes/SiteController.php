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
            case "jsonbuildings":
                $this->jsonbuildings();
                break;
            case "buildinglist":
                $this->buildinglist();
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
        //get the buildings list from the start
        $_SESSION["buildings"] =  $this->db->query("SELECT * FROM building");
//        setcookie("buildings", json_encode($data[0]), time() + 7200); //make sure cookie lasts as long as session

        $error_msg = "";

        if (isset($_POST["email"])) {
            $data = $this->db->query("SELECT * FROM ss_user WHERE email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user.";
            }
            else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["email"] = $data[0]["email"];
                    $_SESSION["name"] = $data[0]["name"];
                    $_SESSION["userid"] = $data[0]["id"];
                    $_SESSION["timezone"] = $data[0]["timezone"];
                    //setcookie("searches", $data[0]["searches"]); //their default searches
                    $searches = $data[0]["searches"];
                    $searches = trim($searches, "[]");
                    //print_r($searches);
                    $searches = str_replace("\"", "", $searches);
                    //$searches = $_COOKIE["searches"];
                    //echo gettype($searches);
                    $searches = explode(",", $searches);
                    $_SESSION["searches"] = $searches;
                    header("Location: ?command=home");
                } else {
                    $error_msg = "Invalid password.";
                }
            }
            else { // empty, no user found
                $error_msg = "Account not found.";
            }
        }

        include("templates/login.php");
    }

    public function createaccount() {
        $error_msg = "";

        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from ss_user where email = ?;", "s", $_POST["email"]);
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
                $insert = $this->db->query("insert into ss_user (name, email, password) values (?, ?, ?);",
                        "sss", $_POST["name"], $_POST["email"],
                        password_hash($_POST["password"], PASSWORD_DEFAULT));
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                }
                else {
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    $data = $this->db->query("select * from ss_user where email = ?;", "s", $_POST["email"]);
                    //setcookie("searches", $data[0]["searches"]); //their default searches
                    $searches = $data[0]["searches"];
                    $searches = trim($searches, "[]");
                    //print_r($searches);
                    $searches = str_replace("\"", "", $searches);
                    //$searches = $_COOKIE["searches"];
                    //echo gettype($searches);
                    $searches = explode(",", $searches);
                    $_SESSION["searches"] = $searches;
                    $_SESSION["userid"] = $data[0]["id"];
                    $_SESSION["timezone"] = $data[0]["timezone"];
                    header("Location: ?command=home");
                }
            }
        }

        include("templates/createaccount.php");
    }

    public function home() {
        //if a search as been made, add it to one of the 8 available cards
        if(isset($_POST["search"])){
           array_unshift($_SESSION["searches"], $_POST["search"]);
           array_pop($_SESSION["searches"]);
           header("Location: ?command=building&name={$_POST["search"]}");
           unset($_POST["search"]);

        } else {
            unset($_POST["search"]);
            include("templates/home.php");
            //store list of buildings as cookie array
        }

    }

    public function buildinglist() {
        include ("templates/buildinglist.php");
    }

    public function building() {
        //depending on where the request comes from, $_GET["name"] might not be set
        if(!isset($_GET["name"])){
            $_GET["name"] = $_SESSION["searches"][0];
        }
        //TODO: check global class list if classroom has been instnantiated, if not build it using Buildings method
        $name = $_GET["name"];
        Buildings::buildRoom($name);
        include("templates/building.php");
    }

    public function classroom() {
        include("templates/classroom.php");
    }

    public function profile() {
        //if a timezone is set, update the users timezone in their database
        if (isset($_POST["timezone"])) {
            $data = $this->db->query("update ss_user set timezone = ? where ss_user.id = ?;", "ss", $_POST["timezone"], $_POST["userid"]);
            $_SESSION['timezone'] = $_POST["timezone"];
            header("Location: ?command=profile");
        }

        include("templates/profile.php");
    }

    // reference:  https://www.tutorialrepublic.com/faq/how-to-return-json-from-a-php-script.php
    public function jsonbuildings() {
        //return building data as a json file
        $data = $this->db->query("select * from building");
        header("Content-Type: application/json");
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function logout() {
        session_destroy();
//        setcookie("buildings", "", time()-7200);
        $rtn = json_encode($_SESSION["searches"]);
        $this->db->query("UPDATE ss_user SET searches=? WHERE id=?", "si", $rtn, $_SESSION["userid"]);
        header("Location: ?command=home");
    }


}