<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditCredentialsRequest;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        $message = $request->message;
        return view('admin.users.index', compact('users', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        // Get all request inputs.
        $data = $request->only(
            [
                'name',
                'lastname',
                'email',
                'password',
                'question',
                'answer',
            ]
        );

        // Hash the given password
        $data['password'] = Hash::make($request->password);
        
        // Create user
        User::create($data);

        return redirect()->route('admin.panel', ['message' => trans('messages.user_created')]);
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
        
        return view('admin.users.edit', compact('fields', 'user'));
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
        $user = User::findOrFail($id);

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
                ]
            );

        // If the password is blank then use old password.
        if (empty($request->password)) {
            $data['password'] = $user->password;
        }
        
        // Update the given data in the user model.
        $user->update($data);

        return redirect()->route('admin.users.index', ['message' => trans('messages.user_edited')]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User ophalen
        $user = User::findOrFail($id);

        // User verwijderen
        $user->delete();

        return redirect()->route('admin.users.index', ['message' => trans('messages.user_deleted')]);
    }
}
