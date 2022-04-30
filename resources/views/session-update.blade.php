@extends('layouts.app')

@section('title')
    MVO Intranet | {{ $session->nameCompany }} - {{ $session->nameFormation }}
@endsection

@section('content')

    <h1 class="text-center">Entreprise : {{ $session->nameCompany }}</h1>
    <p class="text-center">Formation : {{ $session->nameFormation }} <br> Session du {{ date('d/m/Y', strtotime($session->date_start)) }} au {{ date('d/m/Y', strtotime($session->date_end)) }} </p>

        <div class="main__content container">

            <div id="accordion">
    
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            Ajouter un pdf
                        </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body" id="form__style">
                            <form  action="{{ route('pdf.storePdf', $session->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                    
                                <div class="mb-3">
                                    <input type="file" id="customFile" name="url_pdf" required>
                    
                                    @error('url_logo')
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
    
                <div class="card">
                    <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Gérer les pdf
                        </button>
                    </h5>
                    </div>
                
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div>
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    @if ($pdfs->isEmpty())
                                        <div>
                                            <div class="alert alert-dark" role="alert">
                                                Aucun pdf n'a été trouvé
                                            </div>
                                        </div>
                                    @else
                                        <table class="table caption-top">
                                            <thead>
                                                <th scope="col">#</th>
                                                <th scope="col">Fichiers</th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                            </thead>
                                            <tbody>
                                                @foreach ($pdfs as $key => $pdf)
                                                    <tr>
                                                        <td class="align-middle"></td>
                                                        <td class="align-middle"><a href="{{ asset('pdf/'. $pdf->url_pdf) }}" target="blanck_">Pdf : <?= $key + 1 ?></a></td>
                                                        <td>
                                                            <form class="delete_buttons_form" action="{{ route('pdf.destroyPdf', $pdf->id) }}" method="post">
                                                                @csrf
                                    
                                                                @method('DELETE')
                                    
                                                                <button type="submit" class="btn btn-primary">Supprimer</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Ajouter un salarié
                        </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body" id="form__style">
                            <form action="{{ route('learner.storeLearner', $session->id) }}" method="POST">
                                @csrf
                    
                                <div class="mb-3">

                                    <input class="form-control" list="datalistOptions" id="id_learner" placeholder="Rechercher un salarié" name="id_learner">
                                    <datalist id="datalistOptions">
                                        @foreach ($users as $key => $user)
                                            <option value="<?= $user->id ?>"><?=  $user->last_name . ' ' . $user->first_name  ?></option>
                                        @endforeach
                                    </datalist>
                                </div>
                    
                                @error('id_learner')
                                    <div class="form-control alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                    
                                <div class="vstack gap-2 col-md-5 mx-auto">
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                        <button class="btn collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Gérer les salariés
                        </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body" id="form__style">
                            <table class="table caption-top">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody>
                                    @foreach ($learners as $key => $learner)
                                        <tr>
                                            <td class="align-middle"></td>
                                            <td class="align-middle"><?= $learner->last_name ?></td>
                                            <td class="align-middle"><?= $learner->first_name ?></td>
                                            <td>
                                                <form class="delete_buttons_form" action="{{ route('learner.destroyLearner', $learner->id) }}" method="post">
                                                    @csrf
                        
                                                    @method('DELETE')
                        
                                                    <button type="submit" class="btn btn-primary">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Modal -->
            <div class="modal fade modalDelete" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Voulez-vous supprimer cette formation ?</h5>
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
    
            // Add
            const pcli = document.querySelector("#cli");
            const modalFormb = document.querySelector(".modalMember .modal-footer>button+form");
            
            pcli.addEventListener('click', () => {
                    modalFormb.setAttribute("action", `http://localhost:8000/formation/aaa`);
            });
    
            // Delete 
            const butonsId = document.querySelectorAll("button[type=button].id");
            const modalForm = document.querySelector(".modalDelete .modal-footer>button+form");
            
            butonsId.forEach(butonId => {
                butonId.addEventListener('click', () => {
                    modalForm.setAttribute("action", `http://localhost:8000/formation/${butonId.dataset.id}`);
                });
            });
        </script>
@endsection