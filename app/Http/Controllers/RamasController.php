<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RamasController extends Controller
{
    public function showBranches($carrera)
{
    $branches = [
        'Administración' => [
            [
                'icon' => 'fas fa-users',
                'title' => 'Recursos Humanos',
                'description' => 'Gestión del personal, reclutamiento, capacitación y desarrollo organizacional.'
            ],
            [
                'icon' => 'fas fa-chart-line',
                'title' => 'Marketing',
                'description' => 'Estrategias de mercado, publicidad y desarrollo de productos.'
            ],
            [
                'icon' => 'fas fa-coins',
                'title' => 'Finanzas',
                'description' => 'Gestión financiera, inversiones y planificación económica.'
            ]
        ],
        'Contaduria' => [
            [
                'icon' => 'fas fa-file-invoice-dollar',
                'title' => 'Auditoría',
                'description' => 'Revisión y evaluación de estados financieros y procesos contables.'
            ],
            [
                'icon' => 'fas fa-balance-scale',
                'title' => 'Fiscal',
                'description' => 'Asesoría en materia tributaria y cumplimiento fiscal.'
            ],
            [
                'icon' => 'fas fa-calculator',
                'title' => 'Contabilidad Gerencial',
                'description' => 'Análisis de costos y toma de decisiones financieras.'
            ]
        ],
        'Educación' => [
            [
                'icon' => 'fas fa-child',
                'title' => 'Educación Infantil',
                'description' => 'Formación y desarrollo de niños en edad preescolar.'
            ],
            [
                'icon' => 'fas fa-book',
                'title' => 'Educación Primaria',
                'description' => 'Enseñanza fundamental en niveles básicos.'
            ],
            [
                'icon' => 'fas fa-chalkboard-teacher',
                'title' => 'Gestión Educativa',
                'description' => 'Administración y planificación de instituciones educativas.'
            ]
        ],
        'Electrónica' => [
            [
                'icon' => 'fas fa-microchip',
                'title' => 'Microelectrónica',
                'description' => 'Diseño y fabricación de circuitos integrados.'
            ],
            [
                'icon' => 'fas fa-robot',
                'title' => 'Automatización',
                'description' => 'Sistemas de control automático y robótica.'
            ],
            [
                'icon' => 'fas fa-broadcast-tower',
                'title' => 'Telecomunicaciones',
                'description' => 'Sistemas de comunicación y redes.'
            ]
        ],
        'Informática' => [
            [
                'icon' => 'fas fa-laptop-code',
                'title' => 'Desarrollo de Software',
                'description' => 'Programación y diseño de aplicaciones.'
            ],
            [
                'icon' => 'fas fa-network-wired',
                'title' => 'Redes y Sistemas',
                'description' => 'Infraestructura y administración de redes.'
            ],
            [
                'icon' => 'fas fa-shield-alt',
                'title' => 'Ciberseguridad',
                'description' => 'Protección de sistemas y datos.'
            ]
        ]
    ];

    return view('ramas', [
        'carrera' => $carrera,
        'branches' => $branches[$carrera] ?? []
    ]);
}
}
