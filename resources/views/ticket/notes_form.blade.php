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
                                  <input type="hidden" value="{{$ticket->id}}" class="ticket_id">
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
</div>
