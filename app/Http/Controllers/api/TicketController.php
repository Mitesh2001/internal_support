<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $states = [
        0 => '--',
        1 => 'unresolved',
        2 => 'Overdue',
        3 => 'Due Today',
        4 => 'Open',
        5 => 'On hold',
        6 => 'Unassigned'
    ];

    public $types = [
        0 => '--',
        1 => 'Question',
        2 => 'Incident',
        3 => 'Problem',
        4 => 'Feature Request',
        5 => 'Refund'
    ];

    public $sources = [
        0 => '--',
        1 => 'Phone',
        2 => 'Email'
    ];

    public $source_icons = [
        0 => '',
        1 => 'fas fa-phone',
        2 => 'fas fa-envelope'
    ];

    public $statuses = [
        0 => '--',
        1 => 'Open',
        2 => 'Pending',
        3 => 'Resolved',
        4 => 'Closed'
    ];

    public $priorities = [
        0 => '--',
        1 => 'Low',
        2 => 'Medium',
        3 => 'High',
        4 => 'Urgent'
    ];

    public $priority_badges = [
        0 => 'light',
        1 => 'success',
        2 => 'primary',
        3 => 'warning',
        4 => 'danger'
    ];


    public function index()
    {
        $data = [
            'states' => $this->states,
            'types' => $this->types,
            'sources' => $this->sources,
            'source_icons' => $this->source_icons,
            'statuses' => $this->statuses,
            'priorities' => $this->priorities,
            'priority_badges' => $this->priority_badges,
            'agents' => User::select('name','id')->get()
        ];

        $tickets = Ticket::with('agent','contact')->get();
        return response()->json([
            'tickets' => $tickets,
            'ticket_data' => $data,
            'status' => 'SUCCESS',
            'message' => 'All tickets fetched !'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function changeTicketDetails(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->update([$request->column_name => $request->data_id]);
        return response()->json([
            'status' => 'SUCCESS',
            'message' => 'Data changed !',
        ]);
    }

}
