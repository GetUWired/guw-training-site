@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron gradient"><h1 class="text-center"><span class="text-uppercase">{{ $problem->type
        }}</span> Problem</h1></div>
        <div class="breadcrumbs">
            <a href="{{ ( url()->previous() != URL::current() ) ? url()->previous() : url('/sets') }}" class="btn
            btn-info">Back</a>
        </div>
        <h3 class="text-center questionHeader">{!! $problem->question !!}</h3>
        @if($problem)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading language-wrapper">
                        <span class="align-right">Available Points: {{ $problem->points }}
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
                            @endif&nbsp;&nbsp;
                            <input type="checkbox" @click="toggleProblemCompletion($event)" name="{{ $problem->question }}"
                                   {{ $checked }} value="{{ $problem->id }}">
                        </span></div>
                    <div class="panel-body">
                        <button class="btn btn-primary btn-xs" type="button" data-toggle="collapse"
                                data-target="#collapse-{{ $problem->id }}" aria-expanded="false"
                                aria-controls="collapseExample">Show Hint
                        </button>
                        <div class="collapse" id="collapse-{{ $problem->id }}">
                            <h4><strong>Hint:</strong></h4>
                            @if($problem->hints)
                                <div class="card card-block">
                                    <code>{!! $problem->hints->hint !!}</code>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
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
        @endif
    </div>
@endsection
