<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Array with user data and fields.
        $fields = [
            'name',
            'lastname',
            'email',
            'password',
            'password_confirmation',
            'question',
            'answer',
        ];
        
        return view('admin.index', compact('fields'));
    }
}
