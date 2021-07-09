@extends('layouts.app')

@section('content')
<div class="container">
    @if(Request::exists('message'))
        <div class="alert alert-success">
            {{ __('messages.password_changed') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello World</div>

                <div class="card-body">
                   Welcome to the User Management System
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
