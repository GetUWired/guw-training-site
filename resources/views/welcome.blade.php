@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height homePage">
        <div class="content">
            <div class="title m-b-md">
                Training Site
            </div>

            <div class="col-md-8 col-md-offset-2">
                <p>This site is split up into two different sections. The first is by language specific
                    problems that
                    can be solved on their own. The second section are Problem Sets which are a grouping of problems
                    using different languages and technologies to build a complete solution. These are intended to be
                    solved in order to complete the set and once you have completed it you should have a working program
                    .</p>
                <p>After you solve your first problem go over it with one of your peers and run through how you
                    went about solving the problem and see if they have any feedback. This will probably work
                    best if you pick someone who has already completed that challenge problem. Once you have
                    went over it with someone check it off and view your current position on the
                    leaderboard. This is a fun way to help push each other to better our skills and grow as a team.</p>
                <p>This site can be made much better by expanding on the problems in the database so if you have a
                    great idea for something to add simply create an email with the problem in detail and add in any
                    hints for the problem(s) you are submitting and email them to <a href="mailto:gseymour@getuwired.com">me</a>. If you are creating a problem set that requires multiple languages just separate
                    them out in the email and label the language.
                </p>
        </div>
    </div>
@endsection
