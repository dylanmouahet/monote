 @extends('layouts.app')

@push('style')
    <style>
        .input-style{
            color:blueviolet !important;
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
                            <form class="needs-validation" method="POST" action="{{route('profil.update')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Prenom</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?: Auth::user()->first_name }}" required>
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Nom</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?: Auth::user()->last_name }}" required>
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?: Auth::user()->email }}" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Profession</label>
                                        <input type="text" class="form-control @error('job') is-invalid @enderror" name="job" value="{{ old('job') ?: Auth::user()->job }}" >
                                        @error('job')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Companie</label>
                                        <input type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') ?: Auth::user()->company }}" >
                                        @error('company')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">GitHub</label>
                                            <input type="text" class="form-control @error('github') is-invalid @enderror" name="github" value="{{ old('github') ?: Auth::user()->github }}" >
                                            @error('github')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Facebook</label>
                                            <input type="text" class="form-control @error('fb') is-invalid @enderror" name="fb" value="{{ old('fb') ?: Auth::user()->fb }}" >
                                            @error('fb')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Twitter</label>
                                            <input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ old('twitter') ?: Auth::user()->twitter }}" >
                                            @error('twitter')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">LinkedIn</label>
                                            <input type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" value="{{ old('linkedin') ?: Auth::user()->linkedin }}" >
                                            @error('linkedin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>A propos de moi</label>
                                            <div class="form-group">
                                                <textarea class="form-control @error('about') is-invalid @enderror" rows="5" name="about">{{ old('about') ?: Auth::user()->about }}</textarea>
                                                @error('about')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Mettre a jour</button>
                                <div class="clearfix"></div>

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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="btn-bs-file btn btn-lg btn-primary" style="text-transform:none;">
                                        Changer la photo
                                        <input type="file" name="picture" class="form-control @error('picture') is-invalid @enderror"/>
                                    </label>
                                    @error('picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
