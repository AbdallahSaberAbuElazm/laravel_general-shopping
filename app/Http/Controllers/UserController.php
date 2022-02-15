<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with(['billingAddress'])->paginate(env('PAGINATION_CODE'));
        return view('admin.customers.users')->with([
            'users' => $users,
        ]);
    }

    public function show(Request $request)
    {
        return $request->user();
    }
}
