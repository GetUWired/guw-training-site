@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="text-center">Add Problem Set</h1>
                {!! Form::open(['action' => 'ProblemController@store', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    <label for="problem">Name</label>
                    <input type="text" name="name" class="form-control" required/>
                </div>
                
                <div class="form-group">
                    {!! Form::submit('Add New Problem', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
