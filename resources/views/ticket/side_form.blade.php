<div class="col-md-3 box shadow-sm rounded bg-white">
    <div class="text-sm px-3 my-3" style="height: 500px;overflow-y: scroll;">
        <div>
            <div class="form-group">
                <h2>{{'Open'}}</h2>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="first-response-radio" checked>
                <label class="form-check-label">
                    FIRST RESPONSE DUE
                    <br>
                    by Tue, 07 Jun 2022, 10:00 PM
                </label>
            </div>
            <br>
            <div class="form-check">
                <input type="radio" class="form-check-input" id="first-response-radio" checked>
                <label class="form-check-label">
                    FIRST RESPONSE DUE
                    <br>
                    by Tue, 07 Jun 2022, 10:00 PM
                </label>
            </div>
            <hr>
            <div class="form-group d-flex justify-content-between">
                <label class="text-sm font-weight-bold" for="statusInput">Status :</label>
                <span class="status_value-{{$ticket->id}}">{{$statuses[$ticket->status]}}</span>
                <div class="dropdown dropright">
                    <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        @foreach ($statuses as $key => $status)
                        <a href="#!" class="dropdown-item" onclick="changeStatus({{$key}},{{$ticket->id}})">{{$status}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="text-sm font-weight-bold" for="priorityInput">Priority :</label>
                <span class="priority_value-{{$ticket->id}}">{{$priorities[$ticket->priority_id]}}</span>
                <div class="dropdown">
                    <a class="btn btn-sm text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        @foreach ($priorities as $key => $priority)
                        <a href="#!" class="dropdown-item" onclick="changePriority({{$key}},{{$ticket->id}})">
                            <span class="badge badge-dot mr-4">
                                <i class="bg-{{getPriorityBadges($key)}}"></i>
                            </span>
                            <span class="status">{{$priority}}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="text-sm font-weight-bold" for="AgentInput">Agent :</label>
                <span class="agent_value-{{$ticket->id}}">{{getUserName($ticket->agent_id)}}</span>
                <div class="dropdown dropright">
                    <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left">
                        @foreach (getUserName() as $key => $agent)
                            <a href="#!" class="dropdown-item" onclick="changeAgent({{$agent->id}},{{$ticket->id}})">
                                {{$agent->name}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
