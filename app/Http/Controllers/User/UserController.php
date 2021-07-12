<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditCredentialsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isSameUser', ['except' => 'index']);
        $this->middleware('isBlockedUser');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $message = $request->message;
        return view('users.index', compact('message'));   
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get user
        $user = User::findOrFail($id);  
        
        // Array with user data and fields.
        $fields = [
            'name' => $user->name,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'password' => '',
            'password_confirmation' => '',
            'question' => $user->question,
            'answer' => $user->answer,
        ];
        
        return view('users.edit', compact('fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCredentialsRequest $request, $id)
    {
        // To find the user.
        $user = User::find($id);

        // To evaluate whether the given email is already in use.
        if ($user->count !== 0 && $user->email !== $request->email) {
            $validated = $request->validate([
                'email' => 'unique:users'
            ]);
        }

        // Get all request inputs.
        $data = $request->only(
                [
                    'name',
                    'lastname',
                    'email',
                    'question',
                    'answer',
                    'password',
                ]
            );

        // If the password is blank then use old password.
        if (empty($request->password)) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = Hash::make($request->password);
        }
        
        // Update the given data in the user model.
        $user->update($data);

        return redirect()->route('users.index', ['message' => trans('messages.credentials_edited')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
