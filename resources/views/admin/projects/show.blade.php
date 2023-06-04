@extends('layouts.admin')

@section('content')

<div class="container py-5">
    <div class="text-center">
        <img src="{{asset ('storage/' . $project->cover_image) }}" alt="fnf" class="project-image img-fluid rounded w-50 mb-5 shadow">
    </div>

    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h1 class="display-4 my-4">{{ $project->title }}</h1>
            <h3>Type: {{$project->type->name ?? 'Undefined Type'}}</h3>

            <div class="technologies d-flex justify-content-center flex-wrap py-3">
                @foreach($project->technologies as $item)
                    <span class="badge rounded-pill bg-primary text-white mx-1" style="background-color: {{$item->color}}">{{$item->name}}</span>
                @endforeach
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="card-title text-center">{{ $project->title }}</h3>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Slug:</strong> {{ $project->slug }}
                    </li>
                    <li class="list-group-item">
                        <strong>Content:</strong> {{ $project->content }}
                    </li>
                </ul>

                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-primary">Edit Project</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                    </div>
                    <a href="{{ route('admin.projects.index')}}" class="btn btn-success">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete this project?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to DELETE this project? This Action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="POST" action="{{route('admin.projects.destroy', ['project' => $project->slug])}}" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Confermi di voler cancellare questo elemento dalla libreria? Questa azione non è reversibile')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection