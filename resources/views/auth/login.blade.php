@extends('layouts.id')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="form-signin">
        {{ csrf_field() }}
        <div class="text-center mb-4">
            <img class="mb-4" src="{{ asset('/img/logo.png') }}" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal"> Connexion </h1>
            <p class="text-center" style="font-size: 20px;">Se connecter avec:</p>
            <div class="row">

                <div class="col align-self-center">
                    <a href="#"><img class="img-fluid" src="{{ asset('/img/github.png') }}" alt="" width="52" height="52"></a>
                    <a href="#"><img class="img-fluid" src="{{ asset('/img/googleplus.png') }}" alt="" width="52" height="52"></a>
                </div>
            </div>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputEmail" name="login" class="form-control {{ $errors->has('login') || $errors->has('email') || $errors->has('username') ? 'is-invalid' : ''}}" placeholder="Email address" value="{{ old('login') }}" required autofocus>
            <label for="inputEmail">Nom d'utilisateur ou Email</label>
            @if($errors->has('login') || $errors->has('email') || $errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{  $errors->first('login') ?: $errors->first('email') ?: $errors->first('username')  }}</strong>
                </span>
            @endif
        </div>

        <div class="form-label-group">
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
            <label for="inputPassword">Mot de passe</label>
        </div>

        <div class="checkbox mb-3">
            <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Maintenir la connexion
            </label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
        <br>

        <p>
            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            <span class="float-right"> <a href="{{ route('register') }}"  >Créer un compte</a></span>
        </p>


        <p class="mt-5 mb-3 text-muted text-center">&copy; {{ date('Y') }} - Developped by <a href="https://twitter.com/dylanmouahet" target="_blank">Dylan M</a> - All right reserved</p>
    </form>
@stop
