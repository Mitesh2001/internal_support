<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $modelName = "App\\Models\\".$request->model;
        $data = $modelName::where('id',$request->todoable_id)->first();

        $todo = $data->todoes()->create([
            'body' => $request->body,
            'added_by' => auth()->id()
        ]);

        return response()->json([
            'todo' => $todo
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }

    public function markAsDone(Request $request)
    {
        $todo = Todo::where('id',$request->to_do_id)->first();
        $todo->update(['done' => $todo->done ? false : true]);
        return response()->json([
            'todo' => $todo
        ]);
    }

    public function deleteTodo(Request $request)
    {
        $todo = Todo::where('id',$request->to_do_id)->first();
        $todo->delete();
        return response()->json([
            'message' => "To do deleted !"
        ]);
    }

    public function updateDetails(Request $request)
    {
        $todo = Todo::where('id',$request->to_do_id)->first();
        $todo->update(['body' => $request->body]);
        return response()->json([
            'todo' => $todo
        ]);
    }
}
