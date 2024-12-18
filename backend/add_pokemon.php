<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pokémon</title>
</head>
<body>
    <h1>Add a New Pokémon</h1>

    <?php
    // Include the database connection
    include 'db.php';

    // Fetch types from the database for the dropdown
    $sql = "SELECT * FROM Types";
    $result = mysqli_query($conn, $sql);
    ?>

    <!-- Form to Add Pokémon -->
    <form action="add_pokemon.php" method="POST">
        <label for="name">Pokémon Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="type_id">Type:</label>
        <select id="type_id" name="type_id" required>
            <?php
            // Dynamically populate the type dropdown
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="base_health">Base Health:</label>
        <input type="number" id="base_health" name="base_health" required><br><br>
        
        <label for="base_attack">Base Attack:</label>
        <input type="number" id="base_attack" name="base_attack" required><br><br>
        
        <label for="base_defense">Base Defense:</label>
        <input type="number" id="base_defense" name="base_defense" required><br><br>
        
        <button type="submit">Add Pokémon</button>
    </form>
</body>
</html>
