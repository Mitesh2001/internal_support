@foreach ($company->contacts as $company_contact)
    @foreach ($company_contact->tickets as $ticket)
        <div style="text-decoration: none;cursor:pointer" >
                <div class="card shadow my-2 p-2 ticket-simple">
                    <div class="card-body row">
                            {{-- <div class="d-flex align-items-center pr-4 pl-2">
                                <h2>
                                        <i class="fas fa-ticket-alt text-primary"></i>
                                </h2>
                            </div> --}}
                            <div>
                                <a href="{{route('ticket.show',$ticket->id)}}"><h3 class="card-title"><i class="fas fa-ticket-alt text-primary"></i> {{$ticket->subject.' #'.$ticket->id}}</h3></a>
                                <small>
                                        Status : {{getTicketStatusName($ticket->state_id)}}
                                </small>
                                |
                                <small>
                                        Priority :
                                        <span class="text-{{getPriorityBadges($ticket->priority_id)}}">
                                            {{getPriorityName($ticket->priority_id)}}
                                        </span>
                                </small>
                                |
                                <small>
                                        Created : {{$ticket->created_at->diffForHumans()}}
                                </small>
                            </div>
                    </div>
                </div>
        </div>
    @endforeach
@endforeach
