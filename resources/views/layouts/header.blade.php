

    <nav class="navbar navbar-expand-lg navbar-light bg-light" aria-orientation="vertical">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                @endguest

                @auth
                
                <!-- SUPER ADMIN -->
                @if (auth()->user()->authorisation === '1')
                    <a class="nav-link" href="{{ route('dashboard.createTeam') }}">
                        Mon équipe
                    </a>
                @endif
        
                @if (auth()->user()->authorisation === '1' || auth()->user()->authorisation === '2')
        
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.createLearner') }}">
                            Les salariés
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route('company.createCompany') }}">
                            Les entreprises
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('session.createSession') }}">
                            Les sessions
                        </a>
                    </li>
        
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('formation.createFormation') }}">
                            Nos formations
                        </a>
                    </li>
                    <hr>
                @endif
            @endauth
        
            @auth
                <a class="nav-link" href="{{ route('user.logout') }}">Deconnexion</a>
            @endauth
        </div>
    </nav>


