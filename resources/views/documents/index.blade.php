<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
</head>

<body>
    @if($message = Session::get('success'))
        <div><p>{{$message}}</p></div>
    @endif
    @if($message = Session::get('error'))
        <div><p>{{$message}}</p></div>
    @endif

    <table border="1px">
        <thead>
        <tr>
        <th>attachments</th>
        </thead>
        <tbody>
            @foreach ($companies as $company)
            <tr>
                <td>{{$empdocs->attachments}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>