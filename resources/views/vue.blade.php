<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="title-template" content="%s - {{ config('app.name') }}" />

    <link rel="stylesheet" href="/css/app.css"/>
</head>
<body>
<div id="app"></div>

<script src="/js/app.js"></script>
</body>
</html>