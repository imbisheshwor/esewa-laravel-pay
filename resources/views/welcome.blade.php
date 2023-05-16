<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Esewa in laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

     
    </head>
    <body >
        <form action="{{route('esewa')}}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="1221">
            <input type="hidden" name="name" value="Bisheshwor Khadka">
            <input type="hidden" name="email" value="test@gmail.com">
            <input type="hidden" name="amount" value="999">

            <input type="submit"  value="Pay with e-sewa">
        </form>
       
    </body>
</html>
