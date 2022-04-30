@extends('layouts.app')

@section('title')
    MVO Intranet | Sessions
@endsection

@section('content')

    <h1 class="text-center">Les sessions</h1>
    <div class="main__content container">

        <div id="accordion">

            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                    <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Ajouter une session
                    </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body" id="form__style">
                        <form action="{{ route('session.storeSession') }}" method="POST">
                            @csrf
        
                            <div class="form-floating mb-3">
                                <input type="date" id="date-start" class="form-control" name="date_start" placeholder="Date de début" value="{{ old('date_start') }}" required>
                                <label for="date-start">Date de début</label>

                                @error('date_start')
                                    <div class="form-control alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <div class="form-floating mb-3">
                                
                                <input type="date" id="date-end" class="form-control" name="date_end" placeholder="Date de fin" value="{{ old('date_end') }}" required>
                                <label for="date-end">Date de fin</label>
        
                                @error('date_end')
                                    <div class="form-control alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <div class="form-floating mb-3">
                                @if ($formations->isEmpty())
                                    <div>
                                        <div class="alert alert-dark" role="alert">
                                            Aucune formation n'a été trouvée
                                        </div>
                                    </div>
                                @else
                                    <select name="id_formation" id="formation" class="form-select" required>
                                        @foreach ($formations as $key => $formation)
                                            <option value="<?= $formation->id ?>"><?= $formation->wording ?></option>
                                        @endforeach
                                    </select>
                                    <label for="formation">Formation</label>
        
                                    @error('id_formation')
                                        <div class="form-control alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
        
                            <div class="form-floating mb-3">
                                @if ($companies->isEmpty())
                                    <div>
                                        <div class="alert alert-dark" role="alert">
                                            Aucune entreprise n'a été trouvée
                                        </div>
                                    </div>
                                @else
                                    <select name="id_company" id="company" class="form-select" required>
                                        @foreach ($companies as $key => $company)
                                            <option value="<?= $company->id ?>"><?= $company->wording ?></option>
                                        @endforeach
                                    </select>
                                    <label for="company">Entreprise</label>
        
                                    @error('id_company')
                                        <div class="form-control alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                @endif
                            </div>
        
                            <div class="vstack gap-2 col-md-5 mx-auto">
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>

            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Gérer les sessions
                    </button>
                </h5>
                </div>
            
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div>
                            
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                @if ($sessions->isEmpty())
                                    <div>
                                        <div class="alert alert-dark" role="alert">
                                            Aucune session n'a été trouvée
                                        </div>
                                    </div>
                                @else
                                    <table class="table caption-top">
                                        <thead>
                                            <th scope="col">#</th>
                                            <th scope="col">Début</th>
                                            <th scope="col">Fin</th>
                                            <th scope="col">Formation</th>
                                            <th scope="col">Entreprise</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessions as $key => $session)
                                                @if ($session->disable === NULL)
                                                    <tr>
                                                        <td class="align-middle"></td>
                                                        <td class="align-middle"><?= date('d/m/Y', strtotime($session->date_start)) ?></td>
                                                        <td class="align-middle"><?= date('d/m/Y', strtotime($session->date_end)) ?></td> 
                                                        <td class="align-middle"><?= $session->nameFormation ?></td>
                                                        <td class="align-middle"><?= $session->nameCompany ?></td>
                                                        <td><a href="sessions/<?= $session->id ?>" class="btn btn-primary">Modifier</a></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary id" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="<?= $session->id ?>">
                                                                Supprimer
                                                            </button>
                                                        </td>
                                                    @else 
                                                    <tr class="disable">
                                                        <td class="align-middle"></td>
                                                        <td class="align-middle"><?= $session->date_start ?></td>
                                                        <td class="align-middle"><?= $session->date_end ?></td>
                                                        <td class="align-middle"><?= $session->nameFormation ?></td>
                                                        <td class="align-middle"><?= $session->nameCompany ?></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $sessions->links() }}
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
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez-vous supprimer cette session ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                        
                        <form id="formTarget" class="delete_buttons_form" action="" method="post">
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
        const modalForm = document.querySelector("#formTarget");
        
        butonsId.forEach(butonId => {
            butonId.addEventListener('click', () => {
                modalForm.setAttribute("action", `http://localhost:8000/sessions/${butonId.dataset.id}`);
            });
        });

    </script>
@endsection