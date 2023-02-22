<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="app-theme" content="ligth">

        @spladeHead
        @vite('resources/js/app.js')
    </head>
    <body class="font-sans antialiased h-full w-full dark:bg-dark">
        @splade
    </body>
</html>
