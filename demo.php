<?php
// Database connection parameters
$dsn = 'mysql:host=localhost;dbname=crud';
$id = 'id';
$qualification = 'qualification';

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $id,$qualification);
    
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // SQL query with inner join
    $sql = "SELECT name AS name, quali.id, quali.qualification
            FROM user
            INNER JOIN quali ON user.id = quali.id";
    
    // Prepare the statement
    $stmt = $pdo->prepare($sql);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch the results as an associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output the results
    foreach ($results as $row) {
        echo "quali: {$row['qualification']}";
    }
} catch (PDOException $e) {
    // Handle database connection error
    echo "Connection failed: " . $e->getMessage();}
?>