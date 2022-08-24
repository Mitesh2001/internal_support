@extends('layouts.app')

@section('content')

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
            <div class="header-body">
                  <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a>Companies</a></li>
                                    </ol>
                              </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
                        </div>
                  </div>
            </div>
      </div>
</div>
<div class="container-fluid mt--6">
      <div class="row justify-content-center">
            <div class="col">
                  <div class="card">
                        @include('layouts.alert')
                        <!-- Card header -->
                        <div class="card-header border-0">
                              <h3 class="mb-0">All Companies</h3>
                        </div>

                        <div class="table-responsive">
                              <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                          <tr>
                                                <th scope="col" class="sort" data-sort="contact">Company</th>
                                                <th scope="col">Contacts</th>
                                          </tr>
                                    </thead>
                                    <tbody class="list">
                                          @foreach ($companies as $company)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="media align-items-center">
                                                            <a href="{{route('company.show',$company->id)}}" class="avatar rounded-circle mr-3">
                                                                {{-- <img src="{{url('')."/".$contact->photo}}"> --}}
                                                                <img src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                                                            </a>
                                                            <div class="media-body">
                                                                <a class="text-dark" href="{{route('company.show',$company->id)}}"><span class="name mb-0 text-sm">{{$company->name}}</span></a>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td>{{$company->contacts->count()}}</td>
                                                </tr>
                                          @endforeach
                                    </tbody>
                              </table>
                        </div>
                  </div>
            </div>
      </div>
</div>

@endsection

@push('js')

<script>

      $(document).ready(() => {
            $("#photoInput").change((e) => {
                  $('.fname').html(e.target.files[0].name);
            });
      });

      $(document).ready(function () {

            $("#companyForm").validate({
                rules: {
                  name :  {
                        required: true,
                  },
                },
                messages: {
                  name: {
                        required: "Name field is required !",
                  },
                },
                normalizer: function( value ) {
                  return $.trim( value );
                },
                errorElement: "span",
                errorClass: "form-text text-danger",
                highlight: function(element) {
                  $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                  $(element).removeClass('is-invalid');
                },
                errorPlacement: function(error, element) {
                  $(element).closest('.form-group-error').append(error);
                }
            });
      });

</script>

@endpush
