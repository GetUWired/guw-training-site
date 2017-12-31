@extends('layouts.app')

@section('content')
    <div class="jumbotron"><h1 class="text-center">{{ $set->name }}</h1></div>
    <div class="row">
        <div class="container">
            <div class="breadcrumbs">
                @if( url()->previous() != URL::current() )
                    <a href="{{ url()->previous() }}"
                            class="btn btn-info mb-3">Back to Sets
                    </a>
                @else
                    <a href="{{ url('/sets') }}"
                            class="btn btn-info mb-3">Back to Sets
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="setContainer">
        @forelse($set->problems as $problem)
            <div class="setItem">
                <div>
                    <div>
                        <span class="align-bottom">Available Points: {{ $problem->points }}
                            @if($problemRelations->count() > 0 )
                                @foreach($problemRelations as $relation)
                                    @if($relation->pivot->problem_id == $problem->id)
                                        <?php $checked = 'checked'; ?>
                                        @break
                                    @else
                                        <?php $checked = ''; ?>
                                    @endif
                                @endforeach
                            @else
                                <?php $checked = ''; ?>
                            @endif&nbsp;
                        </span></div>
                    <div>
                        <h2 class="text-uppercase itemTypeFlex"><input type="checkbox" @click="toggleProblemCompletion
                        ($event)" {{ $checked }} name="{{ $problem->question }}" value="{{ $problem->id }}">
                            <strong>{{ $problem->type }}</strong></h2>
                    </div>
                </div>
                <a class="itemLink" href="{{ route('singleproblem', $problem->id) }}"></a>
            </div>
            @if(!$loop->last)
                <div class="arrowWrap"><i class="rightArrow {{ ($checked == 'checked') ? 'completed' : '' }}">&#10144;
                    </i></div>
            @endif
        @empty
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Problems</div>
                        <div class="panel-body">
                            <p>No results were found.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
