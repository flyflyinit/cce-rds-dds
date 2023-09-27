<?php
echo "Apache is running!";
?>
<hr>
<?php
// MySQL Connection
$mysqlHost = "MySQL IP Address";  
$mysqlUsername = "root";  
$mysqlPassword = "MySQL Password";  
$mysqlDatabase = "db"; 

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
// MongoDB Connection
$mongoHost = "Mongo IP Address";  
$mongoUsername = "rwuser";  
$mongoPassword = "MongoDB Password";  
$mongoDatabase = "test"; 

require_once __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;
try {
    $client = new MongoDB\Client("mongodb://$mongoUsername:$mongoPassword@$mongoHost:8635/$mongoDatabase?authSource=admin");
    echo "Connected successfully to MongoDB";
} catch (MongoDB\Driver\Exception\Exception $e) {
    die("MongoDB Connection Failed: " . $e->getMessage());
}
?>