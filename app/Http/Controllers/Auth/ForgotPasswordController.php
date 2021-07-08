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
        return view('auth.passwords.reset');
    }
}
