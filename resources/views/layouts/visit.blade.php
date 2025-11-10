<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('partials.head')    

    <body>

        <main>
            @yield('content')
        </main>
        
    </body>
</html>