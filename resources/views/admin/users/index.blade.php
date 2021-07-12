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
                <div class="card-header">{{ __('navigation.user_index') }}</div>

                <div class="card-body">
                    <div class="accordion" id="userAccordion">
                        @foreach($users as $user)
                            <div class="card">
                                <div class="card-header" id="heading_{{ $user->id }}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link text-left m-2" type="button" data-toggle="collapse" data-target="#collapse_{{ $user->id }}" aria-expanded="true" aria-controls="collapse_{{ $user->id }}">
                                            {{ $user->name }} {{ $user->lastname }} 
                                        </button>
                                        <form class="d-inline-block float-right" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button class="btn btn-danger float-right m-2" onclick="return confirm('Are you sure you wish to delete this user?')">{{__('buttons.delete_user')}}</button>
                                        </form>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"><button class="btn btn-success float-right m-2">{{ __('buttons.edit_user') }}</button></a>
                                    </h2>
                                </div>

                                <div id="collapse_{{ $user->id }}" class="collapse" aria-labelledby="heading_{{ $user->id }}" data-parent="#userAccordion">
                                    <div class="card-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">{{ $user->name }} {{ $user->lastname }}</th>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection