@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron"><h1 class="text-center">Problem Sets</h1></div>
        <div id="setWrap">
            @forelse($sets as $set)
                <a class="item" href="{{ route('singleset', ['id' => $set->id]) }}">{{ $set->id }} <br> {{ $set->name
                 }}</a>
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
        {{ $sets->links() }}
    </div>
@endsection
