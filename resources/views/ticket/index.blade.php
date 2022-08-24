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
                                    <li class="breadcrumb-item active" aria-current="page"><a>Tickets</a></li>
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
<div class="container-fluid mt--6">
      <div class="row justify-content-center">
            <div class="col">
                  <div class="card">
                        @include('layouts.alert')
                        <!-- Card header -->
                        <div class="card-header border-0">
                              <h3 class="mb-0">All Tickets</h3>
                        </div>

                        <div class="table-responsive" style="min-height: 350px">
                            <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="requester">Requester</th>
                                <th scope="col" class="sort" data-sort="subject">Subject</th>
                                <th scope="col">State</th>
                                <th scope="col">Type</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Source</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="{{route('contact.show',$ticket->contact->id)}}" class="avatar rounded-circle mr-3">
                                                <img src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                                            </a>
                                            <div class="media-body">
                                                <a class="text-dark" href="{{route('contact.show',$ticket->contact->id)}}"><span class="name mb-0 text-sm">{{$ticket->contact->email}}</span></a>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        <span>
                                            <a class="text-dark" href="{{route('ticket.show',$ticket->id)}}"><b>{{$ticket->subject." #".$ticket->id}}</b></a>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="border border-danger rounded p-1 text-danger" style="background-color: #ffecf0">
                                            Overdue
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown dropright">
                                            <span class="type_value-{{$ticket->id}}">{{$types[$ticket->type_id]}}</span>
                                            <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                @foreach ($types as $key => $type)
                                                    <a href="#!" class="dropdown-item" onclick="changeTicketType({{$key}},{{$ticket->id}})">{{$type}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <span class="priority_value-{{$ticket->id}}">{{$priorities[$ticket->priority_id]}}</span>
                                            <a class="btn btn-sm text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                @foreach ($priorities as $key => $priority)
                                                    <a href="#!" class="dropdown-item" onclick="changePriority({{$key}},{{$ticket->id}})">
                                                        <span class="badge badge-dot mr-4">
                                                            <i class="bg-{{$priority_badges[$key]}}"></i>
                                                        </span>
                                                        <span class="status">{{$priority}}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown dropright">
                                            <span class="source_value-{{$ticket->id}}">{{$sources[$ticket->source_id]}}</span>
                                            <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                @foreach ($sources as $key => $source)
                                                    <a href="#!" class="dropdown-item" onclick="changeTicketSource({{$key}},{{$ticket->id}})">
                                                        <i class="{{$source_icons[$key]}}"></i>{{$source}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown dropright">
                                            <span class="agent_value-{{$ticket->id}}">{{getUserName($ticket->agent_id)}}</span>
                                            <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                @foreach ($agents as $key => $agent)
                                                    <a href="#!" class="dropdown-item" onclick="changeAgent({{$agent->id}},{{$ticket->id}})">
                                                        {{$agent->name}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown dropright">
                                            <span class="status_value-{{$ticket->id}}">{{$statuses[$ticket->status]}}</span>
                                            <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-angle-down"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                @foreach ($statuses as $key => $status)
                                                        <a href="#!" class="dropdown-item" onclick="changeStatus({{$key}},{{$ticket->id}})">{{$status}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer py-4">
                            <nav aria-label="...">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                  </div>
            </div>
      </div>
</div>
@endsection

@push('js')

<script>

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
        }
    });
}

const changeTicketSource = (source_id, ticket_id) => {
    $.ajax({
        url: "{{ route('ticket.change_source') }}",
        type: "GET",
        data : {
            source_id : source_id,
            ticket_id : ticket_id
        },
        success: function(data){
            $('.source_value-'+ticket_id).html(data);
        }
    });
}

const changeTicketType = (type_id, ticket_id) => {
    $.ajax({
        url: "{{ route('ticket.change_type') }}",
        type: "GET",
        data : {
            type_id : type_id,
            ticket_id : ticket_id
        },
        success: function(data){
            $('.type_value-'+ticket_id).html(data);
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
        }
    });
}

</script>

@endpush
