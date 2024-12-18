<?php
include 'db.php'; // Include the database connection

// Initialize variables to store Pokémon details
$pokemon_name = "";
$pokemon_health = "";
$pokemon_attack = "";
$pokemon_defense = "";
$pokemon_type_id = "";

// Check if the form was submitted to get the Pokémon ID
if (isset($_POST['pokemon_id'])) {
    $pokemon_id = (int) $_POST['pokemon_id']; // Get the selected Pokémon ID

    // Query to get the Pokémon details based on the selected ID
    $query = "SELECT * FROM Pokémon WHERE id = $pokemon_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $pokemon = mysqli_fetch_assoc($result);
        // Store the Pokémon details for editing
        $pokemon_name = $pokemon['name'];
        $pokemon_health = $pokemon['base_health'];
        $pokemon_attack = $pokemon['base_attack'];
        $pokemon_defense = $pokemon['base_defense'];
        $pokemon_type_id = $pokemon['type_id'];
    } else {
        $pokemon_name = "No Pokémon found with that ID.";
    }
}

// If the form is for updating, process the update
if (isset($_POST['update_pokemon'])) {
    $new_name = mysqli_real_escape_string($conn, $_POST['new_name']); // New Pokémon name
    $new_health = (int) $_POST['new_health']; // New base health
    $new_attack = (int) $_POST['new_attack']; // New base attack
    $new_defense = (int) $_POST['new_defense']; // New base defense
    $new_type_id = (int) $_POST['new_type_id']; // New type ID
    $pokemon_id = (int) $_POST['pokemon_id']; // Get the selected Pokémon ID

    // Update query to change the Pokémon details
    $update_query = "UPDATE Pokémon 
                     SET name = '$new_name', base_health = $new_health, base_attack = $new_attack, 
                         base_defense = $new_defense, type_id = $new_type_id 
                     WHERE id = $pokemon_id";
    if (mysqli_query($conn, $update_query)) {
        $pokemon_name = $new_name; // Update the displayed name
        echo "<p>Pokémon details updated successfully.</p>";
    } else {
        echo "<p>Error updating Pokémon details: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pokémon Details</title>
</head>
<body>
    <h2>Update Pokémon Details by ID</h2>

    <!-- Form to select Pokémon ID -->
    <form method="POST" action="update_pokemon.php">
        <label for="pokemon_id">Select Pokémon ID:</label>
        <select name="pokemon_id" id="pokemon_id" required>
            <option value="">--Select ID--</option>
            <?php
            // Fetch all Pokémon IDs from the database for the dropdown list
            $query = "SELECT id, name FROM Pokémon";
            $result = mysqli_query($conn, $query);

            // Loop through the result and populate the dropdown
            while ($pokemon = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $pokemon['id'] . "'>" . htmlspecialchars($pokemon['id']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Get Pokémon Details">
    </form>

    <?php if ($pokemon_name !== ""): ?>
        <h3>Current Pokémon Details:</h3>
        <p>Name: <?php echo htmlspecialchars($pokemon_name); ?></p>
        <p>Base Health: <?php echo htmlspecialchars($pokemon_health); ?></p>
        <p>Base Attack: <?php echo htmlspecialchars($pokemon_attack); ?></p>
        <p>Base Defense: <?php echo htmlspecialchars($pokemon_defense); ?></p>
        <p>Type ID: <?php echo htmlspecialchars($pokemon_type_id); ?></p>

        <!-- Form to update Pokémon details -->
        <form method="POST" action="update_pokemon.php">
            <input type="hidden" name="pokemon_id" value="<?php echo htmlspecialchars($pokemon_id); ?>">
            
            <label for="new_name">New Pokémon Name:</label>
            <input type="text" name="new_name" id="new_name" value="<?php echo htmlspecialchars($pokemon_name); ?>" required>

            <label for="new_health">New Base Health:</label>
            <input type="number" name="new_health" id="new_health" value="<?php echo htmlspecialchars($pokemon_health); ?>" required>

            <label for="new_attack">New Base Attack:</label>
            <input type="number" name="new_attack" id="new_attack" value="<?php echo htmlspecialchars($pokemon_attack); ?>" required>

            <label for="new_defense">New Base Defense:</label>
            <input type="number" name="new_defense" id="new_defense" value="<?php echo htmlspecialchars($pokemon_defense); ?>" required>

            <label for="new_type_id">New Type ID:</label>
            <input type="number" name="new_type_id" id="new_type_id" value="<?php echo htmlspecialchars($pokemon_type_id); ?>" required>

            <input type="submit" name="update_pokemon" value="Update Pokémon Details">
        </form>
    <?php endif; ?>

    <p><a href="index.php">Back to Pokémon List</a></p>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
