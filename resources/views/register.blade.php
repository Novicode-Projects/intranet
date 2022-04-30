@extends('layouts.app')

@section('title')
    MVO Intranet | Inscription
@endsection

@section('content')

    <div class="main__content">
        <h1>Inscription</h1>
        <div class="main__form">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="form-floating mb-3">
                    <input type="text" id="name" name="first_name" placeholder="Votre nom" value="{{ old('first_name') }}">
                    <label for="name">Nom</label>

                    @error('first_name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="last_name" placeholder="Votre prénom" value="{{ old('last_name') }}">
                    <label for="last_name">Nom</label>

                    @error('last_name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" placeholder="Votre adresse mail" value="{{ old('email') }}">

                    @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="password" name="password" placeholder="Votre mot de passe">

                    @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    @error('rgpd')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
@endsection