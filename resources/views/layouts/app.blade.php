<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')    

    <body>
        @include('partials.header')

        <main>
            @yield('content')
        </main>
        
    </body>
</html>
