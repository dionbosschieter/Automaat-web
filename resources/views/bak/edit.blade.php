@extends('page')

@section('content')
    <h2>Edit {{$bak->name}}</h2>
    <p>You can edit the amount of money left in the bak.</p>

    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{$bak->name}}" placeholder="Name" class="form-control">
        </div>

        <div class="form-group">
            <label for="apikey">Api Key:</label>
            <input type="text" id="apikey" name="apikey" value="{{$bak->apikey}}" placeholder="Api Key" class="form-control">
        </div>
        <p class="text-muted">The api key is used to map the incoming requests to the right machine in the database.</p>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection