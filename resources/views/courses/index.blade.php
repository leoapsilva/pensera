@extends('layout')
@section('content')

<div class="container">
    <course-list :user_id="{{Auth::user()->id}}"></course-list>
</div>

@endsection
