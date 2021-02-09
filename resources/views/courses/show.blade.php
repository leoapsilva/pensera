@extends('layout')
@section('content')

    <div class="container">
        <a href="/courses"> Courses </a> > {{$course->name}}
    </div>
    <div class="container">
            <tabs name="bla">
                <tab name="{{$course->name}}" :selected="true">
                    <course-component id="{{$course->id}}" name="{{$course->name}}"
                        description="{{$course->description}}">
                        @foreach ($course->lectures as $lecture)
                        <lecture-component id="{{$lecture->id}}" name="{{$lecture->name}}"
                            description="{{$lecture->description}}" link="{{$lecture->link}}" :selected="true">
                        </lecture-component>
                        @endforeach
                    </course-component>
                </tab>
                <tab name="Students">
                    <h1> Here is the content of the our culture. </h1>
                </tab>
                <tab name="Edit">
                    <h1> Here is the content of the contact us. </h1>
                </tab>
            </tabs>
        </div>
@endsection
