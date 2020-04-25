<footer class="footer">
    <div class="container-fluid">
        <nav class="float-left">
            <ul>
                <li>
                    <a href="{{config('app.url')}}">
                        {{config('app.name')}}
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="modal" data-target="#contact-modal">
                        Nous contacter
                    </a>
                </li>
                <li>
                    <a href="#">
                    Blog
                    </a>
                </li>
                <li>
                    <a href="#">
                        Conditions
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright float-right">
            &copy;
            {{ date('Y') }}
            , made with <i class="fas fa-heart text-danger"></i> by {!!config('app.author')!!}
             for a better web.
        </div>
    </div>


      <!--contact  Modal -->
    <div class="modal fade" id="contact-modal" tabindex="-1" role="dialog" aria-labelledby="contact-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title fa fa-envelope" id="exampleModalLabel">&nbsp; Nous contacter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" action="{{ route('contact') }}" method="POST" novalidate>
                        {{ csrf_field()}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label  for="inputTo" style="font-weight:bold;"><b class="fa fa-at"></b> &nbsp; E-mail</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="inputTo" placeholder="Votre addresse email" required>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label  for="inputSubject" style="font-weight:bold;"><b class="fa fa-list"></b>&nbsp; Sujet</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" id="inputSubject" placeholder="Sujet" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

                                <div class="col-md-3">
                                    <label for="inputBody" style="font-weight:bold;"><b class="fa fa-envelope"></b>&nbsp; Message</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" value="{{ old('message') }}" id="inputBody" rows="8" placeholder="Votre message" required></textarea>
                                </div>

                        </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary ">Envoyer <i class="fa fa-arrow-circle-right fa-lg"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/assets/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('/js/material-dashboard.js') }}"></script>
    <script src="{{ asset('/js/demo.js') }}"></script>
    <script src="{{ asset('/assets/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('/assets/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    @stack('script')

</footer>





