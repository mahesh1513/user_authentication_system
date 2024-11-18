<?php

include_once __DIR__ . '/config/Database.php';
include_once __DIR__ . '/User.php';

class LoginController {

    public function showLoginForm() {

        $check_remember_me = self::checkRememberMe();
        if($check_remember_me) {

            header("Location:index.php?url=dashboard");

        } else {

            $_SESSION['login_csrf_token'] = bin2hex(random_bytes(32));
            $csrf_token =$_SESSION['login_csrf_token'];
            include_once __DIR__ . '/login.php';

        }

    }

    public function handleLogin() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

            if (isset($_POST['csrfToken']) && $_POST['csrfToken'] === $_SESSION['login_csrf_token']) {

                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $remember_me = isset($_POST['remember_me']);

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
                    $user->remember_me = $remember_me;

                    $response = $user->login();
                    if ($response['status']) {
                        echo json_encode(array("status" => "success","message" => $response['message']));
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

        setcookie('remember_me', '', time() - 3600, '/', '', false, true);
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

    public function checkRememberMe() {

        $cookie_result = false;
        if (isset($_COOKIE['remember_me'])) {


            $database = new Database();
            $db = $database->getConnection();

            $token = $_COOKIE['remember_me'];
            $stmt = $db->prepare("SELECT * FROM users WHERE login_token = ? AND login_token_expiry > NOW()");
            $stmt->bind_param('s', $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($user = $result->fetch_assoc()) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['logged_in'] = true;

                $token = bin2hex(random_bytes(16));
                $token_expiry = date('Y-m-d H:i:s', strtotime('+30 days'));
                try {

                    $stmt1 = $db->prepare("UPDATE users SET login_token = ?,login_token_expiry = ? WHERE id = ?");
                    $stmt1->bind_param('ssi', $token, $token_expiry, $user['id']);
                    $stmt1->execute();
                    setcookie('remember_me', $token, time() + 30 * 24 * 60 * 60, '/', '', false, true);
                    $cookie_result = true;

                } catch (\Throwable $th) {
                    $cookie_result = false;
                }
      

            } else {
                $cookie_result = false;
            }

        }
        return $cookie_result;

    }



}
?>
