<?php

include_once __DIR__ . '/config/Database.php';
include_once __DIR__ . '/User.php';

class RegisterController {

    public function showRegisterForm() {

        $_SESSION['register_csrf_token'] = bin2hex(random_bytes(32));
        $csrf_token = $_SESSION['register_csrf_token'];
        include_once  __DIR__ . '/register.php';

    }

    public function handleRegister() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

            if (isset($_POST['csrfToken']) && $_POST['csrfToken'] === $_SESSION['register_csrf_token']) {

            $username = $_POST['username'];
            $username = filter_var($username, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            $password = $_POST['password'];
            $password = filter_var($password, FILTER_SANITIZE_STRING);

            if (empty($username)  || empty($email) || empty($password)) {
                $error_message = "Please fill all the fields";
                echo json_encode(array("status" => "failure","message" => $error_message));die();
            } elseif (!self::validateUsername($username)) {
                $error_message = "Username must be at least 6 characters long and can only contain letters and numbers.";
                echo json_encode(array("status" => "failure","message" => $error_message));die();
            } elseif (!self::validateEmail($email)) {
                $error_message = "Please enter a valid email address.";
                echo json_encode(array("status" => "failure","message" => $error_message));die();
            } elseif (!self::validateStrongPassword($password)) {
                $error_message = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one digit.";
                echo json_encode(array("status" => "failure","message" => $error_message));die();
            }

            $database = new Database();
            $db = $database->getConnection();
            $user = new User($db);
            $user->username = $username;
            $user->email = $email;
            $user->password = $password;
            $user->created_at = date('Y-m-d H:i:s');
            $response = $user->register();
            if ($response['status']) {
                echo json_encode(array("status" => "success","message" => $response['message']));
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            } else {
                echo json_encode(array("status" => "failure","message" => $response['message']));
            }

        } else {
            echo json_encode(array("status" => "failure","message" => "Error: Invalid Request!"));
        }

        } else {
            echo json_encode(array("status" => "failure","message" => "Error: Invalid Request!"));
        }

    }

    public function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    // validation password
    public function validateStrongPassword($password) {

        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/";
        if (preg_match($pattern, $password)) {
            return true;
        } else {
            return false;
        }

    }

    public function validateUsername($username) {

        $pattern = "/^[a-zA-Z0-9]{6,}$/";
        if (preg_match($pattern, $username)) {
            return true; 
        } else {
            return false;
        }

    }

}
?>
