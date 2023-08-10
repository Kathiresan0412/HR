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
    <div class="card-body">
        <div class="checklist-controls" style="display: flex">
        </div>
        <form action="{{ route('store_documents') }}" method="POST" enctype="multipart/form-data"
            class="form-checklist">
            <input type="hidden" name="_token" value="rnjaQfbFoMmZdDXhTFLppvJlRQUUIjmYvVhjVv3B"
                style="display: inline-block;">
            <ul class="list-group list-group-flush ul-checklist">
                <li class="list-group-item">
                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">

                        <label class="custom-control-label" for="check_25a2428e-6ec4-49c7-9d8e-235833c95101">O/LEVEL
                            &amp; A/LEVEL RESULTS SHEETS</label>

                    </div>
                    <div>
                        <input onchange="updateCheck('25a2428e-6ec4-49c7-9d8e-235833c95101')" type="file"
                            name="ol_level_al_level_resheets" id="file_25a2428e-6ec4-49c7-9d8e-235833c95101">
                    </div>

                </li>
                <li class="list-group-item">
                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                        <label class="custom-control-label" for="check_2b8b3441-6e4b-47cf-b8f4-24b64946ad3c">BANK
                            BOOK</label>

                    </div>
                    <div>
                        <input onchange="updateCheck('2b8b3441-6e4b-47cf-b8f4-24b64946ad3c')" type="file"
                            name="goverment_bank_book" id="file_2b8b3441-6e4b-47cf-b8f4-24b64946ad3c">
                    </div>

                </li>
                <li class="list-group-item">
                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                        <label class="custom-control-label" for="check_5251ebb4-1604-47c0-8b23-047fd2054f09">WORK
                            EXPERIENCE</label>

                    </div>

                    <div>
                        <input onchange="updateCheck('5251ebb4-1604-47c0-8b23-047fd2054f09')" type="file"
                            name="work_experince" id="file_5251ebb4-1604-47c0-8b23-047fd2054f09">
                    </div>

                </li>
                <li class="list-group-item">
                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                        <label class="custom-control-label" for="check_7600ba5f-12cf-40d9-8499-917baa807bdf">GS
                            CHARACTER CERTIFICATE</label>

                    </div>

                    <div>
                        <input onchange="updateCheck('7600ba5f-12cf-40d9-8499-917baa807bdf')" type="file"
                            name="gs_charactet_certificate" id="file_7600ba5f-12cf-40d9-8499-917baa807bdf">
                    </div>

                </li>

                <li class="list-group-item">
                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                        <label class="custom-control-label" for="check_e7f6ffa9-ef59-4939-909a-973b2c132c5b">NIC</label>

                    </div>

                    <div>
                        <input onchange="updateCheck('e7f6ffa9-ef59-4939-909a-973b2c132c5b')" type="file"
                            name="nic" id="file_e7f6ffa9-ef59-4939-909a-973b2c132c5b">
                    </div>

                </li>
            </ul>

            <div style="display: flex">
                <input style="margin-left: auto;" class="btn btn-info" type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>
