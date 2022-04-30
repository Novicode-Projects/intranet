@extends('layouts.app')

@section('title')
    MVO Intranet | Dashboard
@endsection

@section('content')

    <div>
        <h1 class="text-center">Dashboard</h1>
        @if (auth()->user())
            <article class="alert alert-success text-center">
                <span>Bienvenue {{ auth()->user()->first_name . " " . auth()->user()->last_name}}</span>
            </article>
        
            @if (auth()->user()->authorisation === '1')

            @endif
        @endif
    </div>

@endsection