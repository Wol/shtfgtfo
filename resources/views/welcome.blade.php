<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="/css/app.css">

        <script src="/js/manifest.js"></script>
        <script src="/js/vendor.js"></script>
        <script src="/js/app.js"></script>
        <!-- Styles -->

    </head>
    <body>
        <div ng-app="app">

            <script>
                // Only to save repeating but shouldn't do anything "special"
                var __rootvariables = {
                    app: {
                        name: "This is my app",
                        env: "THING"
                    },
                };
            </script>

            <app>
                Loading...
            </app>

        </div>



    </body>
</html>
