document.getElementById("search-pokemon").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const pokemonId = document.getElementById("pokemon-id").value;
    if (pokemonId) {
        window.location.href = `update_pokemon.php?id=${pokemonId}`;
    } else {
        alert("Please enter a Pokémon ID!");
    }
});
