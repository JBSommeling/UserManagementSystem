<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerValidationRequest;
use App\Http\Requests\ResetPasswordValidationRequest;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * Method to compare input answer with answer from database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function compare(AnswerValidationRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        return $user->answer === $request->answer? true : false;
    }

    /**
     * Method to reset the password.
     *
     * @param  mixed $request
     * @return void
     */
    public function resetPassword(ResetPasswordValidationRequest $request) 
    {
        $user = User::where('email', $request->email)->first();

        if ($request->answer === $user->answer) {
            $user->password = Hash::make($request->password);
            $user->save();
        } else {
            abort(403);
        }
    }
}
