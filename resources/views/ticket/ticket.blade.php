@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
          <div class="header-body">
                <div class="row align-items-center py-4">
                      <div class="col-lg-6 col-7">
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                                  <li class="breadcrumb-item" aria-current="page"><a href="{{route('ticket.index')}}">Tickets</a></li>
                                  <li class="breadcrumb-item active" aria-current="page"><a>{{$ticket->id}}</a></li>
                                  </ol>
                            </nav>
                      </div>
                      <div class="col-lg-6 col-5 text-right">
                            <a href="#" class="btn btn-sm btn-neutral">Filters</a>
                      </div>
                </div>
          </div>
    </div>
</div>
<div class="container mt--6">
    <div class="row">
        <div class="col-md-9">
            <div class="box shadow-sm rounded bg-white">
                <div class="box-body p-0">
                    <div class="p-3 d-flex align-items-center text-dark rounded border osahan-post-header">
                        <div class="dropdown-list-image mr-3">
                            <img class="mx-3 rounded" height="45px" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </div>
                        <div class="font-weight-bold mr-3">
                            <div class="text-truncate">
                                <h2>{{$ticket->subject}}</h2>
                                <span>Created by {{getUserName($ticket->user_id)}}</span>
                            </div>
                            <div class="my-2">
                                <p>
                                    {{$ticket->requester_id}}
                                    <br>
                                    <small class="font-italic">{{$ticket->created_at->diffForHumans()}} ( {{date_format($ticket->created_at, "D, d F Y \a\\t h:i a")}} )</small>
                                </p>
                                {!! $ticket->description !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-2 bg-secondary">
                        <a href="#" class="btn btn-outline-dark"> <i class="fas fa-reply"></i> Reply</a>
                        <a href="#" class="btn btn-outline-dark" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> <i class="fas fa-book"></i> Add note</a>
                        <a href="#" class="btn btn-outline-dark"> <i class="fas fa-share"></i> Forward</a>
                    </div>
                    <div>
                        @include('ticket.notes_form')
                    </div>
                </div>
            </div>
        </div>
        @include('ticket.side_form')
    </div>
</div>
@endsection
@push('js')
<script>

    var editor = CKEDITOR.replace('notes');

    $(document).ready(function() {

        $('.cancel-btn').click(() => {
          $('#collapseExample').collapse('hide');
        });

    });

    const changePriority = (priority_id,ticket_id) => {
        $.ajax({
            url: "{{ route('ticket.changePriority') }}",
            type: "GET",
            data : {
                priority_id : priority_id,
                ticket_id : ticket_id
            },
            success: function(data){
                $('.priority_value-'+ticket_id).html(data);
                alertifyPop("Ticket is seted  to "+data+" priority !");
            }
        });
    }

    const changeStatus = (status_id,ticket_id) => {
        $.ajax({
            url: "{{ route('ticket.changeStatus') }}",
            type: "GET",
            data : {
                status_id : status_id,
                ticket_id : ticket_id
        },
            success: function(data){
                $('.status_value-'+ticket_id).html(data);
                alertifyPop("Status changed !");
            }
        });
    }

    const changeAgent = (agent_id,ticket_id) => {
        $.ajax({
            url: "{{ route('ticket.change_agent') }}",
            type: "GET",
            data : {
                agent_id : agent_id,
                ticket_id : ticket_id
        },
            success: function(data){
                $('.agent_value-'+ticket_id).html(data);
                alertifyPop(data+" is selected as agent now !");
            }
        });
    }

    const alertifyPop = (message) => {
        alertify.set('notifier','position', 'bottom-right');
        alertify.notify(message, 'success');
    }

</script>
@endpush
