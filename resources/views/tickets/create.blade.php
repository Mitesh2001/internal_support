@extends('layout.master')

@section('styles')

@endsection

@section('content')

    <div style="background-color: #f5f7f9" class="py-5">

        <div class="container">

            @include('layout.alert')

            {!! Form::open([
                'route' => 'ticket.store'
            ]) !!}

                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact overflow-auto" style="border-radius: 10px;height:500px">
                    <!--begin::Form-->
                    <div>
                        <div class="card-body">
                            <div class="row my-2">
                                <div class="col-lg-8 form-group form-group-error">
                                    {!! Form::label('requester', __('Requester '), ['class' => 'my-2']) !!}
                                    {!!
                                        Form::text('requester',
                                        "",
                                        ['class' => 'form-control p-2'])
                                    !!}
                                    <small class="text-danger">
                                        @error('requester')
                                            <span class="text-red-500 text-xs"> {{ $message }}</span>
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-lg-8 form-group form-group-error">
                                    {!! Form::label('subject', __('Subject '), ['class' => 'my-2']) !!}
                                    {!!
                                        Form::text('subject',
                                        "",
                                        ['class' => 'form-control p-2'])
                                    !!}
                                    <small class="text-danger">
                                        @error('subject')
                                            <span class="text-red-500 text-xs"> {{ $message }}</span>
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-lg-8 form-group form-group-error">
                                    {!! Form::label('description', __('Description '), ['class' => 'my-2']) !!}
                                    {!!
                                        Form::textarea('description',
                                        "",
                                        [
                                            'class' => 'form-control',
                                            'id' => 'description-area',
                                            'placeholder' => 'Type something...'
                                            ])
                                    !!}
                                    <small class="text-danger">
                                        @error('description')
                                            <span class="text-red-500 text-xs"> {{ $message }}</span>
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            <div class="row my-2">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                <small class="text-danger">
                                    @error('g-recaptcha-response')
                                        <span class="text-red-500 text-xs"> {{ $message }}</span>
                                    @enderror
                                </small>
                            </div>
                            <div class="row my-4">
                                <div class="col-lg-2 form-group form-group-error">
                                    <div class="text-dark" style="cursor: pointer">
                                        <div id="OpenImgUpload">
                                            <i class="fa fa-link mx-2"></i><span>Attachment</span>
                                        </div>
                                    </div>
                                    {!!
                                        Form::file('attachment',
                                        [
                                            'class' => 'form-control custom-file-input',
                                            'style' => 'display:none',
                                            'id' => 'imgupload'
                                        ])
                                    !!}
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <a href="#" class="btn btn-secondary my-5 mx-3">Cancel</a>
                                <button type="submit" class="btn btn-primary my-5 mx-3">Submit</button>
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

    (".status").select2();

    $('#OpenImgUpload').click(() => {
        $('#imgupload').trigger('click');
    });

    CKEDITOR.replace('description-area');

</script>

@endsection
