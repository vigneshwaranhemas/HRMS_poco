


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

      
                <p><b>Dear {{$candidate_name}},</b></p>

                <p> Click the link to </p>

                <a href="{{ url('/email_pass?token='.$passcode_token.'') }}">Link Text</a>

                <p><b>Thank you,</b></p>
                <p>HR Team- HEPL</p>
      


</body>
</html>
