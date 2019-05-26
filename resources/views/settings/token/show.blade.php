@extends('layouts.app')

@section('content')
    <h2 class="text-grey-darkest mb-8 text-3xl"> 
        Generate Token
    </h2>

    <form method="POST" action="/settings/access">
        @method('PATCH')
        @csrf

        <button class="button is-blue">Generate New Access Token</button>
    </form>

    @if (session('message'))
        <p class="text-muted mt-6">{{ session('message') }}</p>
    @endif
@endsection