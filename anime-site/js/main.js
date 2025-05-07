document.addEventListener('DOMContentLoaded', () => {
    // Elementos da página
    const startButton = document.getElementById('start-button');
    const landingPage = document.querySelector('.landing-page');
    const animePage = document.querySelector('.anime-page');
    const animeDetails = document.getElementById('anime-details');
    const backToStart = document.getElementById('back-to-start');
    const backToList = document.getElementById('back-to-list');
    const animeCards = document.getElementById('anime-cards');
    const detailContent = document.getElementById('detail-content');

    // Dados dos animes (exemplo)
    const animeData = [
        {
            id: 1,
            title: 'Anime 1',
            originalTitle: 'Original Anime 1',
            description: 'Descrição curta do Anime 1.',
            longDescription: 'Descrição longa do Anime 1 com mais detalhes.\nQuebras de linha também são importantes.',
            thumbnail: 'https://via.placeholder.com/150',
            image: 'https://via.placeholder.com/300',
            genres: ['Ação', 'Aventura'],
            studio: 'Studio A',
            releaseYear: 2020,
            episodes: 12,
            status: 'Completo',
            youtubeLink: 'https://www.youtube.com/',
            mangaLink: 'https://www.manga.com/'
        },
        {
            id: 2,
            title: 'Anime 2',
            originalTitle: 'Original Anime 2',
            description: 'Descrição curta do Anime 2.',
            longDescription: 'Descrição longa do Anime 2 com mais detalhes.\nQuebras de linha também são importantes.',
            thumbnail: 'https://via.placeholder.com/150',
            image: 'https://via.placeholder.com/300',
            genres: ['Comédia', 'Romance'],
            studio: 'Studio B',
            releaseYear: 2021,
            episodes: 24,
            status: 'Em lançamento',
            youtubeLink: 'https://www.youtube.com/',
            mangaLink: 'https://www.manga.com/'
        },
        {
            id: 3,
            title: 'Anime 3',
            originalTitle: 'Original Anime 3',
            description: 'Descrição curta do Anime 3.',
            longDescription: 'Descrição longa do Anime 3 com mais detalhes.\nQuebras de linha também são importantes.',
            thumbnail: 'https://via.placeholder.com/150',
            image: 'https://via.placeholder.com/300',
            genres: ['Sci-Fi', 'Drama'],
            studio: 'Studio C',
            releaseYear: 2022,
            episodes: 13,
            status: 'Completo',
            youtubeLink: 'https://www.youtube.com/',
            mangaLink: 'https://www.manga.com/'
        }
    ];
    
    // Iniciar a página de animes
    startButton.addEventListener('click', () => {
        landingPage.classList.add('fade-out');
        
        setTimeout(() => {
            landingPage.classList.add('hidden');
            animePage.classList.remove('hidden');
            
            // Adicionar efeito de fade-in
            setTimeout(() => {
                animePage.style.opacity = 1;
            }, 50);
            
            // Carregar os cards de anime
            loadAnimeCards();
        }, 1000);
    });
    
    // Voltar para a página inicial
    backToStart.addEventListener('click', () => {
        animePage.style.opacity = 0;
        
        setTimeout(() => {
            animePage.classList.add('hidden');
            landingPage.classList.remove('hidden');
            landingPage.classList.remove('fade-out');
        }, 500);
    });
    
    // Voltar para a lista de animes
    backToList.addEventListener('click', () => {
        animeDetails.style.opacity = 0;
        
        setTimeout(() => {
            animeDetails.classList.add('hidden');
            animePage.classList.remove('hidden');
            
            setTimeout(() => {
                animePage.style.opacity = 1;
            }, 50);
        }, 500);
    });
    
    // Função para carregar os cards de anime
    function loadAnimeCards() {
        animeCards.innerHTML = '';
        
        animeData.forEach(anime => {
            const card = document.createElement('div');
            card.classList.add('anime-card');
            card.dataset.id = anime.id;
            
            card.innerHTML = `
                <img src="${anime.thumbnail}" alt="${anime.title}">
                <div class="anime-info">
                    <h3>${anime.title}</h3>
                    <p>${anime.description}</p>
                    <div class="tags">
                        ${anime.genres.slice(0, 3).map(genre => `<span class="tag">${genre}</span>`).join('')}
                    </div>
                </div>
            `;
            
            // Adicionar evento de clique para abrir detalhes
            card.addEventListener('click', () => {
                openAnimeDetails(anime.id);
            });
            
            animeCards.appendChild(card);
            
            // Adicionar efeito de entrada com delay
            setTimeout(() => {
                card.style.opacity = 1;
                card.style.transform = 'translateY(0)';
            }, 100 * anime.id);
        });
    }
    
    // Função para abrir os detalhes do anime
    function openAnimeDetails(animeId) {
        const anime = animeData.find(a => a.id === animeId);
        
        if (!anime) return;
        
        detailContent.innerHTML = `
            <div class="detail-container">
                <div class="detail-header">
                    <img src="${anime.image}" alt="${anime.title}">
                    <div class="detail-header-overlay">
                        <h2>${anime.title}</h2>
                        <p>${anime.originalTitle}</p>
                    </div>
                </div>
                
                <div class="detail-content">
                    <div class="detail-section">
                        <h3>Sinopse</h3>
                        <p>${anime.longDescription.replace(/\n/g, '<br>')}</p>
                    </div>
                    
                    <div class="detail-section">
                        <h3>Informações</h3>
                        <p><strong>Estúdio:</strong> ${anime.studio}</p>
                        <p><strong>Ano de Lançamento:</strong> ${anime.releaseYear}</p>
                        <p><strong>Episódios:</strong> ${anime.episodes}</p>
                        <p><strong>Status:</strong> ${anime.status}</p>
                        <p><strong>Gêneros:</strong> ${anime.genres.join(', ')}</p>
                    </div>
                    
                    <div class="detail-links">
                        <a href="${anime.youtubeLink}" target="_blank" class="detail-link">
                            <span>Assistir Trailer</span>
                        </a>
                        <a href="${anime.mangaLink}" target="_blank" class="detail-link">
                            <span>Ler Mangá</span>
                        </a>
                    </div>
                </div>
            </div>
        `;
        
        animePage.style.opacity = 0;
        
        setTimeout(() => {
            animePage.classList.add('hidden');
            animeDetails.classList.remove('hidden');
            
            setTimeout(() => {
                animeDetails.style.opacity = 1;
            }, 50);
        }, 500);
    }
});