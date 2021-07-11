@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('forms.edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                   
                        @foreach ($fields as $key => $field)
                        <div class="form-group row">
                            <label for="{{ $key }}" class="col-md-4 col-form-label text-md-right">{{ __('forms.'.$key) }}</label>

                            <div class="col-md-6">
                                @if ($key === 'password' || $key === 'password_confirmation')
                                    <input id="{{ $key }}" type="password" class="form-control @error($key) is-invalid @enderror" name="{{ $key }}" value="{{ old($key) }}{{ $field }}" autocomplete="{{$key}}" autofocus>
                                @else 
                                    <input id="{{ $key }}" type="text" class="form-control @error($key) is-invalid @enderror" name="{{ $key }}" value="{{ old($key) }}{{ $field }}" required autocomplete="{{$key}}" autofocus>
                                @endif

                                @error($key)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endforeach
                    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('buttons.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
