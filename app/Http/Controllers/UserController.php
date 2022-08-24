<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }

    public function getAgents(Request $request)
    {
        $name = $request->get('q');
        $users = User::select('id','name')
                ->where('name', 'like', "%{$name}%")
                ->get();

        $response = [];

        foreach ($users as $key => $user) {
            $response[] = [
                'id' => $user->id,
                'text' => $user->name
            ];
        }

        return response()->json($response);
    }
}
