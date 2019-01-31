@extends('layouts.app')

@section('content')
    <form method="POST" action="/projects">
        @csrf        
        <h1 class="heading is-l">Create a Project</h1>

        <div class="field">
            <labl class="label" for="title">Title</labl>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title">
            </div>
        </div>


        <div class="field">
            <labl class="label" for="description">Description</labl>
        
            <div class="control">
                <textarea name="description" class="textarea"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    <form>
@endsection