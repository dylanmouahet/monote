@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('/css/project_show.css') }}">
    <style>
        .block{
            display: block;
        }
    </style>
@endpush

@section('content')
    <div class="container animated fadeInUp">
        <div class="row">
            <div class="col-md-9">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
                                        <div class="float-right">
                                            <form
                                                action="{{ route('project.destroy', $project->id) }}"
                                                method="POST"
                                                id="project-delete-form"
                                            >
                                                {{ csrf_field() }}
                                                {{ method_field("DELETE") }}
                                                <a href="{{ route('project.edit', $project->id) }}" class="btn btn-info btn-xs">Editer</a>
                                                <button type="submit" class="btn btn-danger" onclick="{{ alert_confirm('project-delete-form') }}">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                        <h2>{{ $project->name }}</h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                        <span style="font-weight:bold;">Status:</span> <button class="btn btn-sm btn-{{set_status_badge($project->status)}}">{{ set_correct_translate_status($project->status) }}</button>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block" >Type:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ set_correct_translate_type($project->type) }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Categorie:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ set_correct_translate_category($project->category) }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Etape:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $project->step }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Etape terminé:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $step_end->count() }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Client:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $project->client }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Jours restant:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{!! $days_remaining !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block" >Date de début:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $project->date_start->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Date de fin:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $project->date_end->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Date limite:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $project->deadline->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Date d'ajout:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $project->created_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Modification:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $project->updated_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b class="block">Version:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="block">{{ $project->version }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <br>
                                        <dt>Progression:</dt>
                                        <dd>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped active bg-{{set_progress_level($progress)}}" role="progressbar" style="width: {{$progress}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <small class="text-center">Projet completé a <strong>{{$progress}}%</strong></small>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4> Etape terminé ({{$step_end->count()}})  <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add_step_form">Ajouter une étape</button> </h4>
                    <br>
                    <table class="table table-hover table-striped display" id="table_step" style="text-align:center;"><font></font>
                            <thead class="table-info"><font></font>
                              <tr><font></font>
                                <th scope="col">Date</th><font></font>
                                <th scope="col">Titre</th><font></font>
                                <th scope="col">Action</th><font></font>
                              </tr><font></font>
                            </thead><font></font>
                            <tbody><font></font>
                              <tr><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                              </tr><font></font>
                            </tbody><font></font>
                    </table><font></font>
                </div>
            </div>
            <div class="col-md-3 d-none d-sm-block d-sm-none d-md-block">
                <div class="wrapper wrapper-content project-manager">
                    <h4 class="text-center">Description du projet</h4>
                    <p class="small">
                        {{$project->description}}
                    </p>
                </div>
            </div>

        </div>

    </div>
    </div>
@endsection

<!-- Modal List -->

    <!-- Add step form Modal -->
    <div class="modal fade" id="add_step_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Ajouter une étape</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="{{ route('project.step.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name">Titre</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{old('name')}}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" value="{{ $project->id }}" name="project_id">
                        <div class="mb-3">
                            <label for="description">Description <span class="text-muted">(Optionnel)</span></label>
                            <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
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
    <!-- End Add step form Modal -->

    <!-- Details step Modal -->
    @foreach ($step_end as $step)
        <div class="modal fade" id="view{{$step->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$step->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Détail étape</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Titre :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$step->name}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Description :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$step->description}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Date ajout :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$step->created_at->format('d/m/Y')}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Dernière modification :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$step->updated_at->format('d/m/Y')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form
                            action="{{ route('project.step.delete', $step->id) }}"
                            method="POST"
                            id="step-delete-form{{$step->id}}"
                        >
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                            <input type="hidden" value="{{ $project->id }}" name="project_id">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-danger" onclick="{{ alert_confirm('step-delete-form'.$step->id) }}">
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
    @foreach ($step_end as $step)
        <div class="modal fade" id="edit{{$step->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabelll{{$step->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Editer étape</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <form action="{{ route('project.step.update', $step->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Titre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ $step->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" value="{{ $project->id }}" name="project_id">
                            <div class="mb-3">
                                <label for="description">Description <span class="text-muted">(Optionnel)</span></label>
                                <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $step->description }}</textarea>
                                @error('description')
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




@section('footer')
    <script>

        var data =
            [
                @foreach ($step_end as $step)
                    [
                        "{{ $step->created_at->format('d/m/Y') }}",
                        "{{ $step->name }}",
                        "{!!
                             "<button class='btn btn-sm btn-success' data-toggle='modal' data-target='#view".$step->id."' data-placement='top' data-toggle='tooltip' title='Détails'><i class='fas fa-eye'></i></button>".
                             "<button class='btn btn-sm btn-info' data-toggle='modal' data-target='#edit".$step->id."' data-placement='top' data-toggle='tooltip' title='Editer'><i class='fas fa-pen'></i></button>"
                        !!}",
                    ],
                @endforeach

            ]

        $(document).ready(function() {
            $('#table_step').DataTable( {
                data: data
            } );
        } );
    </script>
@endsection
