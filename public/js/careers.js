const careers = [
    {
        icon: 'fas fa-briefcase',
        title: 'Administracion',
        description: 'Desarrolla soluciones tecnológicas y lidera la transformación digital en las organizaciones. Aprende programación, diseño de sistemas y gestión de proyectos tecnológicos.',
        duration: '5 años'
    },
    {
        icon: 'fas fa-calculator',
        title: 'Contaduria',
        description: 'Innova en el campo de la ciencia y desarrolla soluciones para mejorar la calidad de vida. Investiga en genética, microbiología y procesos biotecnológicos.',
        duration: '5 años'
    },
    {
        icon: 'fas fa-book-open',
        title: 'Educacion',
        description: 'Comprende el comportamiento humano y ayuda a mejorar la salud mental de las personas. Estudia procesos mentales, terapias y desarrollo humano.',
        duration: '5 años'
    },
    {
        icon: 'fas fa-plug',
        title: 'Electronica',
        description: 'Defiende la justicia y los derechos fundamentales en la sociedad moderna. Especialízate en diferentes áreas del derecho y contribuye al sistema legal.',
        duration: '5 años'
    },
    {
        icon: 'fas fa-laptop-code',
        title: 'Informatica',
        description: 'Analiza y gestiona recursos para impulsar el desarrollo económico sostenible. Estudia mercados, políticas económicas y desarrollo social.',
        duration: '4 años'
    }
];

const careersGrid = document.querySelector('.careers-grid');
const selectedCount = document.querySelector('.selected-count');
let selectedCareers = 0;

careers.forEach(career => {
    const careerCard = document.createElement('div');
    careerCard.className = 'career-card';
    careerCard.innerHTML = `
        <i class="far fa-star star-checkbox"></i>
        <div class="card-inner">
            <div class="card-front">
                <i class="${career.icon} career-icon"></i>
                <h3 class="career-title">${career.title}</h3>
                <a href="ramas.html" class="view-branches" onclick="event.stopPropagation()">
                    <i class="fas fa-code-branch"></i>
                    <span>Ver Ramas</span>
                </a>
                <div class="flip-hint">
                    <i class="fas fa-sync-alt"></i>
                    <span>Click para más información</span>
                </div>
            </div>
            <div class="card-back">
                <h3 class="career-title">${career.title}</h3>
                <p class="career-description">${career.description}</p>
                <div class="career-stats">
                    <div class="stat">
                        <div class="stat-value">${career.duration}</div>
                        <div class="stat-label">Duración</div>
                    </div>
                </div>
            </div>
        </div>
    `;
    careersGrid.appendChild(careerCard);

    const starCheckbox = careerCard.querySelector('.star-checkbox');
    const cardInner = careerCard.querySelector('.card-inner');

    careerCard.addEventListener('click', (e) => {
        if (!e.target.classList.contains('star-checkbox')) {
            careerCard.classList.toggle('flipped');
        }
    });

    starCheckbox.addEventListener('click', (e) => {
        e.stopPropagation();
        careerCard.classList.toggle('selected');
        
        if (careerCard.classList.contains('selected')) {
            starCheckbox.classList.remove('far');
            starCheckbox.classList.add('fas');
            selectedCareers++;
        } else {
            starCheckbox.classList.remove('fas');
            starCheckbox.classList.add('far');
            selectedCareers--;
        }

        selectedCount.querySelector('span').textContent = 
            `${selectedCareers} carrera${selectedCareers !== 1 ? 's' : ''} seleccionada${selectedCareers !== 1 ? 's' : ''}`;
        
        if (selectedCareers > 0) {
            selectedCount.classList.add('show');
        } else {
            selectedCount.classList.remove('show');
        }
    });

    starCheckbox.addEventListener('mouseover', () => {
        if (!careerCard.classList.contains('selected')) {
            starCheckbox.classList.remove('far');
            starCheckbox.classList.add('fas');
        }
    });

    starCheckbox.addEventListener('mouseout', () => {
        if (!careerCard.classList.contains('selected')) {
            starCheckbox.classList.remove('fas');
            starCheckbox.classList.add('far');
        }
    });
});

document.querySelectorAll('.view-branches').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const careerTitle = e.target.closest('.card-front').querySelector('.career-title').textContent;
        const encodedTitle = encodeURIComponent(careerTitle);
        window.location.href = `ramas.html?carrera=${encodedTitle}`;
    });
});