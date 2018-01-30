@extends('layout.master')

@section('content')

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$repo->name}}</li>
            </ol>
        </nav>

        <div class="card mb-3">
            <div class="card-header">
                <h2>{{$repo->name}}</h2>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>{{$repo->description}}</p>
                </blockquote>
                <ul class="list-group">
                    <li class="list-group-item">Repo ID: {{$repo->repo_id}}</li>
                    <li class="list-group-item">Created Date: {{$repo->created_at}}</li>
                    <li class="list-group-item">Number of Stars: {{$repo->stars}}</li>
                    <li class="list-group-item">Gihub Url: <a target="_blank" href="{{$repo->url}}">{{$repo->url}}</a></li>
                </ul>
            </div>
            <div class="card-footer text-muted">
                Last Updated at {{$repo->last_push_date}}
            </div>
        </div>

    </div>



@endsection