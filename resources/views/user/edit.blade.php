@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">{{ __('Editing user information') }}</h1>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', isset($user->email) ? $user->email : '') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role-id" class="col-md-4 col-form-label text-md-right">{{ __('Select role') }}</label>

                                <div class="col-md-6">
                                    <select id="role-id" name="role-id" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if ($user->getAttribute('role-id') == $role->id) selected="" @endif>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update user data') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('user.index') }}">{{__('<< Return to user list')}}</a>
            </div>
        </div>
    </div>
@endsection
