@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('/css/project.css') }}">

    <style>
        .btn-secondary:hover{
            box-shadow: 0 14px 26px -12px rgba(76, 175, 80, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(76, 175, 80, 0.2)!important;
            color: #fff !important;
            background-color: #47a44b !important;
            font-weight: bold !important;
            border-color: #39843c!important;
        }

        .btn-secondary{
            color: #fff;
            background-color: #4caf50 !important;
            border-color: #4caf50 !important;
            box-shadow: 0 2px 2px 0 rgba(76, 175, 80, 0.14), 0 3px 1px -2px rgba(76, 175, 80, 0.2), 0 1px 5px 0 rgba(76, 175, 80, 0.12) !important;
            padding: 0.40625rem 1.25rem !important;
            font-size: 22px !important;
            height: 40px !important;
            width: 150px !important;
            font-weight: bolder !important;
            text-transform: none !important;
            color: #fff !important;

        }
    </style>
@endpush

@section('content')
<div class="container animated fadeInUp">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Formation Total</h6>
                    <h2 class="text-right"><i class="fa fa-align-justify f-left"></i><span>{{ $learnings->count() }}</span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Formation en cours</h6>
                    <h2 class="text-right"><i class="fa fa-edit f-left"></i><span>{{ $active->count() }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Formation en attente</h6>
                    <h2 class="text-right"><i class="fas fa-pause-circle f-left"></i><span>{{ $pending->count() }}</span></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Formation terminé</h6>
                    <h2 class="text-right"><i class="fa fa-check-circle f-left"></i><span>{{ $finished->count() }}</span></h2>
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
                <h4 class="card-title mt-0"> Liste formation </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped display" id="table_learning" style="text-align:center;"><font></font>
                        <thead class="table-info"><font></font>
                            <th style="font-weight:bold; color:purple;">Nom</th><font></font>
                            <th style="font-weight:bold; color:purple;">Type</th><font></font>
                            <th style="font-weight:bold; color:purple;">Categorie</th><font></font>
                            <th style="font-weight:bold; color:purple;">Formateur</th><font></font>
                            <th style="font-weight:bold; color:purple;">Source</th><font></font>
                            <th style="font-weight:bold; color:purple;">Statut</th><font></font>
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
                @foreach ($learnings as $learning)
                    [
                        "{{ $learning->name }}",
                        "{{ $learning->type }}",
                        "{{ $learning->category }}",
                        "{{ $learning->teacher }}",
                        "{{ $learning->source }}",
                        "{!!set_status($learning->status)!!}",
                        "{{ $learning->created_at->format('d/m/Y') }}",
                        "{!!
                             "<a href='". route('learning.show', $learning->id) ."' class='btn btn-sm btn-success' data-placement='top' data-toggle='tooltip' title='Détails'><i class='fas fa-eye'></i></a>".
                             "<a href='".route('learning.edit', $learning->id) ."' class='btn btn-sm btn-info' data-placement='top' data-toggle='tooltip' title='Editer'><i class='fas fa-pen'></i></a>"
                        !!}",
                    ],
                @endforeach

            ]

        $(document).ready(function() {
            $('#table_learning').DataTable( {
                data: data,
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: "Ajouter <i class='fas fa-plus'></i>",
                        action: function ( e, dt, node, config ) {
                            document.location.href="{{ route('learning.create') }}";
                        }
                    }
                ]
            } );
        } );
    </script>
@endsection
