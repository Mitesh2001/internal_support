<!-- Section: Timeline -->
<section class="">
    <style>
      .timeline-with-icons {
        border-left: 1px solid hsl(0, 0%, 90%);
        position: relative;
        list-style: none;
      }

      .timeline-with-icons .timeline-item {
        position: relative;
      }

      .timeline-with-icons .timeline-item:after {
        position: absolute;
        display: block;
        top: 0;
      }

      .timeline-with-icons .timeline-icon {
        position: absolute;
        left: -48px;
        background-color: hsl(217, 88.2%, 90%);
        color: hsl(217, 88.8%, 35.1%);
        border-radius: 50%;
        height: 31px;
        width: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
      }
    </style>

    <ul class="timeline-with-icons">
        @foreach ($contact->tickets as $ticket)
        <li class="timeline-item mb-5">
            <span class="timeline-icon">
                <i class="{{$ticket->source_id == 1 ? 'fas fa-phone' : 'fas fa-envelope'}} text-primary fa-sm fa-fw"></i>
            </span>
            <div class="card shadow my-2 p-4">
                <a href="{{route('ticket.show',$ticket->id)}}"><h3 class="card-title">{{$ticket->subject.' #'.$ticket->id}}</h3></a>
                <p class="text-muted mb-2 fw-bold">{{date_format($ticket->created_at,"d F Y")}}</p>
                <p class="text-muted">
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
                </p>
            </div>
        </li>
        @endforeach
    </ul>
  </section>
  <!-- Section: Timeline -->
