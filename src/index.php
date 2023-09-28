<?php
echo "Apache is running!";
?>
<hr>
<?php
// MySQL Connection
$mysqlUsername = getenv("mysqluser");
$mysqlPassword = getenv("mysqlpass");
$mysqlHost = getenv("mysqlip");
$mysqlDatabase = getenv("mysqldb");

// MongoDB Connection
$mongoUsername = getenv("mongodbuser");
$mongoPassword = getenv("mongodbpass");
$mongoHost = getenv("mongodbip");
$mongoDatabase = getenv("mongodb");

// Create connection
$conn = new mysqli($mysqlHost, $mysqlUsername, $mysqlPassword, $mysqlDatabase);

// Check connection
if ($conn->connect_error) {
  die("MySQL Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL!";
?>
<br>
<?php

require_once __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;
try {
    $client = new MongoDB\Client("mongodb://$mongoUsername:$mongoPassword@$mongoHost:8635/$mongoDatabase?authSource=admin");
    echo "Connected successfully to MongoDB";
} catch (MongoDB\Driver\Exception\Exception $e) {
    die("MongoDB Connection Failed: " . $e->getMessage());
}
?>