@extends('layouts.app')

@section('content')
    <h1>Manage users</h1>
    <a href="{{route('user.create')}}" class="btn btn-success">{{__('Add new user')}}</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('E-mail')}}</th>
            <th>{{__('Role')}}</th>
            <th></th>
        </tr>
        </thead>
        @foreach ($users as $user)
        <tr>
            <th>{{$user->id}}</th>
            <th>{{$user->email}}</th>
            <th>{{$roles[$user->getAttribute('role-id')]['name']}}</th>
            <th>
                <div class="row">
                <a class="btn btn-primary btn-sm" href="{{ route('user.edit', ['user' => $user->id]) }}">{{__('Edit')}}</a>
                &nbsp;
                @if(Auth::user()->id != $user->id)
                    <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this user?');">{{__('Remove')}}</button>
                    </form>
                @endif
                </div>
            </th>
        </tr>
        @endforeach
    </table>
@endsection
