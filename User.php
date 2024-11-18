<?php
include_once __DIR__ . '/config/Database.php';

class User {

    private $conn;
    private $table_name = 'users';

    public $username;
    public $email;
    public $password;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register() {
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? OR email = ?";
        if ($stmt = $this->conn->prepare($query)) {

            $stmt->bind_param("ss", $this->username,$this->email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                return ['status' => false, 'message' => 'Username / Email already exists!'];
            }
            $stmt->close();
        }

        // Hash the password
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table_name . " (username, email, password,created_at) VALUES (?, ?, ?, ?)";
        if ($stmt = $this->conn->prepare($query)) {

            $stmt->bind_param("ssss", $this->username, $this->email, $hashed_password, $this->created_at);
            if ($stmt->execute()) {
                return ['status' => true, 'message' => 'User Registered successfully!'];
            }
            $stmt->close();
        }
        return ['status' => false, 'message' => 'Registration failed'];

    }

    public function login() {

        $query = "SELECT id, username,email, password FROM " . $this->table_name . " WHERE username = ? OR email = ?";
        if ($stmt = $this->conn->prepare($query)) {

            $stmt->bind_param("ss", $this->username,$this->email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {

                $stmt->bind_result($user_id, $db_username,$email, $db_hashed_password);
                $stmt->fetch();
                if (password_verify($this->password, $db_hashed_password)) {
                    
                    if ($this->remember_me) {

                        $token = bin2hex(random_bytes(16));
                        $token_expiry = date('Y-m-d H:i:s', strtotime('+30 days'));
                        $stmt1 = $this->conn->prepare("UPDATE users SET login_token = ?,login_token_expiry = ? WHERE id = ?");
                        $stmt1->bind_param('ssi', $token, $token_expiry, $user_id);
                        $stmt1->execute();
                        setcookie('remember_me', $token, time() + 30 * 24 * 60 * 60, '/', '', false, true);

                    }

                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['email'] = $email;
                    $_SESSION['logged_in'] = true;
                    return ['status' => true, 'message' => 'Login successful!'];

                } else {
                    return ['status' => false, 'message' => 'Invalid user credentials!'];
                }

            }  else {
                return ['status' => false, 'message' => 'User does not exist!'];
            }
            $stmt->close();

        } else {
            return ['status' => false, 'message' => 'Something went wrong!'];
        }

    }



}
?>
