@extends('page')

@section('content')
    <h2>Tickets</h2>
    <p>
        This is a list of all handed tickets.
    </p>

    <table class="table">
        <thead>
        <tr>
            <th>Bak name</th>
            <th>Ticket Number</th>
            <th>Webcode</th>
            <th>Amount</th>
            <th>Amount Given</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td><a href="{{route('bak.view', $ticket->bak->id)}}">{{$ticket->bak->name}}</a></td>
                <td>{{$ticket->ticket_number}}</td>
                <td>{{$ticket->webcode}}</td>
                <td>&euro; {{$ticket->amount}}</td>
                <td>&euro; {{$ticket->given}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection