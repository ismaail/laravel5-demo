<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>{{ $exception->getMessage() }} | 404 Error</title>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <style>
        html, body {
            height: 100%;
        }

        body {
            display: table;
            width: 100%;
            margin: 0;
            padding: 0;
            color: #B0BEC5;
            font-weight: 100;
            font-family: "Lato";
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="title"><strong>404 Error</strong></div>
            <div class="title">{{ $exception->getMessage() }}</div>
        </div>
    </div>
</body>
</html>