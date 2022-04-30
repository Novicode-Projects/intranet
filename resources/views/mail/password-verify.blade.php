<!doctype html>
<html lang="fr">
    <head>
        <title>Nouveau mot de passe</title>
        <meta charset="utf-8">
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>

        <style>

            * {
                margin: 0;
                padding: 0;
                font-family: system-ui,"-apple-system","Segoe UI","Roboto","Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            }

            h1 {
                margin-bottom: 30px;
                padding-top: 20px;
                text-align: center;
            }

            a {
                color: #0080ff !important;
            }

            a:hover {
                cursor: pointer;
                text-decoration: none;
            }

            .body__content {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

        </style>

        <div class="body__content"> 

            <h1>MVO Formation</h1>
            <p>Vous avez fait une demande de réinitialisation du mot de passe</p>

            <p>Pour renouveler votre mot de passe:
                <a href="{{ route('user.resetPassword', $token) }}">Cliquez ici !</a>
            </p>
        
            <div class="card-body">
                    
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
