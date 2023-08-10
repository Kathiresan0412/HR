<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
=======
    <title>Employee Documents</title>
    <script src="https://nchhr.apptimus.lk/js/app.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://nchhr.apptimus.lk/css/app.css" rel="stylesheet">
    <link href="https://nchhr.apptimus.lk/css/common.css" rel="stylesheet">
    <link href="https://nchhr.apptimus.lk/css/common2.css" rel="stylesheet">
    <link href="https://nchhr.apptimus.lk/css/nch.css" rel="stylesheet">
    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://nchhr.apptimus.lk/css/select2-bootstrap4.min.css" rel="stylesheet" />
    <link href="https://nchhr.apptimus.lk/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="https://nchhr.apptimus.lk/css/tree.css" rel="stylesheet" />
    <link href="https://nchhr.apptimus.lk/css/smart_wizard_all.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
</head>

<body>
    <div class="card border-box border-primary mt-2 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title ">Employee Documents</h3>
                <button type="button" class="btn btn-md btn-link" data-toggle="modal"
                    data-target="#vaccines-information"><a href="{{route('create_value')}}"></a><i class="fas fa-plus"></i>Add</button>
            </div>
            <table class="table">
                <thead class="thead">
                    <tr>
                        <th scope="col">O/LEVEL & A/LEVEL RESULTS SHEETS</th>
                        <th scope="col">BANK BOOK</th>
                        <th scope="col">BIRTH CERTIFICATE</th>
                        <th scope="col">WORK EXPERIENCE</th>
                        <th scope="col">GS CHARACTER CERTIFICATE</th>
                        <th scope="col">CURRICULUM VITAE</th>
                        <th scope="col">NIC</th>
                        <th scope="col">Action</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                    <button style="margin-left: auto" onclick="toggleCheckList()" type="button" class="btn btn-sm btn-primary"><a href="{{route('edit')}}"></a><i class="fas fa-edit"></i> Edit </button>
                    </td>   
                </tr>
                </thead>
                <tbody class="tbody">
                </tbody>
            </table>
        </div>
    </div>
</body>

>>>>>>> a0df7ad669357eb48c5acbef9b1723fa62341d77
</html>