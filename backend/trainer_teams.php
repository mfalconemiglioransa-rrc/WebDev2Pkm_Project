<?php
session_start();
include 'db.php';

// Ensure the user is a Trainer
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Trainer') {
    echo "Access denied. You must be a Trainer to manage your team.";
    exit();
}

// Fetch the Pokémon available for the Trainer
$result = mysqli_query($conn, "SELECT * FROM Pokémon");
echo "<h3>Available Pokémon</h3>";
echo "<form method='POST' action='add_to_team.php'>";
echo "<select name='pokemon_id'>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";
echo "<input type='submit' value='Add to Team'>";
echo "</form>";
?>
