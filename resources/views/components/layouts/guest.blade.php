<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-[#1A1A1A] antialiased" style="background-color: #1A1A1A !important;">
        <div class="min-h-svh" style="background-color: #1A1A1A !important;">
            {{ $slot }}
        </div>
        @fluxScripts
    </body>
</html>
