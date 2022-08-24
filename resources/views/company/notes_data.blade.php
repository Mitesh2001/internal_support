<div class="notes-area text-center">
    <div class="collapse" id="collapseExample">
          <div class="card border border-secondary">
                <div class="card-contetn">
                      <div class="card-body">
                            <form action="" id="notes-form" method="post">
                                  <div class="form-group">
                                        <input type="text" class="form-control title-field" placeholder="what is this note about ?" name="title">
                                  </div>
                                  <div class="form-group">
                                        <textarea name="notes" class="form-control notes" id="notes" cols="30" rows="10"></textarea>
                                  </div>
                                  <input type="hidden" value="{{$company->id}}" class="company_id">
                                  <input type="hidden" value="" id="note_id">
                                  <div class="form-group">
                                        <button class="btn btn-secondary cancel-btn" type="button">Cancel</button>
                                        <button class="btn btn-outline-light add-note" type="submit" id="notes-submit-btn">Add Note</button>
                                  </div>
                            </form>
                      </div>
                </div>
          </div>
    </div>
    <div class="card border border-secondary">
        <div class="card-contetn">
            <div class="card-body">
                    <input type="text" placeholder="Add notes about this company ( like implementation details, their reviews, etc.) " class="form-control" id="collapse-btn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            </div>
        </div>
    </div>
</div>
@foreach ($company->contacts as $contact)
    @foreach ($contact->notes as $notes)
        @include('layout.notes_list')
    @endforeach
@endforeach
<script>

    var editor = CKEDITOR.replace('notes');

    $(document).ready(function() {

        $('#collapse-btn').click(function() {
            $(this).hide();
        });

        $('.cancel-btn').click(() => {
          $('#collapseExample').collapse('hide');
          $('#collapse-btn').show();
        });

        $( "#notes-form" ).on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('notes.store') }}",
                type: 'post',
                dataType: 'json',
                data: {
                    '_token': "{{ csrf_token() }}",
                    'notesable_id' : $('.contact_id').val(),
                    'notesable_type' : 'Contact',
                    'title' : $('.title-field').val(),
                    'body' : editor.getData()
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
    });

    function editNote(note_id) {
        alert('edit'+note_id);
        // $.ajax({
        //     url: "{{ route('notes.get_note_data') }}",
        //     dataType: 'json',
        //     data: {
        //         'note_id' : note_id
        //     },
        //     success: function(data) {
        //         $('.title-field').val(data.title);
        //         $('.contact_id').val(data.note_about);
        //         $('.note_id').val(data.id);
        //         editor.setData(data.note);
        //         $('#collapseExample').collapse('toggle');
        //         $("#notes-submit-btn").removeClass('add-note').addClass('update-note').html('Update Note');
        //         $('.title-field').focus();
        //     }
        // });
    }

    function deleteNote(note_id) {
        $.ajax({
            url: "{{ route('notes.delete_note') }}",
            dataType: 'json',
            data: {
                'note_id' : note_id
            },
            success: function(data) {
                location.reload();
            }
        });
    }

</script>
