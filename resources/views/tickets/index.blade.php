@extends('layout.master')

@section('styles')
<style>

    .dropdown-list-image {
        position: relative;
        height: 2.5rem;
        width: 2.5rem;
    }
    .dropdown-list-image img {
        height: 2.5rem;
        width: 2.5rem;
    }
    .page-btns{
        border: 1px solid black;
        border-radius: 4px;
        background-color: white;
        padding: 10px;
        margin:10px 0px 20px 0px;
    }
    .dropdown-content{
        width: 100%;
    }

</style>
@endsection

@section('content')

    <div style="background-color: #f5f7f9" class="py-5">

        <div class="container">

            @include('layout.alert')

            <div class="row">
                <div class="card card-custom col-9 px-3 py-2" style="border-radius: 10px;height :500px">
                    @foreach ($tickets as $ticket)
                    <div class="d-flex bd-highlight py-2 px-4 align-items-center rounded my-2">
                        <div class="p-2 bd-highlight">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="p-2 bd-highlight">
                            <div class="text-truncate">{{$ticket->subject}} <i class="fa-solid fa-hashtag"></i> {{$ticket->id}}</div>
                            <div class="text-muted">Created on {{date("d M, Y g:i A", strtotime($ticket->created_at))}} - via Portal</div>
                        </div>
                        <div class="ms-auto bd-highlight">
                            <button class="btn btn-sm btn-outline-danger">Being Processed</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card card-custom col-3 p-3" style="border-radius: 10px">

                    <button class="page-btns">
                        <i class="fa-solid fa-download"></i> Export Tickets
                    </button>

                    <span><b>Status</b></span>
                    <button class="dropdown-toggle page-btns" type="button" id="statusDropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                    </button>
                    <ul class="dropdown-menu dropdown-content" aria-labelledby="statusDropdownMenuButton">
                        <li><a class="dropdown-item" href="#">All Tickets</a></li>
                        <li><a class="dropdown-item" href="#">Open or Pending</a></li>
                        <li><a class="dropdown-item" href="#">Resolved or Closed</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="#">Archive</a></li>
                    </ul>

                    <span><b>Sort by</b></span>
                    <button class="dropdown-toggle page-btns" type="button" id="sortDropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown button
                    </button>
                    <ul class="dropdown-menu dropdown-content" aria-labelledby="sortDropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Date Created</a></li>
                        <li><a class="dropdown-item" href="#">Last Modified</a></li>
                        <li><a class="dropdown-item" href="#">Status</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="#">Ascending</a></li>
                        <li><a class="dropdown-item" href="#">Descending</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
@endsection
