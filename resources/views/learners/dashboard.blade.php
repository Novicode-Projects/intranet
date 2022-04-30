@extends('../layouts.app')

@section('title')
    MVO Intranet | Dashboard
@endsection

@section('content')

    <div>
        <h1 class="text-center">Tableau de bord</h1>
    </div>
    
    <div class="main__content container d-flex justify-content-center">
        @if (auth()->user())
            <article class="alert alert-success text-center">
                <span>Bienvenue {{ auth()->user()->first_name . " " . auth()->user()->last_name}} dans votre espace membre</span>
            </article>
        @endif
    </div>

    <div class="main__content container d-flex justify-content-center">
    <div>
        @foreach ($sessions as $key => $session)
            <div id="accordion">

                <div class="card">
                    <div class="card-header" id="heading{{ $key }}">
                        <h5 class="mb-0">
                            <button class="btn collapsed" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="<?= ($key == 0) ? 'true' : 'false'?>" aria-controls="collapse{{ $key }}">
                                Session du {{ date('d/m/Y', strtotime($session->date_start)) }} au {{ date('d/m/Y', strtotime($session->date_end)) }} | {{ $session->wording }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{ $key }}" class="collapse <?= ($key == 0) ? 'show' : ''?>" aria-labelledby="heading{{ $key }}" data-parent="#accordion">
                        <div class="card-body" id="form__style">
                            <table class="table caption-top">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Fichiers</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody>
                                    @foreach ($pdfs as $key2 => $pdf)
                                        <tr>
                                            @if ($pdf->id_session == $session->id)
                                                <td class="align-middle"></td>
                                                <td class="align-middle"><a href="{{ asset('pdf/'. $pdf->url_pdf) }}" target="blanck_">Pdf</a></td>
                                            @else
                                                
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>

@endsection