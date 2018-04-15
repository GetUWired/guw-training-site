@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="text-center">Add Problem</h1>
                {!! Form::open(['action' => 'ProblemController@store', 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    <label for="problem">Problem</label>
                    <input type="text" name="problem" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="php" selected>PHP</option>
                        <option value="javascript">Javascript</option>
                        <option value="jquery">jQuery</option>
                        <option value="html">HTML</option>
                        <option value="css">CSS</option>
                        <option value="sql">SQL</option>
                        <option value="json">JSON</option>
                        <option value="xml">XML</option>
                        <option value="infusionsoft">Infusionsoft</option>
                        <option value="wordpress">WordPress</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="points">Points</label>
                    <input type="number" name="points" class="form-control" required value="0"/>
                </div>
                <div class="form-group">
                    <label for="hint">Hint</label>
                    <div v-for="hint in hints">
                        <textarea name="hint[]" class="form-control hintBox" v-model="hint.value"></textarea>
                    </div>
                    <a @click="addHint" class="btn btn-info btn-xs hintBtn">New Hint</a>
                </div>
                <div class="form-group">
                    {!! Form::submit('Add New Problem', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
