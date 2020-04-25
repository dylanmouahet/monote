@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('/css/project.css') }}">

    <style>

    </style>
@endpush

@section('content')
<div class="container animated fadeInUp">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Langage</h6>
                    <h2 class="text-right"><i class="fa fa-code f-left"></i><span>{{ $language->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Logiciel</h6>
                    <h2 class="text-right"><i class="fa fa-laptop-code f-left"></i><span>{{ $software->count() }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Framework</h6>
                    <h2 class="text-right"><i class="fa fa-code-branch f-left"></i><span>{{ $framework->count() }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Autre</h6>
                    <h2 class="text-right"><i class="fa fa-terminal f-left"></i><span>{{ $other->count() }}</span></h2>
                </div>
            </div>
        </div>
    </div>
</div>
    <div style="margin-top: 30px;">

    </div>

    <div class="col-md-12 animated fadeInUp">
        <div class="card card-plain">
            <div class="card-header card-header-primary">
                <h4 class="card-title mt-0"> Liste compétence <button class="btn btn-success float-right" data-toggle="modal" data-target="#add_expertise_form">Ajouter <i class='fas fa-plus'></i></button> </h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped display" id="table_expertise" style="text-align:center;"><font></font>
                        <thead class="table-info"><font></font>
                            <th style="font-weight:bold; color:purple;">Nom</th><font></font>
                            <th style="font-weight:bold; color:purple;">Type</th><font></font>
                            <th style="font-weight:bold; color:purple;">Categorie</th><font></font>
                            <th style="font-weight:bold; color:purple;">Niveau</th><font></font>
                            <th style="font-weight:bold; color:purple;">Ajouté le</th><font></font>
                            <th style="font-weight:bold; color:purple;">Action</th><font></font>
                        </thead><font></font>
                        <tbody><font></font>
                            <tr style="cursor:pointer;"><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                            </tr><font></font>
                        </tbody><font></font>
                    </table><font></font>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('footer')


    <script>

        var data =
            [
                @foreach ($expertises as $expertise)
                    [
                        "{{ $expertise->name }}",
                        "{{ set_correct_translate_type($expertise->type) }}",
                        "{{ $expertise->category }}",
                        "{{ $expertise->level }}",
                        "{{ $expertise->created_at->format('d/m/Y') }}",
                        "{!!
                             "<button class='btn btn-sm btn-success' data-toggle='modal' data-target='#view".$expertise->id."' data-placement='top' data-toggle='tooltip' title='Détails'><i class='fas fa-eye'></i></button>".
                             "<button class='btn btn-sm btn-info' data-toggle='modal' data-target='#edit".$expertise->id."' data-placement='top' data-toggle='tooltip' title='Editer'><i class='fas fa-pen'></i></button>"
                        !!}",
                    ],
                @endforeach

            ]

        $(document).ready(function() {
            $('#table_expertise').DataTable( {
                data: data
            } );
        } );
    </script>
@endsection


<!-- Modal List -->

    <!-- Add expertise form Modal -->
    <div class="modal fade" id="add_expertise_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Ajouter une compétence</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="{{ route('expertise.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{old('name')}}" required>
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
                                    <option value="Language">
                                        Langage
                                    </option>
                                    <option value="Software">
                                        Logiciel
                                    </option>
                                    <option value="Framework">
                                        Framework
                                    </option>
                                    <option value="Other">
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
                                <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}" required>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="level">Niveau</label>
                            <input type="range" name="level" id="level" class="form-control @error('level') is-invalid @enderror" value="{{ old('level') }}" required>
                            @error('level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add expertise form Modal -->

    <!-- Details expertise Modal -->
    @foreach ($expertises as $expertise)
        <div class="modal fade" id="view{{$expertise->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$expertise->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Détail compétence</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Nom :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$expertise->name}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Description :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$expertise->description}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Type :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{set_correct_translate_type($expertise->type)}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Categorie :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$expertise->category}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Date ajout :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$expertise->created_at->format('d/m/Y')}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Dernière modification :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$expertise->updated_at->format('d/m/Y')}}</span>
                                </div>
                            </div>
                            <b> Niveau :</b>
                            <div class="progress">
                                <div class="progress-bar bg-{{ set_progress_level($expertise->level) }}" role="progressbar" style="width: {{$expertise->level}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form
                            action="{{ route('expertise.destroy', $expertise->id) }}"
                            method="POST"
                            id="expertise-delete-form{{$expertise->id}}"
                        >
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-danger" onclick="{{ alert_confirm('expertise-delete-form'.$expertise->id) }}">
                                Supprimer
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- End details step Modal -->

    <!-- Edit step Modal -->
    @foreach ($expertises as $expertise)
        <div class="modal fade" id="edit{{$expertise->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabelll{{$expertise->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Modifier une compétence</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <form action="{{ route('expertise.update', $expertise->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field("PUT") }}
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{old('name') ?: $expertise->name}}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description">Description <span class="text-muted">(Optionnel)</span></label>
                                <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') ?: $expertise->description }}</textarea>
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
                                        <option value="Language" {{set_correct_select($expertise->type, "Language")}}>
                                            Langage
                                        </option>
                                        <option value="Software" {{set_correct_select($expertise->type, "Software")}}>
                                            Logiciel
                                        </option>
                                        <option value="Framework" {{set_correct_select($expertise->type, "Framework")}}>
                                            Framework
                                        </option>
                                        <option value="Other" {{set_correct_select($expertise->type, "Other")}}>
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
                                    <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') ?: $expertise->category}}" required>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="level">Niveau</label>
                                <input type="range" name="level" id="level" class="form-control @error('level') is-invalid @enderror" value="{{ old('level') ?: $expertise->level }}" required>
                                @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <!-- End Edit step Modal -->
