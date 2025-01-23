@extends('layouts.app')

@section('styles')
<style>

        :root {
            --text-color: #f3f4f6;
            --card-bg: #1e1b4b;
            --hover-color: #f79840;
            --body-bg: #0f172a;
            --gradient-1: linear-gradient(135deg, #f79840 0%, #ff6b6b 100%);
            --gradient-2: linear-gradient(135deg, #1e1b4b 0%, #2d2a5d 100%);
        }

        [data-theme="light"] {
            --text-color: #1e293b;
            --card-bg: #ffffff;
            --hover-color: #f79840;
            --body-bg: #f1f5f9;
            --gradient-2: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        body {
            background: var(--body-bg);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.5s ease;
        }

        .branches-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            animation: fadeIn 1s ease-out;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            padding: 1rem;
            background: var(--gradient-2);
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-button {
            background: var(--gradient-1);
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.5rem;
            border-radius: 2rem;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(247, 152, 64, 0.3);
        }

        .back-button:hover {
            box-shadow: 0 6px 20px rgba(247, 152, 64, 0.4);
        }

        .theme-toggle {
            background: var(--gradient-1);
            width: 50px;
            height: 50px;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(247, 152, 64, 0.3);
        }

        .career-title {
            text-align: center;
            margin-bottom: 3rem;
            font-size: 2.5rem;
            color: var(--text-color);
            position: relative;
            padding-bottom: 1rem;
        }

        .career-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--gradient-1);
            border-radius: 2px;
        }

        .branches-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .branch-card {
            background: var(--gradient-2);
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
            position: relative;
            overflow: hidden;
            animation: float 6s ease-in-out infinite;
        }

        .branch-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-1);
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 0;
        }

        .branch-card:hover {
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.15);
        }

        .branch-card:hover::before {
            opacity: 0.1;
        }

        .branch-content {
            position: relative;
            z-index: 1;
        }

        .branch-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: var(--hover-color);
            transition: all 0.3s ease;
            display: inline-block;
        }

        .branch-card:hover .branch-icon {
            color: var(--hover-color);
        }

        .branch-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-color);
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .branch-description {
            color: var(--text-color);
            opacity: 0.9;
            line-height: 1.7;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .branches-container {
                padding: 1rem;
            }
            
            .branches-grid {
                grid-template-columns: 1fr;
            }

            .career-title {
                font-size: 2rem;
            }

            .branch-card {
                animation: none;
            }
        }
    </style>
@endsection

@section('content')
<div class="branches-container">
    <div class="header">
        <a href="{{ url()->previous() }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            <span>Volver</span>
        </a>
        <button class="theme-toggle">
            <i class="fas fa-sun"></i>
        </button>
    </div>

    <h1 class="career-title">Ramas de {{ $carrera }}</h1>

    <div class="branches-grid">
        @foreach($branches as $branch)
            <div class="branch-card">
                <i class="{{ $branch['icon'] }} branch-icon"></i>
                <h3 class="branch-title">{{ $branch['title'] }}</h3>
                <p class="branch-description">{{ $branch['description'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
    const themeToggle = document.querySelector('.theme-toggle');
    const themeIcon = themeToggle.querySelector('i');
    const html = document.documentElement;

    const savedTheme = localStorage.getItem('theme') || 'dark';
    html.setAttribute('data-theme', savedTheme);
    themeIcon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';

    themeToggle.addEventListener('click', () => {
        const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-theme', newTheme);
        themeIcon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        localStorage.setItem('theme', newTheme);
    });
</script>
@endsection