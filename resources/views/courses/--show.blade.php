<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <div id="app">

        <div class="container">
            <tabs name="bla">
                <tab name="Course" :selected="true">
                    <course-panel :id={{$course->id}}></course-panel>
                </tab>
                <tab name="Students" >
                    <h1> Here you have all students enrolled on the course. </h1>
                </tab>
                <tab name="Edit">
                    <h1> Here you can edit you course. </h1>
                </tab>
            </tabs>
        </div>

    </div>

    <script src="{{asset('js/app.js')}}"></script>

    </body>

</html>
