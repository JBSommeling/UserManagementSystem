@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('navigation.admin_panel') }}</div>

                    <div class="card-body">
                        {{ __('forms.create_user') }}
                        
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf    
                    
                            @foreach ($fields as $field)
                                <div class="form-group row">
                                    <label for="{{ $field }}" class="col-md-4 col-form-label text-md-right">{{ __('forms.'.$field) }}</label>

                                    <div class="col-md-6">
                                        <input id="{{ $field }}" type="text" class="form-control @error($field) is-invalid @enderror" name="{{ $field }}" value="{{ old($field) }}" required autocomplete="{{$field}}" autofocus>

                                        @error($field)
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
</div>
@endsection