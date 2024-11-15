<?php

include_once __DIR__ . '/config/Database.php';
include_once __DIR__ . '/User.php';

class LoginController {

    public function showLoginForm() {

        $csrf_token = $_SESSION['csrf_token'];
        include_once __DIR__ . '/login.php';

    }

    public function handleLogin() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

            if (isset($_POST['csrfToken']) && $_POST['csrfToken'] === $_SESSION['csrf_token']) {

                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    if (empty($email) || empty($password)) {
                        $error_message = "Please fill all the fields";
                        echo json_encode(array("status" => "failure","message" => $error_message));die();
                    } elseif (!self::validateEmail($email)) {
                        $error_message = "Please enter a valid email address.";
                        echo json_encode(array("status" => "failure","message" => $error_message));die();
                    }

                    $database = new Database();
                    $db = $database->getConnection();
                    $user = new User($db);
                    $user->email = $email;
                    $user->password = $password;
                    $response = $user->login();
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

    public function userdashboard() {

        include_once __DIR__ . '/dashboard.php';

    }

    public function logout() {

        session_unset();  
        session_destroy();
        echo json_encode(['status' => true, 'message' => 'Logged out successfully!']);
        header("Location:index.php?url=login");

    }

    public function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

}
?>
