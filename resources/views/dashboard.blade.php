@extends('layouts.app')

@section('content')
    <h1>Manage clients</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Surname</th>
            <th>e-mail</th>
            <th>country</th>
            <th>Trading account</th>
            <th>Balance</th>
            <th>Open trades</th>
            <th>Close trades</th>
            <th></th>
        </tr>
        </thead>
        @forelse ($clients as $client)
        <tr>
            <th>{{$client->id}}</th>
            <th>{{$client->name}}</th>
            <th>{{$client->surname}}</th>
            <th>{{$client->email}}</th>
            <th>{{$client->country}}</th>
            <th>{{$client->getAttribute('trading-account-number')}}</th>
            <th>{{$client->balance}}</th>
            <th>{{$client->getAttribute('open-trades')}}</th>
            <th>{{$client->getAttribute('close-trades')}}</th>
            <th><a class="btn btn-primary btn-sm">Edit</a></th>
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
