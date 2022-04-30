<!doctype html>
<html lang="fr">
    <head>
        <title>MVO Intranet | Connexion</title>
        <meta charset="utf-8">
        <meta name="robots" content="noindex">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    
    <body class="container-fluid">
        <style>

            body {
                background-color: white !important;
            }
            
            main {
                display: flex;
                flex-direction: row;
                min-height: 100vh;
                width: 100%;
            }

            h1 {
                margin-bottom: 30px;
                padding-top: 20px;
                text-align: center;
            }

             /* CLASS */
            
            #logo {
                object-fit: cover; 
                width:300px; 
            }

            #banner {
                object-fit: cover; 
                object-position: left;
            }

            .main__content {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 100%;
            }

            .main__content p {
                margin-top: 20px;
            }

            .main__banner {
                width: 100%;
            }

            /* BOOTSTRAP */

            .container-fluid {
                padding: 0;
            }

            .form-control:focus {
                outline: none;
                box-shadow: none;
                border: 2px solid #0080ff !important; 
            }

            .btn {
                outline: none !important;
                background-color: rgba(0, 128, 255, 0.1) !important;
                border: none !important;
                color: #0080ff !important;
                border-radius: 3px;
                font-size: 14px;
                padding: 6px 12px;
                box-shadow: none !important;
            }

            .btn:hover {
                background-color: #0080ff !important;
                border: none;
                color: #ffffff !important;
            }


            @media screen and (orientation: portrait) {  
                .main__banner {
                    display: none;
                }
            }

        </style>
        <main>

                <div class="main__content">
                    <div class="text-black">
                        <div>
                            <div>
                                <img src="{{ asset('img/logo-mvo.png') }}" alt="Logo MVO" id="logo">
                            </div>

                            <h1>Connexion</h1>

                            <div class="d-flex  justify-content-center">
                                <form action="{{ route('user.login') }}" method="POST">
                                    @csrf
                
                                    <div class="form-floating mb-3">
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Adresse email" value="{{ old('email') }}">
                                        <label for="email">Email</label>
                
                                        @error('email')
                                            <div class="form-control alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                
                                    <div class="form-floating mb-3">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Mot de passe">
                                        <label for="password">Mot de passe</label>
                
                                        @error('mdp')
                                            <div class="form-control alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                
                                    <div class="vstack gap-2 col-md-5 mx-auto">
                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                    </div>

                                    <p class="small mb-5 pb-lg-2"><a class="text-muted" href="{{ route('user.forgotPassword') }}">Mot de passe oublié ?</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            <div class="main__banner">
                <img src="{{ asset('img/banner-mvo.jpg') }}" alt="Banner MVO" id="banner" class="w-100 vh-100">
            </div>
        </main>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
