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
                    <h1>Pop & Dance </h1>
                    <course-component name="Titulo do Curso" description="Descrição curta do curso vinda do attributo da tag">
                        <lecture-component id="1" name="Aula 1" description="Descrição da aula 1" link="KQ6zr6kCPj8" :selected="true"> </lecture-component>
                        <lecture-component id="2" name="Aula 2" description="Descrição da aula 2" link="HCfPhZQz2CE"> </lecture-component>
                        <lecture-component id="3" name="Aula 3" description="Descrição da aula 3" link="OPf0YbXqDm0"> </lecture-component>
                        <lecture-component id="4" name="Aula 4" description="Descrição da aula 4" link="ZbZSe6N_BXs"> </lecture-component>
                        <lecture-component id="5" name="Aula 5" description="Descrição da aula 5" link="ru0K8uYEZWw"> </lecture-component>
                        <lecture-component id="6" name="Aula 6" description="Descrição da aula 6" link="wyx6JDQCslE"> </lecture-component>    
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
