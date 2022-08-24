@extends('layouts.app')

@section('styles')
      <style>

            .personal-image {
                  text-align: center;
            }

            .personal-image input[type="file"] {
                  display: none;
            }

            .personal-figure {
                  position: relative;
                  width: 120px;
                  height: 120px;
            }

            .personal-avatar {
                  cursor: pointer;
                  width: 120px;
                  height: 120px;
                  box-sizing: border-box;
                  border-radius: 100%;
                  border: 2px solid transparent;
                  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
                  transition: all ease-in-out .3s;
            }

            .personal-avatar:hover {
                  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
            }

            .personal-figcaption {
                  cursor: pointer;
                  position: absolute;
                  top: 0px;
                  width: inherit;
                  height: inherit;
                  border-radius: 100%;
                  opacity: 0;
                  background-color: rgba(0, 0, 0, 0);
                  transition: all ease-in-out .3s;
            }

            .personal-figcaption:hover {
                  opacity: 1;
                  background-color: rgba(0, 0, 0, .5);
            }

            .personal-figcaption > img {
                  margin-top: 32.5px;
                  width: 50px;
                  height: 50px;
            }

            /* ------------------------- */

            .form-body{
                  height: 500px;
                  overflow-y: scroll;
            }

      </style>
@endsection

@section('content')

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
            <div class="header-body">
                  <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                          <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                                          <li class="breadcrumb-item active" aria-current="page"><a>Contacts</a></li>
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
                              <h3 class="mb-0">All Contacts</h3>
                        </div>

                        <div class="table-responsive">
                              <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                          <tr>
                                                <th scope="col" class="sort" data-sort="contact">Contact</th>
                                                <th scope="col" class="sort" data-sort="title">Title</th>
                                                <th scope="col">Email Address</th>
                                                <th scope="col">Work phone</th>
                                                <th scope="col">Twitter</th>
                                          </tr>
                                    </thead>
                                    <tbody class="list">
                                          @foreach ($contacts as $contact)
                                                <tr>
                                                      <th scope="row">
                                                            <div class="media align-items-center">
                                                                  <a href="{{route('contact.show',$contact->id)}}" class="avatar rounded-circle mr-3">
                                                                        {{-- <img src="{{url('')."/".$contact->photo}}"> --}}
                                                                        <img src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                                                                  </a>
                                                                  <div class="media-body">
                                                                    <a class="text-dark" href="{{route('contact.show',$contact->id)}}"><span class="name mb-0 text-sm">{{$contact->full_name}}</span></a>
                                                                  </div>
                                                            </div>
                                                      </th>
                                                      <td>
                                                            <span>{{$contact->title ?? "--" }}</span>
                                                      </td>
                                                      <td>
                                                            <span><b>{{$contact->email ?? "--" }}</b></span>
                                                      </td>
                                                      <td>
                                                            <span>{{$contact->work_phone ?? "--" }}</span>
                                                      </td>
                                                      <td>
                                                            <span><b>{{$contact->twitter_id ?? "--" }}</b></span>
                                                      </td>
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

            $("#contactForm").validate({
                rules: {
                  full_name :  {
                        required: true,
                  },
                },
                messages: {
                  full_name: {
                        required: "Enter Full Name !",
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
