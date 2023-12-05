document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('search-form');
    const searchQuery = document.getElementById('search-query');
    const searchResults = document.querySelector('#search-results tbody');

    searchForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const query = searchQuery.value;

        // Envoyer une requête AJAX
        fetch(`/recherche?q=${query}`)
            .then(response => response.json())
            .then(data => {
                // Effacer le contenu actuel du tableau
                searchResults.innerHTML = '';

                // Remplir le tableau avec les résultats
                data.forEach(result => {
                    const row = document.createElement('tr');
                    const idCell = document.createElement('td');
                    const nomCell = document.createElement('td');
                    const adresseCell = document.createElement('td');
                    const regionCell = document.createElement('td');
                    const telephoneCell = document.createElement('td');

                    idCell.textContent = result.id; // Modifier en fonction de vos résultats
                    nomCell.textContent = result.nom; // Modifier en fonction de vos résultats
                    adresseCell.textContent = result.adresse; // Modifier en fonction de vos résultats
                    regionCell.textContent = result.region; // Modifier en fonction de vos résultats
                    telephoneCell.textContent = result.telephone; // Modifier en fonction de vos résultats

                    row.appendChild(idCell);
                    row.appendChild(nomCell);
                    row.appendChild(adresseCell);
                    row.appendChild(regionCell);
                    row.appendChild(telephoneCell);
                    searchResults.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Erreur lors de la recherche :', error);
            });
    });
});