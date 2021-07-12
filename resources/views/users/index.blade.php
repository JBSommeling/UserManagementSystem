@extends('layouts.app')

@section('content')
<div class="container">
    @if(Request::exists('message'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Logged In</div>

                <div class="card-body">
                    Hello World
                </div>
            </div>
        </div>
    </div>
</div>
@endsection