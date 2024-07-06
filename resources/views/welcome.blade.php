<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Système de Gestion de l'Énergie</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        .hero-section {
            background: url('./images/optimiser.png') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 150px 0;
            position: relative;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            animation: fadeInDown 1s;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            animation: fadeInUp 1s;
        }

        .hero-section .btn {
            padding: 10px 30px;
            font-size: 1rem;
            animation: fadeInUp 1s;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
            animation: fadeIn 1s;
        }

        .section-title::after {
            content: '';
            width: 60px;
            height: 4px;
            background: #007bff;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -10px;
        }

        .benefit-item,
        .feature-item,
        .step-item {
            text-align: center;
            margin-bottom: 30px;
            animation: fadeIn 1s;
        }

        .benefit-item img,
        .feature-item img,
        .step-item img {
            max-width: 100px;
            margin-bottom: 20px;
        }

        .benefit-item h5,
        .feature-item h5,
        .step-item h5 {
            font-size: 1.25rem;
            margin-top: 20px;
        }

        .testimonials-section blockquote {
            background: #f8f9fa;
            padding: 20px;
            border-left: 5px solid #007bff;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .footer {
            background: #343a40;
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        .footer a {
            color: white;
            margin: 0 15px;
        }

        .footer-social-icons a {
            color: white;
            margin: 0 10px;
        }

        .footer-contact-info p {
            margin: 5px 0;
        }

        .footer-contact-info i {
            margin-right: 10px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        @media (max-width: 767px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }

            .hero-section p {
                font-size: 1rem;
            }
        }

        @media (max-width: 575px) {
            .navbar-brand img {
                height: 30px;
            }

            .hero-section {
                padding: 100px 0;
            }
        }
        
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="/images/logo.png" alt="logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            @if (Route::has('login'))
            <ul class="navbar-nav ml-auto">
                @auth
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">Tableau de bord</a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Se connecter</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">S'inscrire</a>
                </li>
                @endif
                @endauth
            </ul>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>Gestion de l'Énergie</h1>
            <p>Optimisez votre consommation énergétique avec notre système avancé.</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Commencer</a>
        </div>
    </div>

    <!-- Benefits Section -->
    <div class="benefits-section py-5">
        <div class="container">
            <h3 class="section-title text-center">Avantages</h3>
            <div class="row">
                <div class="col-md-4 benefit-item">
                    <img src="https://img.icons8.com/fluent/100/000000/cost.png" alt="Réduction des coûts" class="img-fluid">
                    <h5>Réduction des coûts</h5>
                    <p>Réduisez vos factures d'énergie avec une consommation optimisée.</p>
                </div>
                <div class="col-md-4 benefit-item">
                    <img src="https://img.icons8.com/?size=100&id=zkSx39Zy9uo2&format=png&color=000000" alt="Efficacité" class="img-fluid">
                    <h5>Efficacité</h5>
                    <p>Identifiez et éliminez le gaspillage d'énergie.</p>
                </div>
                <div class="col-md-4 benefit-item">
                    <img src="https://img.icons8.com/fluent/100/000000/environment.png" alt="Durabilité" class="img-fluid">
                    <h5>Durabilité</h5>
                    <p>Contribuez à un environnement plus vert.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section py-5 bg-light">
        <div class="container">
            <h3 class="section-title text-center">Fonctionnalités</h3>
            <div class="row">
                <div class="col-md-4 feature-item">
                    <img src="https://img.icons8.com/?size=100&id=QEZJbhQEC4OA&format=png&color=000000" alt="Surveillance en temps réel" class="img-fluid">
                    <h5>Surveillance en temps réel</h5>
                    <p>Suivez votre consommation d'énergie en temps réel.</p>
                </div>
                <div class="col-md-4 feature-item">
                    <img src="https://img.icons8.com/fluent/100/000000/report-card.png" alt="Rapports automatisés" class="img-fluid">
                    <h5>Rapports automatisés</h5>
                    <p>Recevez des rapports détaillés de consommation d'énergie.</p>
                </div>
                <div class="col-md-4 feature-item">
                    <img src="https://img.icons8.com/fluent/100/000000/dashboard.png" alt="Tableau de bord convivial" class="img-fluid">
                    <h5>Tableau de bord</h5>
                    <p>Utilise des graphiques et des diagrammes faciles à comprendre.</p>
                    </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="how-it-works-section py-5">
        <div class="container">
            <h3 class="section-title text-center">Comment ça marche</h3>
            <div class="row">
                <div class="col-md-4 step-item">
                    <img src="https://img.icons8.com/fluent/100/000000/sign-up.png" alt="S'inscrire" class="img-fluid">
                    <h5>S'inscrire</h5>
                    <p>Créez un compte pour commencer.</p>
                </div>
                <div class="col-md-4 step-item">
                    <img src="images/connecter.png" alt="Connecter les appareils" class="img-fluid">
                    <h5>Connecter les appareils</h5>
                    <p>Connectez vos appareils consommateurs d'énergie.</p>
                </div>
                <div class="col-md-4 step-item">
                    <img src="https://img.icons8.com/fluent/100/000000/monitor.png" alt="Surveiller" class="img-fluid">
                    <h5>Surveiller</h5>
                    <p>Suivez et optimisez votre consommation d'énergie.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials-section py-5 bg-light">
        <div class="container">
            <h3 class="section-title text-center">Témoignages</h3>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <blockquote class="blockquote text-center">
                        <p class="mb-0">"Le meilleur outil de gestion de l'énergie que nous ayons utilisé !"</p>
                        <footer class="blockquote-footer">Jean Dupont, <cite title="Source Title">Entreprise XYZ</cite></footer>
                    </blockquote>
                    <blockquote class="blockquote text-center">
                        <p class="mb-0">"Nous avons réduit nos coûts énergétiques de 20% en un mois."</p>
                        <footer class="blockquote-footer">Marie Durand, <cite title="Source Title">Société ABC</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>


<!-- Map Section -->
<div class="map-container">
<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3322.98705387232!2d-7.536589124302574!3d33.60564037332841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzPCsDM2JzIwLjMiTiA3wrAzMicwMi41Ilc!5e0!3m2!1sfr!2sma!4v1718030365243!5m2!1sfr!2sma" width="1500" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>





    <!-- Footer -->
    <footer class="footer bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-social-icons mb-4">
                        <a href="https://www.facebook.com/Lab4SysFr" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/Lab4Sys" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/lab4sys/?hl=fr" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/lab4sys/about/" class="social-icon" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="footer-contact-info">
                        <p><i class="fas fa-envelope"></i> contact@lab4sys.ma</p>
                        <p><i class="fas fa-phone"></i> +212 5 22 35 27 26</p>
                    </div>
                </div>
                <div class="col-md-6 text-md-right">
                    <p class="mb-4">&copy; 2024 Système de Gestion de l'Énergie. Tous droits réservés.</p>
    </footer>
