@extends('layouts.app')

@section('title')
    MVO Intranet | Entreprises
@endsection

@section('content')

    <h1 class="text-center">Les entreprises</h1>
    <div class="main__content container">

        <div id="accordion">

            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                    <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Ajouter une entreprise
                    </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body" id="form__style">
                        <form action="{{ route('company.storeCompany') }}" method="POST" enctype="multipart/form-data">
                            @csrf
        
                            <div class="form-floating mb-3">
                                <input type="text" id="name" class="form-control" name="wording" placeholder="Nom" value="{{ old('wording') }}" required>
                                <label for="name">Nom</label>

                                @error('wording')
                                    <div class="form-control alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <div class="form-floating mb-3">
                                <input type="file" id="customFile" name="url_logo">
        
                                @error('url_logo')
                                    <div class="form-control alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <div class="vstack gap-2 col-md-5 mx-auto">
                                <button type="submit" class="btn btn-primary" name="add">Envoyer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Gérer les entreprises
                        </button>
                    </h5>
                </div>
                

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <div>
                            
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                @if ($companies->isEmpty())
                                    <div>
                                        <div class="alert alert-dark" role="alert">
                                            Aucune entreprise n'a été trouvée
                                        </div>
                                    </div>
                                @else
                                    <div class="table__div">
                                        <table class="table caption-top">
                                            <thead>
                                                <th scope="col">#</th>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Logo</th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                            </thead>
                                            <tbody>
                                                @foreach ($companies as $key => $company)
                                                    @if ($company->disable === NULL)
                                                        <tr>
                                                            <td class="align-middle"></td>
                                                            <td class="align-middle"><?= $company->wording ?></td>
                                                            <td class="align-middle"><img id="img-company-logo" class="img-responsive" src="{{ asset('logo/'. $company->url_logo) }}"></td>
                                                            <td><a href="entreprises/<?= $company->id ?>" class="btn btn-primary">Modifier</a></td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary id" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="<?= $company->id ?>">
                                                                    Supprimer
                                                                </button>
                                                            </td>
                                                        @else 
                                                        <tr class="disable">
                                                            <td class="align-middle"></td>
                                                            <td class="align-middle"><?= $company->wording ?></td>
                                                            <td class="align-middle"><img id="img-company-logo" class="img-responsive" src="{{ asset('logo/'. $company->url_logo) }}"></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    {{ $companies->links() }}
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
                        <h5 class="modal-title" id="staticBackdropLabel">Voulez-vous supprimer cette entreprise ?</h5>
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
                modalForm.setAttribute("action", `http://localhost:8000/entreprises/${butonId.dataset.id}`);
            });
        });

    </script>
@endsection