<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * ForgotPasswordController
 * Controller that manages incoming forgotten password requests.
 */
class ForgotPasswordController extends Controller
{
    
    /**
     * resetPassword
     * Method to render view which validates email and resets password.
     * 
     * @return void
     */
    public function resetPassword() {
        $translatedFields = json_encode([
            'title' => trans('forms.reset'),
            'email' => trans('forms.email'),
            'answer' => trans('forms.answer'),
            'submit' => trans('buttons.submit'),
            'answer_not_found' => trans('passwords.answer_not_found'),
        ]);

        return view('auth.passwords.reset', compact('translatedFields'));
    }
}
