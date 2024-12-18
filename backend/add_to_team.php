<?php
session_start();
include 'db.php';

// Ensure the user is logged in and is a Trainer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Trainer') {
    echo "You must be a Trainer to add Pokémon to your team.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Get the logged-in trainer's user_id
    $pokemon_id = $_POST['pokemon_id']; // Get the selected Pokémon's id

    // Insert the Pokémon into the trainer's team
    $sql = "INSERT INTO TrainerTeams (user_id, pokemon_id) VALUES ('$user_id', '$pokemon_id')";
    if (mysqli_query($conn, $sql)) {
        echo "Pokémon added to your team successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
