<?php
// Include the database connection
include 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the selected Pokémon ID from the form
    $pokemon_id = $_POST['pokemon_id'];

    // Prepare the SQL query to delete the Pokémon
    $sql = "DELETE FROM Pokémon WHERE id = $pokemon_id";

    if (mysqli_query($conn, $sql)) {
        echo "Pokémon deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch all Pokémon to populate the dropdown
$sql = "SELECT * FROM Pokémon";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Pokémon</title>
</head>
<body>
    <h1>Delete a Pokémon</h1>
    <form action="delete_pokemon.php" method="POST">
        <label for="pokemon_id">Select Pokémon to Delete:</label>
        <select id="pokemon_id" name="pokemon_id" required>
            <?php
            // Populate the dropdown with Pokémon
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Delete Pokémon</button>
    </form>
</body>
</html>
