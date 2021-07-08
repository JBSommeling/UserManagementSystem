@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <reset-password
        :fields="{{ $translatedFields }}"
    ></reset-password>
</div>
@endsection