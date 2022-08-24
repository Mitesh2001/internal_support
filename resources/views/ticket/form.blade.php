<div class="modal fade" id="ticket-form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel"><h5>New Ticket</h5></div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card bg-secondary shadow border-0">
                        <form method="POST" enctype="multipart/form-data" id="ticketForm" action="{{route('ticket.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="requesterInput" class="form-label">Requester: <span class="text-danger">*</span> </label>
                                        <select name="requester" class="form-select" id="requesterInput">

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="subjectInput" class="form-label">Subject: <span class="text-danger">*</span></label>
                                        <input class="form-control" id="subjectInput" name="subject" placeholder="This is subject line" type="text" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="typeInput" class="form-label">Type:</label>
                                        <select class="form-select" name="type_id" id="typeInput">
                                            @foreach (getTicketType() as $key => $type)
                                                <option value="{{$key}}">{{$type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="sourceInput" class="form-label">Source:</label>
                                        <select class="form-select" name="source_id" id="sourceInput">
                                            @foreach (getTicketSource() as $key => $source)
                                                <option value="{{$key}}">
                                                    {{$source}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="statusInput" class="form-label">Status: <span class="text-danger">*</span></label>
                                        <select class="form-select" name="status_id" id="statusInput" required>
                                            @foreach (getTicketStatusName() as $key => $status)
                                                @if ($key == 0)
                                                    <option selected disabled value="">{{$status}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$status}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="priorityInput" class="form-label">Priority: <span class="text-danger">*</span></label>
                                        <select class="form-select" name="priority_id" id="priorityInput" required>
                                            @foreach (getPriorityName() as $key => $priority)
                                                @if ($key == 0)
                                                    <option selected disabled value="">{{$priority}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$priority}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="subjectInput" class="form-label">Description:</label>
                                        <textarea class="form-control" name="description" id="description-area" rows="3" placeholder="Describe here..."></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="AgentInput" class="form-label">Agent:<span class="text-danger"> *</span></label>
                                        <select class="form-select" name="agent_id" id="AgentInput">
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="form-group">
                                        <div class="text-dark">
                                                <div id="OpenImgUpload" style="cursor: pointer">
                                                    <i class="fa fa-link mx-2"></i><span>Attachment</span>
                                                </div>
                                        </div>
                                        <div class="input-group mb-4">
                                            <input class="form-control d-none" name="attachment" id="imgupload" type="file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="{{route('ticket.index')}}" class="btn btn-dark my-5 mx-3">Close</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
</div>
<script>
        $(document).ready(function() {

            $('#sourceInput').select2({
                width: '100%',
                dropdownParent: $('#ticket-form')
            });

            $('#typeInput').select2({
                width: '100%',
                dropdownParent: $('#ticket-form')
            });

            $('#statusInput').select2({
                width: '100%',
                dropdownParent: $('#ticket-form')
            });

            $('#priorityInput').select2({
                width: '100%',
                dropdownParent: $('#ticket-form')
            });

            $("#requesterInput").select2({
                width: '100%',
                dropdownParent: $('#ticket-form'),
                minimumInputLength: 2,
                placeholder: "Select Requester",
                allowClear: true,
                ajax: {
                    url: '{!! route('contact.get_requesters') !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache : true
                }
            });

            $('#AgentInput').select2({
                width: '100%',
                dropdownParent: $('#ticket-form'),
                placeholder: "Select Agent",
                allowClear: true,
                ajax: {
                    url: '{!! route('user.get_agents') !!}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache : true
                }
            });

            $('#ticketForm').validate({
                rules: {
                    requester: {
                        required: true,
                    },
                    subject : {
                        required: true,
                    },
                    status_id : {
                        required: true,
                    },
                    priority_id : {
                        required: true,
                    },
                    agent_id : {
                        required: true,
                    }
                },
                messages: {
                    requester: {
                        required: "Requester field is required !"
                    },
                    subject: {
                        required: "Subject field is required !"
                    },
                    status_id: {
                        required: "Status field is required !"
                    },
                    priority_id: {
                        required: "Please set some priority !"
                    },
                    agent_id: {
                        required: "Assign ticket to agent !"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

        });
</script>
<script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
