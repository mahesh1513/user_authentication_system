<?php
class Routes {

    public function __construct() {

        session_start(); // Start the session when the class is instantiated
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

    }

    public function route($url) {

        if ($url === '/login' || $url === 'login') {

            if ($this->isLoggedIn()) {

                header("Location:index.php?url=dashboard");

            } else {
                $this->loginAction();
            }
           
        } elseif ($url === '/submit_login' || $url === 'submit_login') {
            $this->loginSubmitAction();
        } elseif ($url === '/register' || $url ==='register') {
            $this->registerAction();
        } elseif ($url === '/submit_register' || $url === 'submit_register') {
            $this->registerSubmitAction();
        } else {

            if ($this->isLoggedIn()) {

                if ($url === '/dashboard' || $url === 'dashboard') {
                    $this->dasboardAction();
                } elseif ($url === '/logout' || $url === 'logout') {
                    $this->logoutAction();
                } else {
                    $this->handle404();
                }

            } else {
                header("Location:index.php?url=login");
            }
            
        }

    }

    private function loginAction() {
        include_once __DIR__ . '/LoginController.php';
        $loginController = new LoginController();
        $loginController->showLoginForm();
    }

    private function loginSubmitAction() {
        include_once __DIR__ . '/LoginController.php';
        $loginController = new LoginController();
        $loginController->handleLogin();
    }

    private function registerAction() {
        include_once __DIR__ . '/RegisterController.php';
        $registerController = new RegisterController();
        $registerController->showRegisterForm();
    }

    private function registerSubmitAction() {
        include_once __DIR__ . '/RegisterController.php';
        $registerController = new RegisterController();
        $registerController->handleRegister();
    }

    private function dasboardAction() {
        include_once __DIR__ . '/LoginController.php';
        $loginController = new LoginController();
        $loginController->userdashboard();
    }

    private function logoutAction() {
        include_once __DIR__ . '/LoginController.php';
        $loginController = new LoginController();
        $loginController->logout();
    }

    private function handle404() {
        include_once __DIR__ .'/404.php';
    }

    public function isLoggedIn() {

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            return true;
        }
        return false;
    }

}
?>
