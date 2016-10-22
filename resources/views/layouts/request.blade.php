<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | Request Form</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="{{ config('meta.description') }}" name="description" />
    <meta content="{{ config('meta.author') }}" name="author" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous"> -->


    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Uniform.js/4.0.1/css/default.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="/css/app.css">

    <link rel="shortcut icon" href="favicon.ico" />

    <style type="text/css">
        h1{
            font-size: 40px;
            font-weight: 700;
        }
        .panel-body{
            padding: 100px;
        }
        .title-header{
            margin: 30px;
            color: #fff;
        }
        .form-group > label{
            font-weight: 700;
            font-size: 16px;
            color: #a4a4a4;
        }
        legend{
            font-weight: 700;
            font-size: 24px;
        }
    </style>

</head>

<body>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>