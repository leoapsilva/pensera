<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <div id="app">

        <div class="container">
            <tabs name="bla">
                <tab name="Course" :selected="true">
                    <course-component id="{{$course->id}}" name="{{$course->name}}" description="{{$course->description}}">
                        @foreach ($course->lectures as $lecture)
                            <lecture-component id="{{$lecture->id}}" name="{{$lecture->name}}" description="{{$lecture->description}}" link="{{$lecture->link}}" :selected="true"> </lecture-component>
                        @endforeach
                    </course-component>
                </tab>
                <tab name="Students" >
                    <h1> Here is the content of the our culture. </h1>
                </tab>
                <tab name="Edit">
                    <h1> Here is the content of the contact us. </h1>
                </tab>
            </tabs>
        </div>

    </div>

    <script src="{{asset('js/app.js')}}"></script>

    </body>

</html>
