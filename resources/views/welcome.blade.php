<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .list-group-item {
                list-style: none;
            }
            .list-group-item > a {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                {{ config('app.name') }}
                </div>
                <div class="links">
                    <a href="{{ config('app.url') }}/api" target="_blank">API</a>
                    <a href="{{ config('app.url') }}/docs/api/index.html" target="_blank">DOCS</a>
                    <a href="http://localhost/phpmyadmin" target="_blank">PHPMyAdmin</a>
                    <a href="{{ config('app.url') }}/graphql-ui" target="_blank">GraphQL</a>
                </div>
                <br><br>
                <h3>API Products</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ config('app.url') }}/api/products" target="_blank">GET -> Show all products [{{ config('app.url') }}/api/products]</a></li>
                    <li class="list-group-item"><a href="{{ config('app.url') }}/api/products/create" target="_blank">GET -> Import products of the local file (products.xlx) [{{ config('app.url') }}/api/products/create].</a></li>
                    <li class="list-group-item">POST -> Import products of the upload file [{{ config('app.url') }}/api/products/{file}].</li>
                    <li class="list-group-item">GET -> Show a product [{{ config('app.url') }}/api/products/{product}].</li>
                    <li class="list-group-item">PUT -> Edit a product [{{ config('app.url') }}/api/products/{product}].</li>
                    <li class="list-group-item">DELETE -> Delete a product [{{ config('app.url') }}/api/products/{product}].</li>
                </ul>
                <h3>API Sheets</h3>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ config('app.url') }}/api/sheets" target="_blank">GET -> Show all queue sheets [{{ config('app.url') }}/api/sheets]</a></li>
                    <li class="list-group-item">GET -> Show a queue sheet [{{ config('app.url') }}/api/products/{sheet}].</li>
                </ul>
            </div>
        </div>
    </body>
</html>
