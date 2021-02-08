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
                    <course-list></course-list>

{{--                     <course-component v-for="lecture in courses" v-bind:key="lecture.id" v-text="lecture">
                        
                    </course-component>
 --}}{{--                     <course-component v-for="lecture in course" v-bind:key="lecture.id"
                        :name=@{{course.name}} :description=@{{course.description}}">
                        <lecture-component  :id=@{{lecture.id}} 
                                            :name=@{{lecture.name}} 
                                            :description=@{{lecture.description}} 
                                            :link=@{{lecture.link}} 
                                            :selected="true"> </lecture-component>
                    </course-component>
 --}}                </tab>
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
