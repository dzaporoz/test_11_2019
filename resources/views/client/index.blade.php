@extends('layouts.app')

@section('content')
    <h1>Manage clients</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="width: 40px;">#</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Phone number</th>
            <th>E-mail</th>
            <th>Country</th>
            <th style="width: 110px;">Trading acc.</th>
            <th style="width: 120px;">Balance</th>
            <th style="width: 110px;">Open trades</th>
            <th style="width: 110px;">Close trades</th>
            <th></th>
        </tr>
        </thead>
        @forelse ($clients as $client)
        <tr>
            <th>{{$client->id}}</th>
            <th>{{$client->name}}</th>
            <th>{{$client->surname}}</th>
            <th>{{$client->getAttribute('phone-number')}}</th>
            <th>{{$client->email}}</th>
            <th>{{$client->country}}</th>
            <th>{{$client->getAttribute('trading-account-number')}}</th>
            <th>{{$client->balance}}</th>
            <th>{{$client->getAttribute('open-trades')}}</th>
            <th>{{$client->getAttribute('close-trades')}}</th>
            <th><a class="btn btn-primary btn-sm" href="{{ route('client.edit', ['client' => $client->id]) }}">Edit</a></th>
        </tr>
        @empty
            <tr><td class="text-center" colspan="9">there are no any clients</td></tr>
        @endforelse
        <tfoot>
            <tr>
                <td colspan="9">
                    <ul class="pagination pull-right">
                        {{$clients->links()}}
                    </ul>
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
