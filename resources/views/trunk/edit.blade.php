@extends('page')

@section('content')
    <h2>Edit trunk {{$trunk->number}}</h2>
    <p>You can edit the amount of available new bills in this trunk, you can also edit the type of bill in this trunk.</p>

    <form action="" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="form-group col-md-12">
                <label for="available">Number of bills available:</label>
                <input type="number" id="available" name="available" value="{{$trunk->available}}" placeholder="Number of bills available" class="form-control">
            </div>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="3" class="form-control">{{$trunk->description}}</textarea>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection