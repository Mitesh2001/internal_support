<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <div class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-calendar px-3"></i> TO-DO
            </div>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body overflow-auto" style="height: 150px">
                <form wire:submit.prevent = "storeTodo">
                    <div class="input-group mb-3 input-group-sm input-group-sm">
                        <input type="text" class="form-control p-2 to-do-input" placeholder="Add a to-do" wire:model="todoBody">
                    </div>
                </form>
                <div class="list-group list-group-flush">
                    @foreach ($todoes as $todo)
                        <div class="list-group-item item-{{$todo->id}} d-flex justify-content-between">
                            <div>
                                <label>
                                    <input class="form-check-input me-1" @if ($todo->done) checked  @endif type="checkbox">
                                    <span>
                                        @if ($todo->done)
                                            <del>{{ $todo->body }}</del>
                                        @else
                                            {{ $todo->body }}
                                        @endif
                                    </span>
                                </label>
                            </div>
                            <div>
                                <span><i class="fas fa-trash mx-1"></i></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
