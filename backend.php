<?php

$host = "localhost";
$username = "root";
$db_password = ""; // Database connection password
$dbname = "test";

header("Content-Type: application/json");

$resdp = file_get_contents('php://input');
$deta = json_decode($resdp, true);

$first_name = isset($deta['first_name']) ? $deta['first_name'] : null;
$last_name = isset($deta['last_name']) ? $deta['last_name'] : null;
$email = isset($deta['email']) ? $deta['email'] : null;
$form_password = isset($deta['password']) ? $deta['password'] : null;

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if it's a POST request and if required data is provided
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $first_name && $last_name && $email && $form_password) {
        $stmt = $pdo->prepare("INSERT INTO testtable1 (name, surname, email, password) VALUES (:name, :surname, :email, :password)");
        $stmt->bindParam(":name", $first_name);
        $stmt->bindParam(":surname", $last_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $form_password);

        // Execute the database query
        $result = $stmt->execute();
        if ($result) {
            http_response_code(201); // Created status
            $response = array(
                'message' => 'success'
            );
            echo json_encode($response);
            exit;
        } else {
            http_response_code(400); // Bad Request status
            $response = array(
                'message' => 'failed'
            );
            echo json_encode($response);
        }
    } else {
        http_response_code(400); // Bad Request status
        $response = array(
            'message' => 'Invalid or missing input data'
        );
        echo json_encode($response);
    }
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error status
    echo json_encode(array('message' => 'An error occurred'));
}
