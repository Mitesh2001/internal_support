@extends('layout.app')

@section('styles')

@endsection

@section('content')

    <div style="background-color: #f5f7f9" class="py-5">

        <div class="container">

            {!! Form::open() !!}

                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact" style="border-radius: 10px">
                    <!--begin::Form-->
                    <div>
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-lg-9 form-group form-group-error">
                                    {!! Form::label('requester', __('Requester '), ['class' => 'my-2']) !!}
                                    {!!
                                        Form::text('requester',
                                        "",
                                        ['class' => 'form-control p-2','required'])
                                    !!}
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-lg-9 form-group form-group-error">
                                    {!! Form::label('subject', __('Subject '), ['class' => 'my-2']) !!}
                                    {!!
                                        Form::text('subject',
                                        "",
                                        ['class' => 'form-control p-2','required'])
                                    !!}
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-lg-9 form-group form-group-error">
                                    {!! Form::label('description', __('Description '), ['class' => 'my-2']) !!}
                                    {!!
                                        Form::textarea('description',
                                        "",
                                        [
                                            'class' => 'form-control',
                                            'required',
                                            'id' => 'description-area',
                                            'placeholder' => 'Type something...'
                                            ])
                                    !!}
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-lg-9 form-group form-group-error">
                                    {!! Form::label('attachment', __('Attechment '), ['class' => 'custom-file-label my-2']) !!}
                                    {!!
                                        Form::file('attachment',
                                        ['class' => 'form-control custom-file-input','required','id' => 'description-area'])
                                    !!}
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn btn-secondary my-5 mx-3">Cancel</a>
                                <button type="" class="btn btn-primary my-5 mx-3">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')


<script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('description-area');
</script>

@endsection
