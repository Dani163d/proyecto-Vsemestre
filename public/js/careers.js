const careers = [
    {
        icon: 'fas fa-briefcase',
        title: 'Administración',
        description: 'Es el proceso de planificar, organizar, dirigir y controlar los recursos de una organización para alcanzar sus objetivos de manera eficiente y efectiva. Incluye diversas áreas como la gestión de recursos humanos, finanzas, marketing y operaciones.',
        duration: 'Dos años y medio'
    },
    {
        icon: 'fas fa-calculator',
        title: 'Contaduría',
        description: 'Es la práctica de medir, analizar y comunicar información financiera. Los contadores se encargan de llevar registros precisos de las transacciones económicas, preparar estados financieros, y asegurar el cumplimiento de normativas fiscales.',
        duration: 'Dos años y medio'
    },
    {
        icon: 'fas fa-book-open',
        title: 'Educación',
        description: 'Se centra en la formación de profesionales que se encargan del desarrollo y aprendizaje de niños en las primeras etapas de su vida.',
        duration: 'Dos años y medio'
    },
    {
        icon: 'fas fa-plug',
        title: 'Electrónica',
        description: 'Se ocupa del estudio y aplicación de dispositivos y sistemas que controlan el flujo de electrones. Se centra en el diseño, análisis y fabricación de circuitos electrónicos.',
        duration: 'Dos años y medio'
    },
    {
        icon: 'fas fa-laptop-code',
        title: 'Informática',
        description: 'Se ocupa del diseño y desarrollo de software, la gestión de bases de datos, la ciberseguridad y la implementación de tecnologías para resolver problemas y optimizar procesos.',
        duration: 'Dos años y medio'
    }
];

// Tema oscuro/claro
const themeToggle = document.querySelector('.theme-toggle');
const themeIcon = themeToggle.querySelector('i');
const html = document.documentElement;

// Cargar tema guardado
const savedTheme = localStorage.getItem('theme') || 'dark';
html.setAttribute('data-theme', savedTheme);
themeIcon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';

// Toggle tema
themeToggle.addEventListener('click', () => {
    const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', newTheme);
    themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    localStorage.setItem('theme', newTheme);
});

const careersGrid = document.querySelector('.careers-grid');
const selectedCount = document.querySelector('.selected-count');
let selectedCareers = 0;

// Cargar carreras seleccionadas
const savedSelections = JSON.parse(localStorage.getItem('selectedCareers') || '[]');

careers.forEach(career => {
    const careerCard = document.createElement('div');
    careerCard.className = 'career-card';
    careerCard.innerHTML = `
        <i class="far fa-star star-checkbox"></i>
        <div class="card-inner">
            <div class="card-front">
                <i class="${career.icon} career-icon"></i>
                <h3 class="career-title">${career.title}</h3>
                <a href="/ramas/${encodeURIComponent(career.title)}" class="view-branches" onclick="event.stopPropagation()">
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

    // Restaurar selecciones guardadas
    if (savedSelections.includes(career.title)) {
        careerCard.classList.add('selected');
        starCheckbox.classList.remove('far');
        starCheckbox.classList.add('fas');
        selectedCareers++;
    }

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

        // Actualizar contador y guardar selecciones
        selectedCount.querySelector('span').textContent = 
            `${selectedCareers} carrera${selectedCareers !== 1 ? 's' : ''} seleccionada${selectedCareers !== 1 ? 's' : ''}`;
        
        if (selectedCareers > 0) {
            selectedCount.classList.add('show');
        } else {
            selectedCount.classList.remove('show');
        }

        // Guardar selecciones en localStorage
        const currentSelections = Array.from(document.querySelectorAll('.career-card.selected'))
            .map(card => card.querySelector('.career-title').textContent);
        localStorage.setItem('selectedCareers', JSON.stringify(currentSelections));
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

// Mostrar contador inicial si hay selecciones
if (selectedCareers > 0) {
    selectedCount.querySelector('span').textContent = 
        `${selectedCareers} carrera${selectedCareers !== 1 ? 's' : ''} seleccionada${selectedCareers !== 1 ? 's' : ''}`;
    selectedCount.classList.add('show');
}

