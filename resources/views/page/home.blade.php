@extends('layouts.app')
@push('style')
    <style>
        .card-category{
            font-size: 20px !important;
            font-weight: bold !important;
        }
        .stats a{
            text-align: center !important;
        }
    </style>
@endpush
@section('content')
        <hr>
        <div class="row animated fadeInUp">
            <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-folder-open"></i>
                </div>
                <p class="card-category">Projets</p>
                <h3 class="card-title">
                    {{ $projects->count() }}
                </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <a href="{{route('project.index')}}"><i class="fas fa-eye"></i> &nbsp; Voir la liste</a>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <p class="card-category">Formations</p>
                <h3 class="card-title">
                    {{ $learnings->count() }}
                </h3>
                </div>
                <div class="card-footer">
                <div class="stats">
                    <a href="{{route('learning.index')}}"><i class="fas fa-eye"></i> &nbsp; Voir la liste</a>
                </div>
                </div>
            </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-award"></i>
                </div>
                <p class="card-category">Compétence </p>
                <h3 class="card-title">
                    {{ $expertises->count() }}
                </h3>
                </div>
                <div class="card-footer">
                <div class="stats">
                    <a href="{{route('expertise.index')}}"><i class="fas fa-eye"></i> &nbsp; Voir la liste</a>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="row animated fadeInUp">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                    <h4 class="card-title">Statistique Projets</h4>
                    <p class="card-category">Vos Projets recents </p>
                    </div>
                    <div class="card-body table-responsive">
                    @if ($projects->count() == 0)
                        <p class="text-center">Aucun projet enregistré</p>
                    @else
                        <table class="table table-hover">
                            <thead class="text-warning">
                                <th style="font-weight:bold; text-align:center;">Nom</th>
                                <th style="font-weight:bold; text-align:center;">Type</th>
                                <th style="font-weight:bold; text-align:center;">Categorie</th>
                                <th style="font-weight:bold; text-align:center;">Statut</th>
                            </thead>
                            <tbody>

                                @foreach ($project as $row)
                                    <tr onclick="document.location='{{ route('project.show', $row->id) }}'" style="cursor:pointer;">
                                        <td class="text-center">{{$row->name}}</td>
                                        <td class="text-center">{{set_correct_translate_type($row->type)}}</td>
                                        <td class="text-center">{{set_correct_translate_category($row->category)}}</td>
                                        <td class="text-center">{!!set_status($row->status)!!}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Statistique Formations</h4>
                        <p class="card-category">Vos formations en cours</p>
                    </div>
                    <div class="card-body table-responsive">
                        @if ($learnings->count() == 0)
                            <p class="text-center">Aucune formation enregistrée</p>
                        @else
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th style="font-weight:bold; text-align:center;">Nom</th>
                                    <th style="font-weight:bold; text-align:center;">Type</th>
                                    <th style="font-weight:bold; text-align:center;">Categorie</th>
                                    <th style="font-weight:bold; text-align:center;">Statut</th>
                                </thead>
                                <tbody>
                                    @foreach ($learning as $row)
                                        <tr onclick="document.location='{{ route('learning.show', $row->id) }}'" style="cursor:pointer;">
                                            <td class="text-center">{{$row->name}}</td>
                                            <td class="text-center">{{set_correct_translate_type($row->type)}}</td>
                                            <td class="text-center">{{$row->category}}</td>
                                            <td class="text-center">{!!set_status($row->status)!!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row animated fadeInUp">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-danger">
                        <h4 class="card-title">Statistique Competences</h4>
                        <p class="card-category">Vos nouvelles competences acquises</p>
                    </div>
                    <div class="card-body table-responsive">
                        @if ($expertises->count() == 0)
                            <p class="text-center">Aucune compétence enregistrée</p>
                        @else
                            <table class="table table-hover">
                                <thead class="text-warning">
                                    <th style="font-weight:bold; text-align:center;">Nom</th>
                                    <th style="font-weight:bold; text-align:center;">Type</th>
                                    <th style="font-weight:bold; text-align:center;">Categorie</th>
                                    <th style="font-weight:bold; text-align:center;">Niveau</th>
                                </thead>
                                <tbody>
                                    @foreach ($expertise as $row)
                                        <tr onclick="document.location='{{ route('expertise.index',) }}'" style="cursor:pointer;">
                                            <td class="text-center">{{$row->name}}</td>
                                            <td class="text-center">{{set_correct_translate_type($row->type)}}</td>
                                            <td class="text-center">{{$row->category}}</td>
                                            <td class="text-center">
                                                <div class="progress">
                                                    <div class="progress-bar bg-{{set_progress_level($row->level)}}" role="progressbar" style="width: {{$row->level}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

