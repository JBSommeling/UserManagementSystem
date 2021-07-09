<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailValidationRequest;

class EmailController extends Controller
{
    /**
     * Method to validate email and search for the question that belongs to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EmailValidationRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        return $user->question;
    }
}
