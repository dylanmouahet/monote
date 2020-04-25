@extends('layouts.id')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Créer un compte') }}</div>

                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name">Prénom</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"  value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="last_name">Nom</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="username">Nom d'utilisateur</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirm">Confirmer le mot de passe</label>
                                    <input type="password" class="form-control" id="password_confirm" name="password_confirmation" value="" required>
                                    <div class="invalid-feedback">
                                    Valid last name is required.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Créer un compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<footer style="margin-top: 100px;">
        <p class="mt-5 mb-3 text-muted text-center">
            &copy; {{ date('Y') }} - Developped by
            <a href="https://twitter.com/dylanmouahet" target="_blank">Dylan M</a>
            - All right reserved
        </p>
</footer>
@endsection
