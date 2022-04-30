@extends('layouts.app')

@section('title')
    MVO Intranet | Équipe
@endsection

@section('content')

    <h1 class="text-center">Mon équipe</h1>
    <div class="main__content container">

        <div id="accordion">

            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                    <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Ajouter un membre
                    </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body" id="form__style">
                        <form action="{{ route('dashboard.storeTeam') }}" method="POST">
                            @csrf
        
                            <div class="form-floating mb-3">
                                <input type="text" id="name" class="form-control" name="prénom" placeholder="Prénom" value="{{ old('prénom') }}">
                                <label for="name">Prénom</label>
        
                                @error('prénom')
                                    <div class="form-control alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <div class="form-floating mb-3">
                                <input type="text" id="nom" class="form-control" name="nom" placeholder="Nom" value="{{ old('nom') }}">
                                <label for="nom">Nom</label>
        
                                @error('nom')
                                    <div class="form-control alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
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
                                <input type="password" id="password" class="form-control" name="mdp" placeholder="Mot de passe">
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
                        </form>

                    </div>
                </div>
                </div>

            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Gérer mon équipe
                    </button>
                </h5>
                </div>
            
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div>
                            
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                @if ($users->isEmpty())
                                    <div>
                                        <div class="alert alert-dark" role="alert">
                                            Aucun membre n'a été trouvé
                                        </div>
                                    </div>
                                @else
                                    <table class="table caption-top">
                                        <thead>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Prénom</th>
                                            <th scope="col">Email</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $key => $user)
                                                @if ($user->disable === NULL)
                                                    <tr>
                                                            <td class="align-middle"></td>
                                                            <td class="align-middle"><?= $user->last_name ?></td>
                                                            <td class="align-middle"><?= $user->first_name ?></td>
                                                            <td class="align-middle"><?= $user->email ?></td>
                                                            <td><a href="equipe/<?= $user->id ?>" class="btn btn-primary">Modifier</a></td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary id" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="<?= $user->id ?>">
                                                                    Supprimer
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @else 
                                                    <tr class="disable">
                                                        <td class="align-middle"></td>
                                                        <td class="align-middle"><?= $user->last_name ?></td>
                                                        <td class="align-middle"><?= $user->first_name ?></td>
                                                        <td class="align-middle"><?= $user->email ?></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $users->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade modalDelete" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez-vous supprimer ce membre ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                        
                        <form class="delete_buttons_form" action="" method="post">
                            @csrf

                            @method('DELETE')

                            <button type="submit" class="btn btn-primary">Oui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <script>

        // Delete 
        const butonsId = document.querySelectorAll("button[type=button].id");
        const modalForm = document.querySelector(".modalDelete .modal-footer>button+form");

        console.log(modalForm);
        
        butonsId.forEach(butonId => {
            butonId.addEventListener('click', () => {
                modalForm.setAttribute("action", `http://localhost:8000/equipe/${butonId.dataset.id}`);
            });
        });

    </script>
@endsection