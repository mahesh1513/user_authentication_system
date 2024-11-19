User Authentication System

This project is a simple user authentication system implemented in PHP using Object-Oriented Programming (OOP) principles. It includes login and registration functionality.

Prerequisites
Before you can run this project on your local machine, you need to have the following installed:

PHP (>= 7 recommended)
MySQL (for the database)
XAMPP or Apache with PHP and MySQL support

Step 1: Clone or Download the Project
You can either clone the repository or download the project as a ZIP file.
https://github.com/mahesh1513/user_authentication_system.git

Step 2: Place the Project in the XAMPP htdocs Folder
For example, if your project is called user_authentication_system, place it like this:
C:\xampp\htdocs\user_authentication_system\

Step 3: Set Up the Database
Create a new database (e.g.,  user_authentication_system).
MySQL table structure available in : users.sql

Step 4: Configure Database Connection
Open the config/Database.php file and update the database connection details:
// Database.php
$this->host = 'localhost';
$this->db_name = 'user_authentication_system';
$this->username = 'root'; 
$this->password = '';

Step 5: Running the Application
Start both the Apache and MySQL services.
http://localhost/user_authentication_system/









