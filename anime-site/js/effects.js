// Função para criar partículas no fundo
function createParticles() {
    const particleContainer = document.querySelector('.particle-container');
    const particleCount = 100;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        // Posição aleatória
        const posX = Math.random() * window.innerWidth;
        const posY = Math.random() * window.innerHeight;
        
        // Tamanho aleatório
        const size = Math.random() * 3 + 1;
        
        // Opacidade aleatória
        const opacity = Math.random() * 0.5 + 0.3;
        
        // Velocidade aleatória
        const speedX = Math.random() * 1 - 0.5;
        const speedY = Math.random() * 1 - 0.5;
        
        // Aplicar estilos
        particle.style.left = `${posX}px`;
        particle.style.top = `${posY}px`;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.opacity = opacity;
        
        // Adicionar ao container
        particleContainer.appendChild(particle);
        
        // Animar partícula
        animateParticle(particle, posX, posY, speedX, speedY);
    }
}

// Função para animar partículas
function animateParticle(particle, posX, posY, speedX, speedY) {
    let x = posX;
    let y = posY;
    
    function update() {
        x += speedX;
        y += speedY;
        
        // Verificar limites da tela
        if (x < 0 || x > window.innerWidth) {
            speedX = -speedX;
        }
        
        if (y < 0 || y > window.innerHeight) {
            speedY = -speedY;
        }
        
        // Atualizar posição
        particle.style.left = `${x}px`;
        particle.style.top = `${y}px`;
        
        // Continuar animação
        requestAnimationFrame(update);
    }
    
    update();
}

// Iniciar efeitos quando a página carregar
document.addEventListener('DOMContentLoaded', () => {
    createParticles();
});