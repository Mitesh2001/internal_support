<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TicketController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = User::select('name','id')->get();

        $data['tickets'] = Ticket::all();
        $data['priorities'] = $this->priorities;
        $data['types'] = $this->types;
        $data['statuses'] = $this->statuses;
        $data['priority_badges'] = $this->priority_badges;
        $data['sources'] = $this->sources;
        $data['source_icons'] = $this->source_icons;
        $data['agents'] = $agents;
        return view('ticket.index',$data);
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
        $ticket = Ticket::create([
            'requester_id' => $request->requester,
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'type_id' => $request->type_id,
            'source_id' => $request->source_id,
            'status' => $request->status_id,
            'priority_id' => $request->priority_id,
            'description' => $request->description ?? '',
            'agent_id' => $request->agent_id ??0
        ]);

        if ($ticket) {

            $message = "Ticket created successfully !";

            return redirect(route('ticket.index'))->with('success', $message);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $data['ticket'] = $ticket;
        $data['statuses'] = $this->statuses;
        $data['priorities'] = $this->priorities;
        return view('ticket.ticket',$data);
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

    public function changeTicketSource(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->update(['source_id' => $request->source_id]);
        return response()->json([$this->sources[$request->source_id]]);
    }

    public function changePriority(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->update(['priority_id' => $request->priority_id]);
        return response()->json([$this->priorities[$request->priority_id]]);
    }

    public function changeTicketType(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->update(['type_id' => $request->type_id]);
        return response()->json([$this->types[$request->type_id]]);
    }

    public function changeAgent(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->update(['agent_id' => $request->agent_id]);
        return response()->json([getUserName($request->agent_id)]);
    }

    public function changeStatus(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->update(['status' => $request->status_id]);
        return response()->json([$this->statuses[$request->status_id]]);
    }
}
