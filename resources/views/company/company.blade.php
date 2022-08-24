@extends('layouts.app')

@section('styles')
    <style>
        .to-do-input {
            background: transparent;
            border: none;
            border-bottom: 1px solid #000000;
            padding: 2px 5px;
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
                                  <li class="breadcrumb-item" aria-current="page"><a href="{{route('company.index')}}">Company</a></li>
                                  <li class="breadcrumb-item active" aria-current="page"><a>{{$company->name}}</a></li>
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
        <div class="col p-5">
            <div class="d-flex justify-content-between p-2 m-2" style="height: 250px">
                <div class="d-flex mt-2 align-items-center">
                    <img class="mx-3 rounded" height="100px" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                    <div class="d-flex align-items-start">
                        <b>{{$company->name}}</b>
                    </div>
                </div>
                <div class="mt-3" style="width: 18rem;">
                    <livewire:todo :company="$company">
                </div>
            </div>
            <div class="nav-wrapper p-2 m-2">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-bs-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">TIMELINE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-bs-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">TICKETS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-bs-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">NOTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-bs-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">ARCHIVED TICKETS</a>
                    </li>
                </ul>
            </div>
            <div class="p-2 mx-2" style="height: 500px">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        @include('company.timeline_data')
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                        @include('company.tickets_data')
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                        @include('company.notes_data')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


