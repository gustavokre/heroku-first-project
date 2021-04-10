<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, user-scalable=0" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('imgs/logo-color.png') }}"/>
	<link href="https://fonts.googleapis.com/css?family=Orbitron&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>wf-relics</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app" v-bind:style="fundo">
        <router-view></router-view>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>