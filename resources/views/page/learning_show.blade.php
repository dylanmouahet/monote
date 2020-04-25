@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('/css/project_show.css') }}">
    <style>

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
                                    <div class="m-b-md ">
                                        <div class="float-right">
                                            <form
                                                action="{{ route('learning.destroy', $learning->id) }}"
                                                method="POST"
                                                id="learning-delete-form"
                                            >
                                                {{ csrf_field() }}
                                                {{ method_field("DELETE") }}
                                                <a href="{{ route('learning.edit', $learning->id) }}" class="btn btn-info btn-xs ">Editer</a>
                                                <button type="submit" class="btn btn-danger" onclick="{{ alert_confirm('learning-delete-form') }}">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                        <h2>{{ $learning->name }}</h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                        <span style="font-weight:bold;">Status:</span> <button class="btn btn-sm btn-{{set_status_badge($learning->status)}}">{{ set_correct_translate_status($learning->status) }}</button>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b >Type:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{{ set_correct_translate_type($learning->type) }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b >Categorie:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{{ $learning->category }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Chapitre:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{{ $learning->chapter }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Chapitre terminé:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{{ $chapter_end->count() }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Formateur:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{{ $learning->teacher }}</span>
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
                                                    <b >Source:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{{ $learning->source }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Site:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="{{$learning->url}}" target="_blank">Voir le site</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Date d'ajout:</b>
                                                </div>
                                                <div class="col-md-6">
                                                    <span>{{ $learning->created_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <b>Modification:</b>
                                                </div>
                                                <div class="col-md-6">
                                                   <span>{{ $learning->updated_at->format('d/m/Y') }}</span>
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
                                            <small class="text-center">Formation completé a <strong>{{$progress}}%</strong></small>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4> Formation terminé ({{$chapter_end->count()}})  <button class="btn btn-primary float-right" data-toggle="modal" data-target="#add_chapter_form">Ajouter un chapitre</button> </h4>
                    <br>
                    <table class="table table-hover table-striped display" id="table_chapter" style="text-align:center;"><font></font>
                            <thead class="table-info"><font></font>
                              <tr><font></font>
                                <th scope="col">Date</th><font></font>
                                <th scope="col">Titre</th><font></font>
                                <th scope="col">Description</th><font></font>
                                <th scope="col">Action</th><font></font>
                              </tr><font></font>
                            </thead><font></font>
                            <tbody><font></font>
                              <tr><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                                <td></td><font></font>
                              </tr><font></font>
                            </tbody><font></font>
                    </table><font></font>
                </div>
            </div>
            <div class="col-md-3">
                <div class="wrapper wrapper-content project-manager">
                    <h4 class="text-center">Description de la formation</h4>
                    <p class="small">
                        {{$learning->description}}
                    </p>
                </div>
            </div>

        </div>

    </div>
    </div>
@endsection

<!-- Modal List -->

    <!-- Add chapter form Modal -->
    <div class="modal fade" id="add_chapter_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Ajouter un chapitre</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="{{ route('learning.chapter.store') }}" method="POST">
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
                        <input type="hidden" value="{{ $learning->id }}" name="learning_id">
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
    <!-- End Add chapter form Modal -->

    <!-- Details chapter Modal -->
    @foreach ($chapter_end as $chapter)
        <div class="modal fade" id="view{{$chapter->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel{{$chapter->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Détail chapitre</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Titre :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$chapter->name}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Description :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$chapter->description}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Date ajout :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$chapter->created_at->format('d/m/Y')}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <b> Dernière modification :</b>
                                </div>
                                <div class="col-md-6">
                                    <span>{{$chapter->updated_at->format('d/m/Y')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form
                            action="{{ route('learning.chapter.delete', $chapter->id) }}"
                            method="POST"
                            id="chapter-delete-form{{$chapter->id}}"
                        >
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                            <input type="hidden" value="{{ $learning->id }}" name="learning_id">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-danger" onclick="{{ alert_confirm('chapter-delete-form'.$chapter->id) }}">
                                Supprimer
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- End details chapter Modal -->

    <!-- Edit chapter Modal -->
    @foreach ($chapter_end as $chapter)
        <div class="modal fade" id="edit{{$chapter->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabelll{{$chapter->id}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Editer formation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <form action="{{ route('learning.chapter.update', $chapter->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Titre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{ $chapter->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" value="{{ $learning->id }}" name="learning_id">
                            <div class="mb-3">
                                <label for="description">Description <span class="text-muted">(Optionnel)</span></label>
                                <textarea name="description" id="description" cols="10" rows="5" class="form-control @error('description') is-invalid @enderror">{{ $chapter->description }}</textarea>
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
    <!-- End Edit chapter Modal -->




@section('footer')
    <script>

        var data =
            [
                @foreach ($chapter_end as $chapter)
                    [
                        "{{ $chapter->created_at->format('d/m/Y') }}",
                        "{{ $chapter->name }}",
                        "{{ $chapter->description }}",
                        "{!!
                             "<button class='btn btn-sm btn-success' data-toggle='modal' data-target='#view".$chapter->id."' data-placement='top' data-toggle='tooltip' title='Détails'><i class='fas fa-eye'></i></button>".
                             "<button class='btn btn-sm btn-info' data-toggle='modal' data-target='#edit".$chapter->id."' data-placement='top' data-toggle='tooltip' title='Editer'><i class='fas fa-pen'></i></button>"
                        !!}",
                    ],
                @endforeach

            ]

        $(document).ready(function() {
            $('#table_chapter').DataTable( {
                data: data
            } );
        } );
    </script>
@endsection
