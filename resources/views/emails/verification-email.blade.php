<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Verification Email') }}</title>
</head>
<body>
    <h1>{{ __('Hello ') . $user_name }} </h1>
    <p>{{ __('Your validation code is ') . $verification_code }}</p>
</body>
</html>
