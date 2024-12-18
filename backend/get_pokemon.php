<?php
include 'db.php';

$result = mysqli_query($conn, "SELECT * FROM Pokémon");
$pokemons = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pokemons[] = $row;
}

echo '<table border="1" cellpadding="10" cellspacing="0">';
echo '<tr><th>ID</th><th>Name</th><th>Type ID</th><th>Base Health</th><th>Base Attack</th><th>Base Defense</th></tr>';

foreach ($pokemons as $pokemon) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($pokemon['id']) . '</td>';
    echo '<td>' . htmlspecialchars($pokemon['name']) . '</td>';
    echo '<td>' . htmlspecialchars($pokemon['type_id']) . '</td>';
    echo '<td>' . htmlspecialchars($pokemon['base_health']) . '</td>';
    echo '<td>' . htmlspecialchars($pokemon['base_attack']) . '</td>';
    echo '<td>' . htmlspecialchars($pokemon['base_defense']) . '</td>';
    echo '</tr>';
}

echo '</table>';

mysqli_close($conn);
?>
