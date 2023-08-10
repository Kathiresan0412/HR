<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="{{route('create_documents')}}" class="btn btn-md btn-link" 
                    data-target="#Employee-Documents"><i class="fas fa-plus"></i> ADD</a>
            </div>
            <table class="table">
                <thead class="thead">
                    <tr>
                    <th scope="col">EMPLOYEE</th>
                        <th scope="col">O/LEVEL & A/LEVEL RESULTS SHEETS</th>
                        <th scope="col">BANK BOOK</th>
                        <th scope="col">WORK EXPERIENCE</th>
                        <th scope="col">GS CHARACTER CERTIFICATE</th>
                        <th scope="col">NIC</th>
                        <th scope="col">Action</th>
                    </tr>
                    @foreach($documents as $documents)
  <tr>
   <td>{{$documents->id}}</td>
    <td>{{$documents->employee}}</td>
    <td>{{$documents->ol_level_al_level_resheets}}</td>
    <td>{{$documents->goverment_bank_book}}</td>
    <td>{{$documents->work_experince}}</td>
    <td>{{$documents->gs_charactet_certificate}}</td>
    <td>{{$documents->nic}}</td>
    <td>
    <a href="{{route('edit_documents',$documents->id)}}">UPDATE</a>
    <form action="{{route('delete_documents',$documents->id)}}" method="post">
      @csrf
      @method('DELETE')
    <button type="submit">Delete</button>
</form>
    </td>
  </tr>
  
  @endforeach
                </thead>
                <tbody class="tbody">
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>