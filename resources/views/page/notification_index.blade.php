@extends('layouts.app')

@push('style')
    <link href="{{ asset('/css/notification.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="container">
    <section class="content">
        <div class="row animated fadeInUp">
            <!-- BEGIN TICKET -->
            <div class="col-md-12">
                <div class="grid support-content">
                    <div class="grid-body">
                        <h2>
                            Notification ({{$notifications->count()}})
                            <a href="{{ route('notification.destroy.all') }}" class="btn btn-danger float-right">Tout Supprimer</a>
                        </h2>
                        <hr>
                    <div class="padding"></div>

                    <div class="row">
                        <!-- BEGIN TICKET CONTENT -->

                        <div class="col-md-12">
                            @if ($notifications->count() != 0)
                                <ul class="list-group fa-padding">
                                    @foreach ($notifications as $notification)
                                        <li class="list-group-item" data-toggle="modal" data-target="#notif{{$notification->id}}">
                                            <div class="media">
                                                <i class="fa fa-{{set_correct_icon($notification->type)}}"></i>
                                                <div class="media-body">
                                                    <strong>{{ $notification->name }}</strong> {!! set_new_notification($notification->id) !!}
                                                    <p class="info"> {!! substr($notification->message, 0, 100)."..." !!} </p>
                                                    <span> {{ $notification->created_at->format('d/m/Y') }} </span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                {{ $notifications->links() }}
                            @else
                                <p class="text-center"> Aucune notification </p>
                            @endif

                            
                        </div>
                        <!-- END TICKET CONTENT -->
                    </div>
                </div>
            </div>
        </div>
            <!-- END TICKET -->
</div>
    </section>
</div>

@endsection

<!-- BEGIN DETAIL MODAL -->
@foreach ($notifications as $notification)
<div class="modal fade" id="notif{{$notification->id}}" tabindex="-1" role="dialog" aria-labelledby="notif{{$notification->id}}" aria-hidden="true">
    <div class="modal-wrapper">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <h4 class="modal-title"><i class="fa fa-{{set_correct_icon($notification->type)}}"></i> {{$notification->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p style="font-size:20px;"> {!! $notification->message !!} </p>
                        @if (!is_null($notification->link))
                            <a class="btn btn-primary" href="{{$notification->link}}">Aller au projet</a>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <form
                        action="{{ route('notification.destroy', $notification->id) }}"
                        method="POST"
                        id="notification-delete-form{{$notification->id}}"
                    >
                        {{ csrf_field() }}
                        {{ method_field("DELETE") }}
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Fermer</button>
                        <button type="submit" class="btn btn-danger" onclick="{{ alert_confirm('notification-delete-form'.$notification->id) }}">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END DETAIL TICKET -->
