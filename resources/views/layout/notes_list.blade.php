<div style="text-decoration: none;cursor:pointer">
    <div class="card shadow my-2 p-2">
        <div class="card-body row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <div>
                        <small><b>{{getUserName($notes->added_by)}}</b> added a note</small>
                        <h3 class="card-title">{{$notes->title}}</h3>
                    </div>
                    <div>
                        <small>{{$notes->created_at->diffForHumans()}}( {{date_format($notes->created_at, "D, d F Y, h:i a")}} )</small>
                        {{-- <a class="mx-2" onclick="editNote({{$notes->id}})"><i class="fas fa-edit text-primary"></i></a> --}}
                        <a class="mx-2" onclick="deleteNote({{$notes->id}})"><i class="fas fa-trash text-danger"></i></a>
                    </div>
                </div>
                <div>
                {!! $notes->body !!}
                </div>
            </div>
        </div>
    </div>
</div>
