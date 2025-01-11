<?php
// Require database connection
require 'config/fungsi.php';

// Check if an ID is provided for deletion
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // SQL query to delete the record with the given ID
    $query = "DELETE FROM kamar_222271 WHERE id_222271 = $id";
    
    // Execute the query
    if (mysqli_query($db, $query)) {
        // If successful, redirect to the list page or show a success message
        header('Location: index.php'); // Replace with the page you want to redirect to
        exit();
    } else {
        // If there was an issue, show an error
        echo "Error: Could not delete the room.";
    }
} else {
    echo "Error: ID not provided.";
}
?>
