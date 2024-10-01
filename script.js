// Função para carregar o JSON de animes
async function carregarAnimes() {
    const response = await fetch('animes.json');
    const data = await response.json();
    return data;
}

// Função para filtrar e exibir os animes
async function filtrarAnimes() {
    const genero = document.querySelector('input[name="genero"]:checked').value;
    const checkContainer = document.getElementById('check');
    
    // Limpa o campo de checkboxes
    checkContainer.innerHTML = '';

    // Carrega os animes do arquivo JSON
    const animes = await carregarAnimes();

    // Se 'todos' for escolhido, combina todos os animes
    let listaAnimes = [];
    if (genero === 'todos') {
        listaAnimes = [
            ...animes.acao,
            ...animes.aventura,
            ...animes.fantasia,
            ...animes.ecchi
        ];
    } else {
        listaAnimes = animes[genero];
    }

    // Gera os checkboxes dinamicamente
    listaAnimes.forEach((anime, index) => {
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = 'anime' + (index + 1);
        checkbox.name = 'anime' + (index + 1);
        checkbox.value = anime;

        const label = document.createElement('label');
        label.htmlFor = 'anime' + (index + 1);
        label.textContent = anime;

        checkContainer.appendChild(checkbox);
        checkContainer.appendChild(label);
        checkContainer.appendChild(document.createElement('br'));
    });
}

// Inicializa com 'Mostrar Todos' selecionado
filtrarAnimes();
