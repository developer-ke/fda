<!DOCTYPE html>
<html>

<head>
    <title>Message</title>
</head>

<body>
    <h1>Found Document</h1>
    <p>Hello {{ $data['Owners_first_name'] }}, Hope this message finds you very well, you are receiving this message
        because the document you reported as lost time as lost has been found.</p>
    <p>{{ env('APP_NAME') }}- {{ env('MAIL_FROM_NAME') }}</p>
</body>

</html>
