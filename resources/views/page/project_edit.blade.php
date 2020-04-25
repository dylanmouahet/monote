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
            <h1 class="text-info text-uppercase font-weight-bold"> Editer un projet </h1>
            <div class="jumbotron" style="background:white;">

                <form class="needs-validation" action="{{ route('project.update', $project->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field("PUT") }}
                    <div class="mb-3">
                        <label for="name">Nom du projet</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ old('name')?: $project->name }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description">Description <span class="text-muted">(Optionnel)</span></label>
                        <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description')?: $project->description }}</textarea>
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
                                <option value="Professionnal" {{set_correct_select($project->type, "Professionnal")}}>
                                    Professionnel
                                </option>
                                <option value="Personal" {{set_correct_select($project->type, "Personal")}}>
                                    Personnel
                                </option>
                                <option value="TP" {{set_correct_select($project->type, "TP")}}>
                                    Traveaux pratique
                                </option>
                                <option value="other" {{set_correct_select($project->type, "other")}}>
                                    Autre
                                </option>
                            </select>
                            @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category">Categorie</label>
                            <select class="custom-select d-block w-100 @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value=""> -- Selectionner -- </option>
                                <option value="Software" {{set_correct_select($project->category, "Software")}}>
                                    Logiciel
                                </option>
                                <option value="Website" {{set_correct_select($project->category, "Website")}}>
                                    Site web
                                </option>
                                <option value="Web app" {{set_correct_select($project->category, "Web app")}}>
                                    Application web
                                </option>
                                <option value="Mobile app" {{set_correct_select($project->category, "Mobile app")}}>
                                    Application mobile
                                </option>
                                <option value="Other" {{set_correct_select($project->category, "Other")}}>
                                    Autre
                                </option>
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="step">Nombre d'étape</label>
                        <input type="number" name="step" id="step" class="form-control @error('step') is-invalid @enderror" value="{{ old('step')?: $project->step }}" required>
                        @error('step')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="client">Nom du client</label>
                        <input type="text" name="client" id="client" class="form-control @error('client') is-invalid @enderror" value="{{ old('client')?: $project->client }}" required>
                        @error('client')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date_start">Date début </label>
                        <input type="date" name="date_start" id="date_start" class="form-control @error('date_start') is-invalid @enderror" value="{{ old('date_start')?: $project->date_start->format('Y-m-d') }}"  {{old('date_start')}} required>
                        @error('date_start')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="date_end">Date fin </label>
                        <input type="date" name="date_end" id="date_end" class="form-control @error('date_end') is-invalid @enderror" value="{{ old('date_end')?: $project->date_end->format('Y-m-d') }}" required>
                        @error('date_end')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="deadline">Date limite </label>
                        <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline')?: $project->deadline->format('Y-m-d') }}" required>
                        @error('deadline')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Statut </label>
                        <select class="custom-select d-block w-100 @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Pending" {{set_correct_select($project->status, "Pending")}}>En attente</option>
                            <option value="In process" {{set_correct_select($project->status, "In process")}}>En cours</option>
                            <option value="Finished" {{set_correct_select($project->status, "Finished")}}>Terminé</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="version">Version</label>
                        <input type="text" name="version" id="version" class="form-control @error('version') is-invalid @enderror" value="{{ old('version')?: $project->version }}" required>
                        @error('version')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>


                <hr class="mb-4">

                <button class="btn btn-primary btn-lg btn-block" type="submit">Enregistrer la modification</button>
            </form>

            </div>
        </div>

    </div>
@endsection
