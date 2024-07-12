<!DOCTYPE html>
<html>

<head>
    <title>Message</title>
</head>

<body>
    <h1>{{ $data['subject'] }}</h1>
    <p>{{ $data['message'] }}</p>
    <p>From: {{ $data['name'] }} - {{ $data['email'] }}</p>
</body>

</html>
