@extends('layouts.app')

@section('title')
    MVO Intranet | Mot de passe oublié
@endsection

@section('content')

    <style>
        
        input {
            width: 400px !important;
        }

        @media screen and (orientation: portrait) {

            input {
                width: 250px !important;
            }
        }
    </style>
    
    <div class="main__content container">
        <h1 class="text-center">Mot de passe oublié</h1>
        <div class="main__form d-flex flex-column justify-content-center align-items-center">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('user.postEmail') }}">
                @csrf

                <div class="form-floating mb-3">
                    <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Entrez votre adresse email">
                    <label for="email">Entrez votre adresse email</label>
            
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="vstack gap-2 col-md-5 mx-auto">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>

            </form>
        </div>
    </div>

@endsection

