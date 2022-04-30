@extends('layouts.app')

@section('title')
    MVO Intranet | <?= $user->first_name . " " . $user->last_name ?>
@endsection

@section('content')
    
    <h1 class="text-center"><?= $user->first_name . " " . $user->last_name ?></h1>
    
    <div class="main__content container d-flex justify-content-center">

        <div class="main__form container-fluid">
            <h2 class="text-center">Modifier un membre</h2>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <form action="{{ route('dashboard.updateTeam', $user->id) }}" method="POST">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="prenom" name="prénom" placeholder="Prénom" value="<?= $user->first_name ?>">
                        <label for="prenom">Prénom</label>

                        @error('prénom')
                            <div class="form-control alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?= $user->last_name ?>">
                        <label for="nom">Nom</label>

                        @error('nom')
                            <div class="form-control alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Adresse email" value="<?= $user->email ?>">
                        <label for="email">Email</label>

                        @error('email')
                            <div class="form-control alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="vstack gap-2 col-md-5 mx-auto">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection