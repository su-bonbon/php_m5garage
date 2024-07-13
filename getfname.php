<?php
include_once 'connection.php';

// Fetch the fName from the Employee table
try {
    $stmt = $pdo->prepare('SELECT fName FROM Employee LIMIT 1');
    $stmt->execute();
    $fName = $stmt->fetchColumn();
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}

// Use the fetched fName in your HTML code
?>

<div class="carousel-caption d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <p class="fw-semibold" style="font-size: 10em;"><?php echo htmlspecialchars($fName); ?> GARAGE</p>
        <p class="fs-3">Thank you</p>
    </div>
</div>