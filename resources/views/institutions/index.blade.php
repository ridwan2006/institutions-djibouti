<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logos/djiblogo.svg') }}">
    <title>Annuaire des Institutions - République de Djibouti</title>
    <link rel="stylesheet" href="{{ asset('css/institutions.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCL_p0P7jCmuLMEJCnHKtF-OvAMZBfxLt4&libraries=places&callback=initMap"></script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="nav-brand">
                    <img src="{{ asset('images/logos/djiblogo.svg') }}" alt="République de Djibouti" class="nav-logo">
                    <span class="nav-title">Institutions Djibouti</span>
                </div>
                <div class="nav-links">
                    <a href="#accueil" class="nav-link active">Accueil</a>
                    <a href="#institutions" class="nav-link">Institutions</a>
                    <a href="#carte" class="nav-link">Carte</a>
                    <a href="#contact" class="nav-link" onclick="scrollToSection('contact')">Contact</a>
                </div>
                <button class="nav-toggle" id="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Section Hero -->
    <section class="hero" id="accueil">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <div class="hero-badge">
                        <i data-feather="map-pin"></i>
                        <span>République de Djibouti</span>
                    </div>
                    <h1 class="hero-title">
                        Découvrez les
                        <span class="hero-highlight">Institutions</span>
                        de Djibouti
                    </h1>
                    <p class="hero-subtitle">
                        Votre guide complet pour naviguer dans l'administration publique djiboutienne. 
                        Accédez aux coordonnées, horaires et services de toutes les institutions gouvernementales.
                    </p>
                    <div class="hero-actions">
                        <button class="hero-cta hero-cta-primary" onclick="scrollToSection('search')">
                            <span>Explorer maintenant</span>
                            <i data-feather="arrow-right"></i>
                        </button>
                        <button class="hero-cta hero-cta-secondary" onclick="scrollToSection('carte')">
                            <i data-feather="map"></i>
                            <span>Voir la carte</span>
                        </button>
                    </div>
                </div>
                <div class="hero-stats">
                    <div class="stat-card">
                        <div class="stat-number" id="total-institutions">{{ count($institutions ?? []) }}</div>
                        <div class="stat-label">Institutions</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">15</div>
                        <div class="stat-label">Ministères</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">20</div>
                        <div class="stat-label">Sites web</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Institutions Vedettes -->
    <section class="featured-institutions">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Institutions Principales</h2>
                <p class="section-subtitle">Les trois institutions les plus consultées</p>
            </div>
            
            <div class="featured-grid">
                @if(isset($institutions) && count($institutions) >= 3)
                    @foreach($institutions->take(3) as $institution)
                    <div class="featured-card">
                        <div class="featured-image">
                            @if($institution->logo)
                                <img src="{{ asset('storage/' . $institution->logo) }}" alt="{{ $institution->name }}">
                            @else
                                <div class="featured-placeholder">
                                    <i data-feather="building"></i>
                                </div>
                            @endif
                            <div class="featured-badge">
                                <span class="badge badge-{{ strtolower(str_replace(' ', '-', $institution->type)) }}">
                                    {{ $institution->type }}
                                </span>
                            </div>
                        </div>
                        <div class="featured-content">
                            <h3 class="featured-title">{{ $institution->name }}</h3>
                            <div class="featured-info">
                                <div class="info-item">
                                    <i data-feather="map-pin"></i>
                                    <span>{{ Str::limit($institution->address, 30) }}</span>
                                </div>
                                <div class="info-item">
                                    <i data-feather="clock"></i>
                                    <span>{{ $institution->hours ?? '8h-13h et 14h-17h' }}</span>
                                </div>
                                <div class="info-item">
                                    <i data-feather="phone"></i>
                                    <span>{{ $institution->phone }}</span>
                                </div>
                            </div>
                            <div class="featured-actions">
                                <button 
                                    class="btn-primary btn-details"
                                    data-name="{{ $institution->name }}"
                                    data-type="{{ $institution->type }}"
                                    data-email="{{ $institution->email }}"
                                    data-phone="{{ $institution->phone }}"
                                    data-address="{{ $institution->address }}"
                                    data-hours="{{ $institution->hours ?? '8h-13h et 14h-17h' }}"
                                    data-website="{{ $institution->website ?? '' }}"
                                    data-description="{{ $institution->description ?? '' }}"
                                    onclick="openInstitutionModal(this.dataset)"
                                >
                                    Voir détails
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Données d'exemple -->
                    <div class="featured-card">
                        <div class="featured-image">
                            <div class="featured-placeholder">
                                <i data-feather="building"></i>
                            </div>
                            <div class="featured-badge">
                                <span class="badge badge-ministère">Ministère</span>
                            </div>
                        </div>
                        <div class="featured-content">
                            <h3 class="featured-title">Ministère de l'Économie et des Finances</h3>
                            <div class="featured-info">
                                <div class="info-item">
                                    <i data-feather="map-pin"></i>
                                    <span>Cité ministérielle BP13, Djibouti</span>
                                </div>
                                <div class="info-item">
                                    <i data-feather="clock"></i>
                                    <span>8h-13h et 14h-17h</span>
                                </div>
                                <div class="info-item">
                                    <i data-feather="phone"></i>
                                    <span>+253 21 32 51 05</span>
                                </div>
                            </div>
                            <div class="featured-actions">
                                <button 
                                    class="btn-primary btn-details"
                                    data-name="Ministère de l'Économie et des Finances chargé de l'Industrie"
                                    data-type="Ministère"
                                    data-email="cabinet@economie.gouv.dj"
                                    data-phone="+253 21 32 51 05"
                                    data-address="Cité ministérielle BP13, Djibouti"
                                    data-hours="8h-13h et 14h-17h"
                                    data-website="https://economie.gouv.dj/"
                                    data-description="Chargé de piloter l'économie nationale, ce ministère élabore la stratégie économique à court, moyen et long terme, en vue de la vision 2035."
                                    onclick="openInstitutionModal(this.dataset)"
                                >
                                    Voir détails
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="featured-card">
                        <div class="featured-image">
                            <div class="featured-placeholder">
                                <i data-feather="shield"></i>
                            </div>
                            <div class="featured-badge">
                                <span class="badge badge-ministère">Ministère</span>
                            </div>
                        </div>
                        <div class="featured-content">
                            <h3 class="featured-title">Ministère de l'Intérieur</h3>
                            <div class="featured-info">
                                <div class="info-item">
                                    <i data-feather="map-pin"></i>
                                    <span>Place du 27 Juin, Djibouti</span>
                                </div>
                                <div class="info-item">
                                    <i data-feather="clock"></i>
                                    <span>8h-13h et 14h-17h</span>
                                </div>
                                <div class="info-item">
                                    <i data-feather="phone"></i>
                                    <span>+253 21 35 25 42</span>
                                </div>
                            </div>
                            <div class="featured-actions">
                                <button 
                                    class="btn-primary btn-details"
                                    data-name="Ministère de l'Intérieur"
                                    data-type="Ministère"
                                    data-email="contact@interieur.gouv.dj"
                                    data-phone="+253 21 35 25 42"
                                    data-address="Place du 27 Juin, Djibouti"
                                    data-hours="8h-13h et 14h-17h"
                                    data-website="https://interieur.gouv.dj/"
                                    data-description="Responsable de la sécurité intérieure, de l'administration territoriale et de la gestion des collectivités locales."
                                    onclick="openInstitutionModal(this.dataset)"
                                >
                                    Voir détails
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="featured-card">
                        <div class="featured-image">
                            <div class="featured-placeholder">
                                <i data-feather="heart"></i>
                            </div>
                            <div class="featured-badge">
                                <span class="badge badge-ministère">Ministère</span>
                            </div>
                        </div>
                        <div class="featured-content">
                            <h3 class="featured-title">Ministère de la Santé</h3>
                            <div class="featured-info">
                                <div class="info-item">
                                    <i data-feather="map-pin"></i>
                                    <span>Avenue Mahamoud Harbi, Djibouti</span>
                                </div>
                                <div class="info-item">
                                    <i data-feather="clock"></i>
                                    <span>8h-13h et 14h-17h</span>
                                </div>
                                <div class="info-item">
                                    <i data-feather="phone"></i>
                                    <span>+253 21 35 19 31</span>
                                </div>
                            </div>
                            <div class="featured-actions">
                                <button 
                                    class="btn-primary btn-details"
                                    data-name="Ministère de la Santé"
                                    data-type="Ministère"
                                    data-email="contact@sante.gouv.dj"
                                    data-phone="+253 21 35 19 31"
                                    data-address="Avenue Mahamoud Harbi, Djibouti"
                                    data-hours="8h-13h et 14h-17h"
                                    data-website="https://sante.gouv.dj/"
                                    data-description="Responsable de la politique de santé publique, de la gestion des hôpitaux et centres de santé."
                                    onclick="openInstitutionModal(this.dataset)"
                                >
                                    Voir détails
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Section Recherche -->
    <section class="search-section" id="search">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Rechercher une Institution</h2>
                <p class="section-subtitle">Trouvez rapidement l'institution que vous cherchez</p>
            </div>
            
            <div class="search-container">
                <div class="search-bar">
                    <div class="search-input-wrapper">
                        <i data-feather="search" class="search-icon"></i>
                        <input 
                            type="text" 
                            id="search-input" 
                            placeholder="Rechercher par nom, type ou description..."
                            class="search-input"
                        >
                        <button class="search-clear" id="search-clear" style="display: none;">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                </div>
                
                <div class="search-filters">
                    <div class="filter-group">
                        <label for="type-filter" class="filter-label">Catégorie</label>
                        <select id="type-filter" class="filter-select">
                            <option value="">Toutes les catégories</option>
                            <option value="ministère">Ministères</option>
                            <option value="administration publique">Administrations Publiques</option>
                            <option value="direction">Directions</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="search-results-info">
                <span id="results-count">Affichage de toutes les institutions</span>
                <button class="results-toggle" id="view-toggle">
                    <i data-feather="grid" id="toggle-icon"></i>
                    <span id="toggle-text">Vue grille</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Section Liste des Institutions -->
    <section class="institutions-section" id="institutions">
        <div class="container">
            <!-- Vue Grille -->
            <div class="institutions-grid" id="institutions-grid">
                @if(isset($institutions) && count($institutions) > 0)
                    @foreach($institutions as $institution)
                    <div class="institution-card" 
                         data-name="{{ strtolower($institution->name) }}" 
                         data-type="{{ strtolower($institution->type) }}"
                         data-description="{{ strtolower($institution->description ?? '') }}">
                        <div class="card-header">
                            <div class="card-logo">
                                @if($institution->logo)
                                    <img src="{{ asset('storage/' . $institution->logo) }}" alt="{{ $institution->name }}">
                                @else
                                    <div class="logo-placeholder">
                                        <i data-feather="building"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-badge">
                                <span class="badge badge-{{ strtolower(str_replace(' ', '-', $institution->type)) }}">
                                    {{ $institution->type }}
                                </span>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">{{ $institution->name }}</h3>
                            <div class="card-info">
                                <div class="info-row">
                                    <i data-feather="mail"></i>
                                    <a href="mailto:{{ $institution->email }}">{{ $institution->email }}</a>
                                </div>
                                <div class="info-row">
                                    <i data-feather="phone"></i>
                                    <a href="tel:{{ $institution->phone }}">{{ $institution->phone }}</a>
                                </div>
                                <div class="info-row">
                                    <i data-feather="map-pin"></i>
                                    <span>{{ Str::limit($institution->address, 40) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button 
                                class="btn-outline btn-details"
                                data-name="{{ $institution->name }}"
                                data-type="{{ $institution->type }}"
                                data-email="{{ $institution->email }}"
                                data-phone="{{ $institution->phone }}"
                                data-address="{{ $institution->address }}"
                                data-hours="{{ $institution->hours ?? '8h-13h et 14h-17h' }}"
                                data-website="{{ $institution->website ?? '' }}"
                                data-description="{{ $institution->description ?? '' }}"
                                onclick="openInstitutionModal(this.dataset)"
                            >
                                Voir détails
                            </button>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="institution-card" data-name="ministère de l'économie" data-type="ministère">
                        <div class="card-header">
                            <div class="card-logo">
                                <div class="logo-placeholder">
                                    <i data-feather="trending-up"></i>
                                </div>
                            </div>
                            <div class="card-badge">
                                <span class="badge badge-ministère">Ministère</span>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">Ministère de l'Économie et des Finances</h3>
                            <div class="card-info">
                                <div class="info-row">
                                    <i data-feather="mail"></i>
                                    <a href="mailto:cabinet@economie.gouv.dj">cabinet@economie.gouv.dj</a>
                                </div>
                                <div class="info-row">
                                    <i data-feather="phone"></i>
                                    <a href="tel:+25321325105">+253 21 32 51 05</a>
                                </div>
                                <div class="info-row">
                                    <i data-feather="map-pin"></i>
                                    <span>Cité ministérielle BP13, Djibouti</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button 
                                class="btn-outline btn-details"
                                data-name="Ministère de l'Économie et des Finances chargé de l'Industrie"
                                data-type="Ministère"
                                data-email="cabinet@economie.gouv.dj"
                                data-phone="+253 21 32 51 05"
                                data-address="Cité ministérielle BP13, Djibouti"
                                data-hours="8h-13h et 14h-17h"
                                data-website="https://economie.gouv.dj/"
                                data-description="Chargé de piloter l'économie nationale, ce ministère élabore la stratégie économique à court, moyen et long terme, en vue de la vision 2035."
                                onclick="openInstitutionModal(this.dataset)"
                            >
                                Voir détails
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Vue Tableau -->
            <div class="institutions-table-container" id="institutions-table-container" style="display: none;">
                <div class="table-wrapper">
                    <table class="institutions-table">
                        <thead>
                            <tr>
                                <th class="sortable" data-column="name">
                                    <span>Nom</span>
                                    <i data-feather="chevrons-up-down" class="sort-icon"></i>
                                </th>
                                <th class="sortable" data-column="type">
                                    <span>Type</span>
                                    <i data-feather="chevrons-up-down" class="sort-icon"></i>
                                </th>
                                <th>Contact</th>
                                <th>Adresse</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="institutions-tbody">
                            @if(isset($institutions) && count($institutions) > 0)
                                @foreach($institutions as $institution)
                                <tr class="institution-row" 
                                    data-name="{{ strtolower($institution->name) }}" 
                                    data-type="{{ strtolower($institution->type) }}"
                                    data-description="{{ strtolower($institution->description ?? '') }}">
                                    <td class="name-cell">
                                        <div class="name-content">
                                            @if($institution->logo)
                                                <img src="{{ asset('storage/' . $institution->logo) }}" alt="{{ $institution->name }}" class="table-logo">
                                            @else
                                                <div class="table-logo-placeholder">
                                                    <i data-feather="building"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="institution-name">{{ $institution->name }}</div>
                                                <div class="institution-description">{{ Str::limit($institution->description ?? '', 60) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ strtolower(str_replace(' ', '-', $institution->type)) }}">
                                            {{ $institution->type }}
                                        </span>
                                    </td>
                                    <td class="contact-cell">
                                        <div class="contact-info">
                                            <a href="mailto:{{ $institution->email }}" class="contact-link">
                                                <i data-feather="mail"></i>
                                                {{ $institution->email }}
                                            </a>
                                            <a href="tel:{{ $institution->phone }}" class="contact-link">
                                                <i data-feather="phone"></i>
                                                {{ $institution->phone }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="address-cell">{{ $institution->address }}</td>
                                    <td class="actions-cell">
                                        <button 
                                            class="btn-sm btn-details"
                                            data-name="{{ $institution->name }}"
                                            data-type="{{ $institution->type }}"
                                            data-email="{{ $institution->email }}"
                                            data-phone="{{ $institution->phone }}"
                                            data-address="{{ $institution->address }}"
                                            data-hours="{{ $institution->hours ?? '8h-13h et 14h-17h' }}"
                                            data-website="{{ $institution->website ?? '' }}"
                                            data-description="{{ $institution->description ?? '' }}"
                                            onclick="openInstitutionModal(this.dataset)"
                                        >
                                            <i data-feather="eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Message aucun résultat -->
            <div class="no-results" id="no-results" style="display: none;">
                <div class="no-results-content">
                    <i data-feather="search" class="no-results-icon"></i>
                    <h3>Aucune institution trouvée</h3>
                    <p>Essayez de modifier vos critères de recherche ou de filtrage</p>
                    <button class="btn-primary" onclick="clearSearch()">Effacer la recherche</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Carte -->
    <section class="map-section" id="carte">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Carte des Institutions</h2>
                <p class="section-subtitle">Localisez toutes les institutions sur la carte interactive</p>
            </div>
            <div id="map"></div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-brand">
                        <img src="{{ asset('images/logos/djiblogo.svg') }}" alt="République de Djibouti" class="footer-logo">
                        <h3>Institutions DJ</h3>
                    </div>
                    <p class="footer-description">
                        Votre guide officiel pour naviguer dans l'administration publique djiboutienne. 
                        Accédez facilement aux informations de toutes les institutions gouvernementales.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i data-feather="facebook"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i data-feather="linkedin"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i data-feather="instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4 class="footer-title">Liens Utiles</h4>
                    <ul class="footer-links">
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#institutions">Institutions</a></li>
                        <li><a href="#carte">Carte</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#">Aide</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4 class="footer-title">Contact</h4>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i data-feather="mail"></i>
                            <a href="mailto:info@institutions.gouv.dj">info@institutions.gouv.dj</a>
                        </div>
                        <div class="contact-item">
                            <i data-feather="phone"></i>
                            <a href="tel:+25321000000">+253 21 00 00 00</a>
                        </div>
                        <div class="contact-item">
                            <i data-feather="map-pin"></i>
                            <span>Djibouti, République de Djibouti</span>
                        </div>
                        <div class="contact-item">
                            <i data-feather="clock"></i>
                            <span>Dim-Jeu: 8h-13h et 14h-17h</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p>&copy; {{ date('Y') }} République de Djibouti. Tous droits réservés.</p>
                    <div class="footer-bottom-links">
                        <a href="#">Mentions légales</a>
                        <a href="#">Politique de confidentialité</a>
                        <a href="#">Accessibilité</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Institution -->
    <div class="modal-overlay" id="institution-modal" style="display: none;">
        <div class="modal-content">
            <button class="modal-close" onclick="closeInstitutionModal()">
                <i data-feather="x"></i>
            </button>
            <div class="modal-header">
                <h2 class="modal-title" id="modal-title">Nom de l'institution</h2>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- Contenu dynamique -->
            </div>
        </div>
    </div>

    <script src="{{ asset('js/institutions.js') }}"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>
