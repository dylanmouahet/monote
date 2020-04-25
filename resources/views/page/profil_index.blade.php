@extends('layouts.app')

@push('style')
    <style>
        input, .input-style{
            color:black !important;
            font-size:20px !important;
            font-weight:bold !important;
        }
    </style>
@endpush

@section('content')

    <div class="content animated fadeInUp">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Profil</h4>
                            <p class="card-category">Utilisateur</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Prenom</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->first_name }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nom</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->last_name }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Profession</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->job }}" disabled>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Companie</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->company }}" disabled>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">GitHub</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->github }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Facebook</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->fb }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Twitter</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->twitter }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">LinkedIn</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->linkedin }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="{{set_user_profil_picture(Auth::user()->picture)}}">
                        <img class="img" src="{{set_user_profil_picture(Auth::user()->picture)}}" />
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title input-style">{{ ucfirst(Auth::user()->username) }}</h4>
                        <h6 class="card-category text-gray"> <b>{{ ucfirst(Auth::user()->job) }}</b> </h6>
                        <p class="card-description">
                            {{ ucfirst(Auth::user()->about) }}
                        </p>
                        <a href="{{ route('profil.edit') }}" class="btn btn-primary btn-round">Modifier le profil</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
