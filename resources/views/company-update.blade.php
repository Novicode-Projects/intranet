@extends('layouts.app')

@section('title')
    MVO Intranet | <?= $company->wording ?>
@endsection

@section('content')
    
    <h1 class="text-center"><?= $company->wording ?></h1>
    <div class="main__content container d-flex justify-content-center">

        <div class="main__form container-fluid">
            <h2 class="text-center">Modifier une entreprise</h2>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <form action="{{ route('company.updateCompany', $company->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="wording" placeholder="Nom" value="<?= $company->wording ?>">
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
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection