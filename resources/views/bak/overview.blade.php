@extends('page')

@section('content')
    <h2>Overview</h2>
    <p>
        This is an overview of all the machines, with their current state and values. <br/>
        You can click on the name to view the tickets and click the edit button on the right when you want to edit them.
    </p>
    
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bak as $b)
        <tr>
            <td><a href="{{route('bak.view', $b->id)}}">{{$b->name}}</a></td>
            <td>&euro; {{$b->amount}},-</td>
            <td>{{trans("status.{$b->status}")}}</td>
            <td><a href="{{route('bak.edit', $b->id)}}"><span class="fui-new"></span></a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection