@foreach ($company->todoes as $todo)
    <div class="list-group-item item-{{$todo->id}} d-flex justify-content-between">
        <div>
            <label>
                <input onchange="markAsDone({{$todo->id}})" class="form-check-input me-1 todo-{{$todo->id}}" @if ($todo->done) checked  @endif type="checkbox">
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
            <span onclick="deleteTodo({{$todo->id}})"><i class="fas fa-trash mx-1"></i></span>
        </div>
    </div>
@endforeach
