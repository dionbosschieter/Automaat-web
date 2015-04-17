@extends('page')

@section('content')
    <div class="row">
        <div class="col-xs-6"><h2>Bak {{$bak->name}}</h2></div>
        <div class="col-xs-6 text-right h2-button-right">
            <a href="{{route('bak.edit', $bak->id)}}" class="btn btn-primary"><span class="fui-new"></span> Edit</a>
        </div>
    </div>

    <p>
        You can view the amount of money that is stored in the bak at the moment, and see the tickets that have been used to retrieve money on this machine.
    </p>

    <table>
        <tbody>
        <tr>
            <th width="100">Amount:</th> <td><span class="text-primary">&euro; {{$bak->amount}},-</span></td>
        </tr>
        <tr>
            <th width="100">Status:</th> <td><span class="text-primary">{{trans("status.{$bak->status}")}}</span></td>
        </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6">
            <h3>Trunks</h3>
        </div>
        <div class="col-md-6 h2-button-right text-right">
            <a href="{{route('bak.closetrunks', $bak->id)}}" {{$bak->status == 2 ? "disabled" : ""}} class="btn btn-primary"><span class="fui-lock"></span> Close trunks</a>
        </div>
    </div>
    <p>
        If you want to refill the money trunks, wait for the bak to be in waiting state and click the close trunks button.
    </p>

    <table class="table">
        <thead>
        <tr>
            <th>Nr</th>
            <th>Bil type</th>
            <th>Amount available</th>
            <th>Description</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bak->trunks as $trunk)
            <tr>
                <td>{{$trunk->number}}  </td>
                <td>&euro; {{$trunk->bill_type}}</td>
                <td>&euro; {{$trunk->available * $trunk->bill_type}}</td>
                <td>{{$trunk->description}}</td>
                <td><a href="{{route('trunk.edit', $trunk->id)}}"><span class="fui-new"></span></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <h3>Tickets</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Ticket Number</th>
            <th>Webcode</th>
            <th>Amount</th>
            <th>Amount Given</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bak->tickets as $ticket)
            <tr>
                <td>{{$ticket->ticket_number}}</td>
                <td>{{$ticket->webcode}}</td>
                <td>&euro; {{$ticket->amount}}</td>
                <td>&euro; {{$ticket->given}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
