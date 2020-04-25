@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('/css/setting.css') }}">
@endpush

@section('content')
<hr>
    <div class="container animated fadeInUp">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-home" aria-selected="true">Compte</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-preference" role="tab" aria-controls="nav-profile" aria-selected="false">Preference</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent" >
                    <div class="tab-pane fade show active" id="nav-account" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="content py-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        <span class="anchor" id="formChangePassword"></span>
                                        <!-- form card change password -->
                                        <div class="card card-outline-secondary">
                                            <div class="card-header">
                                                <h3 class="mb-0">Changer le mot de passe</h3>
                                            </div>
                                            <div class="card-body">
                                                <form role="form" autocomplete="off" class="form needs-validation" action="{{ route('setting.changePassword') }}" method="POST" novalidate>
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <label for="inputPasswordOld">Mot de passe actuel</label>
                                                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="inputPasswordOld" required="">
                                                        @error('old_password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPasswordNew">Nouveau mot de passe</label>
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPasswordNew" required="">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPasswordNewVerify">Confirmer nouveau mot de passe</label>
                                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="inputPasswordNewVerify" required="">
                                                        @error('password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-lg float-right">Changer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /form card change password -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cta-sektion  border py-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn bg-danger twhite float-right" data-toggle='modal' data-target='#modal-confirm'>
                                            Supprimer mon compte
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-preference" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form action="{{ route('setting.updatePreference') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field("PUT") }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card" style="margin:50px 0">
                                        <!-- Default panel contents -->
                                                                            
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <b>Recevoir les notifications</b> 
                                                <label class="switch ">
                                                    <input type="checkbox" class="primary" name="notification" value="1"  {{ $setting->notification == 1 ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Recevoir les newsletters</b> 
                                                <label class="switch ">
                                                    <input type="checkbox" class="primary" name="newsletter" value="1"  {{ $setting->newsletter == 1 ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div> 
                                    <button type="submit" class="btn btn-primary twhite float-right" >
                                        Appliquer les changements
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Modal confirm -->

<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-confirm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <form
                            action="{{ route('setting.deleteAccount') }}"
                            method="POST"
                            id="account-delete-form"
                            >

                            <input type="password" name="password" placeholder="Mot de passe" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
                    {{ csrf_field() }}
                    {{ method_field("DELETE") }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-danger" onclick="{{ alert_confirm('account-delete-form') }}">
                        Supprimer
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>