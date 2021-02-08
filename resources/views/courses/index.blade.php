@extends('layout')
@section('content')

<div class="container">
    <tabs name="bla">
        <tab name="Courses" :selected="true">
            <course-list></course-list>
        </tab>
    </tabs>
</div>

@endsection
