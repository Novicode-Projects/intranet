@extends('layouts.app')

@section('title')
    MVO Intranet | Nouveau mot de passe
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
        <h1 class="text-center">Nouveau mot de passe</h1>
        
        <div class="main__form d-flex justify-content-center align-items-center">

            <form method="POST" action="{{ route('user.updatePassword') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-floating mb-3">
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required>
                    <label for="email">Email</label>

                    @error('email')
                        <div class="form-control alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="password" type="password" name="password" class="form-control"  autocomplete="new-password" placeholder="Nouveau mot de passe" required>
                    <label for="password">Nouveau mot de passe</label>

                    @error('password')
                        <div class="form-control alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirmez votre mot de passe" required>
                    <label for="password-confirm">Confirmez votre mot de passe</label>
                </div>

            <div class="vstack gap-2 col-md-5 mx-auto">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>

@endsection

