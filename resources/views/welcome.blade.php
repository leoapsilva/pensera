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
                    <h1>Título do curso </h1>
                    <course-component title="Titulo do Curso" description="Descrição curta do curso vinda do attributo da tag">
                        <lecture-component title="Aula 1" description="Descrição da aula 1" link="KQ6zr6kCPj8" :selected="true"> </lecture-component>
                        <lecture-component title="Aula 2" description="Descrição da aula 2" link="HCfPhZQz2CE"> </lecture-component>
                        <lecture-component title="Aula 3" description="Descrição da aula 3" link="OPf0YbXqDm0"> </lecture-component>
                        <lecture-component title="Aula 4" description="Descrição da aula 4" link="ZbZSe6N_BXs"> </lecture-component>
                        <lecture-component title="Aula 5" description="Descrição da aula 5" link="ZbZSe6N_BXs"> </lecture-component>
                        <lecture-component title="Aula 6" description="Descrição da aula 6" link="ZbZSe6N_BXs"> </lecture-component>
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
