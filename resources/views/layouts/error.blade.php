<html>
<head>
    <style>
        body {
            color: #222;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-weight: 100;
            display: table;
            height: 100%;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .container {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }

        .content {
            display: inline-block;
            text-align: center;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
    <title>@yield('title', 'Error')</title>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">
            @yield('title', 'Error')
        </div>

        @yield('content')
    </div>
</div>
</body>
</html>
