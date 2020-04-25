@extends('layouts.app')
@push('style')
    <style>
        label{
            color: #9c27b0;
            font-weight:bold;
        }
    </style>
@endpush

@section('content')
<hr>
<div class="row animated fadeInUp">
        <div class="col-md-10 offset-md-1">
            <h1 class="text-info text-uppercase font-weight-bold"> Ajouter une formation </h1>
            <div class="jumbotron" style="background:white;">

                <form class="needs-validation" action="{{ route('learning.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="name">Nom de le formation</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description">Description <span class="text-muted">(Optionnel)</span></label>
                        <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type">Type</label>
                            <select class="custom-select d-block w-100 @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value=""> -- Selectionner -- </option>
                                <option value="Video">Video</option>
                                <option value="Audio">Audio</option>
                                <option value="PDF">PDF</option>
                                <option value="Online">En ligne</option>
                                <option value="Other">Autre</option>
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category">Categorie</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{old('category')}}" placeholder="Ex: Développement web, Base de données Hacking..." required>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="chapter">Nombre de chapitre</label>
                        <input type="number" name="chapter" id="chapter" class="form-control @error('chapter') is-invalid @enderror" value="{{ old('chapter') }}" required>
                        @error('chapter')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="teacher">Nom du formateur <span class="text-muted">(Optionnel)</span></label>
                        <input type="text" name="teacher" id="teacher" class="form-control @error('teacher') is-invalid @enderror" value="{{ old('teacher') }}">
                        @error('teacher')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="source">Source <span class="text-muted">(Optionnel)</span></label>
                        <input type="text" class="form-control @error('source') is-invalid @enderror" id="source" value="{{old('source')}}" name="source" placeholder="Ex: Video2brain, Openclassrooms...">
                        @error('source')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="url">Url <span class="text-muted">(Optionnel)</span></label>
                        <input type="url" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{old('url')}}" placeholder="Ex: http://Video2brain.com">
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status">Statut </label>
                        <select class="custom-select d-block w-100 @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Pending">En attente</option>
                            <option value="In process">En cours</option>
                            <option value="Finished">Terminé</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <hr class="mb-4">

                <button class="btn btn-primary btn-lg btn-block" type="submit">Ajouter une formation</button>
            </form>

            </div>
        </div>

    </div>
@endsection
