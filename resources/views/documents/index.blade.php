<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <div class="col-10">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="vaccinations" role="tabpanel" aria-labelledby="vaccinations-tab">


                <div class="card border-box border-primary mt-2 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title ">Vaccinations</h3>
                            <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#vaccines-information"><i class="fas fa-plus"></i>
                                Add</button>
                        </div>
                        <table class="table">
                            <thead class="thead">
                                <tr>
                                    <th scope="col">Doses</th>
                                    <th scope="col">Vaccine</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Note</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            </tbody>



                        </table>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                    <div class="col-6">
                        <div class="card border-box border-primary shadow-sm">
                            <div class="card-body ">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#profile-information"><i class="fas fa-edit"></i></button>
                                </div>
                                <table class="w-100 table-clean">
                                    <tbody>
                                        <tr>
                                            <td colspan="3" class="text-center pb-2">
                                                <img src="https://nchhr.apptimus.lk/images/profile.png" alt="Avatar" style="width:150px" class="rounded-circle">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center font-weight-bold text-capitalize h4 pb-2">
                                                MRS.
                                                Selvavanja
                                                Selvathurai
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center font-weight-bold text-capitalize h4 pb-2">
                                                EMP-00490
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                0770685695


                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-box border-primary mt-2 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title ">Personal Information
                                    </h3>
                                    <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#basic-information"><i class="fas fa-edit"></i></button>
                                </div>
                                <table class="w-100 table-clean">
                                    <tbody>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left" style="width: 150px">Gender</th>
                                            <th class="text-center">:</th>
                                            <td>female</td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Date of birth</th>
                                            <th class="text-center">:</th>
                                            <td>1962-07-13</td>
                                        </tr>

                                        <tr>
                                            <th class="pb-2 pt-2 text-left">NIC Number</th>
                                            <th class="text-center">:</th>
                                            <td>626952313V</td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Passport No</th>
                                            <th class="text-center">:</th>
                                            <td>-
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Blood Group</th>
                                            <th class="text-center">:</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Marital Status</th>
                                            <th class="text-center">:</th>
                                            <td>married</td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Language</th>
                                            <th class="text-center">:</th>
                                            <td>tamil</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-box border-primary mt-2 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title ">Fingerprint
                                    </h3>
                                    <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#bio-id-information"><i class="fas fa-edit"></i></button>
                                </div>
                                <table class="w-100 table-clean">
                                    <tbody>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Bio Id</th>
                                            <th class="text-center">:</th>
                                            <td>529</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-box border-primary mt-2 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title ">Address
                                    </h3>
                                    <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#address-information"><i class="fas fa-plus"></i></button>
                                </div>
                                <table class="w-100 table-clean">
                                </table>
                            </div>
                        </div>
                        <div class="card border-box border-primary mt-2 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title ">Emergency Contacts
                                    </h3>
                                    <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#emergency-contact-information"><i class="fas fa-plus"></i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-box border-primary ">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title ">Current Position
                                    </h3>

                                </div>
                                <table class="w-100 table-clean">
                                    <tbody>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left" style="width: 150px">Position
                                            </th>
                                            <th class="text-center"> : </th>
                                            <td>Midwife

                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#jobrole-information"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left" style="width: 150px">Department
                                            </th>
                                            <th class="text-center"> : </th>
                                            <td>Ward 02

                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#department-information"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Division</th>
                                            <th class="text-center">:</th>
                                            <td>Jaffna</td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Unit</th>
                                            <th class="text-center">:</th>
                                            <td>2
                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#unit-information"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Qualification</th>
                                            <th class="text-center">:</th>
                                            <td>a111 aa a
                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#qualification-information"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Basic Salary</th>
                                            <th class="text-center">:</th>
                                            <td>25000.00
                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#basic_salary-information"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Budgetary Relief</th>
                                            <th class="text-center">:</th>
                                            <td><span class="text-capitalize">3500.00</span>
                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#budgetary_relief-information"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>



                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Workable Hour</th>
                                            <th class="text-center">:</th>
                                            <td>200
                                                Hours /
                                                Per Month
                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#workable_hour-information"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Contract Period</th>
                                            <th class="text-center">:</th>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Hire Date</th>
                                            <th class="text-center">:</th>
                                            <td>2023-04-01
                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#hire-date-information"><i class="fas fa-edit"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Has Shift</th>
                                            <th class="text-center">:</th>
                                            <td>Yes
                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#shift-information"><i class="fas fa-edit"></i></button>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">OT Eligiblity</th>
                                            <th class="text-center">:</th>
                                            <td>No
                                                <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#OT-information"><i class="fas fa-edit"></i></button>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-box border-primary mt-2 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title ">EPF &amp; ETF
                                    </h3>
                                </div>
                                <table class="w-100 table-clean">
                                    <tbody>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left" style="width: 150px">
                                                EPF Number
                                            </th>
                                            <th class="text-center" style="width:20px"> : </th>
                                            <td>1204
                                            </td>
                                            <td> <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#epf-information"><i class="fas fa-edit"></i></button></td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">ETF Number </th>
                                            <th class="text-center">:</th>
                                            <td>-
                                            </td>
                                            <td> <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#etf-information"><i class="fas fa-edit"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-box border-primary mt-2 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title ">Salary Account
                                    </h3>
                                    <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#account-information"><i class="fas fa-edit"></i></button>
                                </div>
                                <table class="w-100 table-clean">
                                    <tbody>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left" style="width: 150px">
                                                Account Number
                                            </th>
                                            <th class="text-center" style="width:20px"> : </th>
                                            <td>-
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Bank Code</th>
                                            <th class="text-center">:</th>
                                            <td>-
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Branch Code</th>
                                            <th class="text-center">:</th>
                                            <td>-
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-box border-primary mt-2 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title ">Supervisor
                                    </h3>
                                    <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#supervisor-information"><i class="fas fa-edit"></i></button>
                                </div>
                                <table class="w-100 table-clean">
                                    <tbody>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left" style="width: 150px">Supervisor
                                                Name
                                            </th>
                                            <th class="text-center" style="width:20px"> : </th>
                                            <td>-
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left">Is Supervisor </th>
                                            <th class="text-center">:</th>
                                            <td>No</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card border-box border-primary mt-2 shadow-sm">
                            <div class="card-body">
                                <table class="w-100 table-clean">
                                    <tbody>
                                        <tr>
                                            <th class="pb-2 pt-2 text-left" style="width: 150px">
                                                Probation Period
                                            </th>
                                            <th class="text-center" style="width:20px"> : </th>
                                            <td>6
                                                Months
                                            </td>
                                            <td> <button type="button" class="btn btn-md btn-link" data-toggle="modal" data-target="#model_probation_period"><i class="fas fa-edit"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="checklist" role="tabpanel" aria-labelledby="checklist-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="checklist-controls" style="display: flex">
                            <button style="margin-left: auto" onclick="toggleCheckList()" type="button" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                        <form action="https://nchhr.apptimus.lk/new-employee/a9658b20-a90c-45f2-8967-7c0dd34a719a/checklist" method="POST" enctype="multipart/form-data" class="form-checklist">
                            <input type="hidden" name="_token" value="rnjaQfbFoMmZdDXhTFLppvJlRQUUIjmYvVhjVv3B" style="display: inline-block;">
                            <ul class="list-group list-group-flush ul-checklist">
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                                        <input type="checkbox" class="custom-control-input" id="check_25a2428e-6ec4-49c7-9d8e-235833c95101" name="check_list[]" value="25a2428e-6ec4-49c7-9d8e-235833c95101" style="">
                                        <label class="custom-control-label" for="check_25a2428e-6ec4-49c7-9d8e-235833c95101">O/LEVEL &amp; A/LEVEL RESULTS SHEETS</label>

                                    </div>



                                    <div>
                                        <input onchange="updateCheck('25a2428e-6ec4-49c7-9d8e-235833c95101')" type="file" name="files[25a2428e-6ec4-49c7-9d8e-235833c95101]" id="file_25a2428e-6ec4-49c7-9d8e-235833c95101" style="">
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                                        <input type="checkbox" class="custom-control-input" id="check_2b8b3441-6e4b-47cf-b8f4-24b64946ad3c" name="check_list[]" value="2b8b3441-6e4b-47cf-b8f4-24b64946ad3c" style="">
                                        <label class="custom-control-label" for="check_2b8b3441-6e4b-47cf-b8f4-24b64946ad3c">BANK OF CEYLON BOOK</label>

                                    </div>



                                    <div>
                                        <input onchange="updateCheck('2b8b3441-6e4b-47cf-b8f4-24b64946ad3c')" type="file" name="files[2b8b3441-6e4b-47cf-b8f4-24b64946ad3c]" id="file_2b8b3441-6e4b-47cf-b8f4-24b64946ad3c" style="">
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                                        <input type="checkbox" class="custom-control-input" id="check_516c715a-ab17-430a-a226-58ffccdf9b66" name="check_list[]" value="516c715a-ab17-430a-a226-58ffccdf9b66" style="">
                                        <label class="custom-control-label" for="check_516c715a-ab17-430a-a226-58ffccdf9b66">BIRTH CERTIFICATE</label>

                                    </div>



                                    <div>
                                        <input onchange="updateCheck('516c715a-ab17-430a-a226-58ffccdf9b66')" type="file" name="files[516c715a-ab17-430a-a226-58ffccdf9b66]" id="file_516c715a-ab17-430a-a226-58ffccdf9b66" style="">
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                                        <input type="checkbox" class="custom-control-input" id="check_5251ebb4-1604-47c0-8b23-047fd2054f09" name="check_list[]" value="5251ebb4-1604-47c0-8b23-047fd2054f09" style="">
                                        <label class="custom-control-label" for="check_5251ebb4-1604-47c0-8b23-047fd2054f09">WORK EXPERIENCE</label>

                                    </div>



                                    <div>
                                        <input onchange="updateCheck('5251ebb4-1604-47c0-8b23-047fd2054f09')" type="file" name="files[5251ebb4-1604-47c0-8b23-047fd2054f09]" id="file_5251ebb4-1604-47c0-8b23-047fd2054f09" style="">
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                                        <input type="checkbox" class="custom-control-input" id="check_7600ba5f-12cf-40d9-8499-917baa807bdf" name="check_list[]" value="7600ba5f-12cf-40d9-8499-917baa807bdf" style="">
                                        <label class="custom-control-label" for="check_7600ba5f-12cf-40d9-8499-917baa807bdf">GS CHARACTER CERTIFICATE</label>

                                    </div>



                                    <div>
                                        <input onchange="updateCheck('7600ba5f-12cf-40d9-8499-917baa807bdf')" type="file" name="files[7600ba5f-12cf-40d9-8499-917baa807bdf]" id="file_7600ba5f-12cf-40d9-8499-917baa807bdf" style="">
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                                        <input type="checkbox" class="custom-control-input" id="check_b12c361c-2fc8-4c93-80c8-a38148cb9785" name="check_list[]" value="b12c361c-2fc8-4c93-80c8-a38148cb9785" style="">
                                        <label class="custom-control-label" for="check_b12c361c-2fc8-4c93-80c8-a38148cb9785">CURRICULUM VITAE</label>

                                    </div>



                                    <div>
                                        <input onchange="updateCheck('b12c361c-2fc8-4c93-80c8-a38148cb9785')" type="file" name="files[b12c361c-2fc8-4c93-80c8-a38148cb9785]" id="file_b12c361c-2fc8-4c93-80c8-a38148cb9785" style="">
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                                        <input type="checkbox" class="custom-control-input" id="check_ca326c15-7402-4b59-9467-29e1a98e7621" name="check_list[]" value="ca326c15-7402-4b59-9467-29e1a98e7621" style="">
                                        <label class="custom-control-label" for="check_ca326c15-7402-4b59-9467-29e1a98e7621">VACCINE CERTIFICATE</label>

                                    </div>



                                    <div>
                                        <input onchange="updateCheck('ca326c15-7402-4b59-9467-29e1a98e7621')" type="file" name="files[ca326c15-7402-4b59-9467-29e1a98e7621]" id="file_ca326c15-7402-4b59-9467-29e1a98e7621" style="">
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox" style="float: left; margin-right:10px">
                                        <input type="checkbox" class="custom-control-input" id="check_e7f6ffa9-ef59-4939-909a-973b2c132c5b" name="check_list[]" value="e7f6ffa9-ef59-4939-909a-973b2c132c5b" style="">
                                        <label class="custom-control-label" for="check_e7f6ffa9-ef59-4939-909a-973b2c132c5b">NIC</label>

                                    </div>



                                    <div>
                                        <input onchange="updateCheck('e7f6ffa9-ef59-4939-909a-973b2c132c5b')" type="file" name="files[e7f6ffa9-ef59-4939-909a-973b2c132c5b]" id="file_e7f6ffa9-ef59-4939-909a-973b2c132c5b" style="">
                                    </div>

                                </li>
                            </ul>

                            <div style="display: flex">
                                <input style="margin-left: auto;" class="btn btn-info" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="promotion" role="tabpanel" aria-labelledby="promotion-tab">


                <div class="card border-box border-primary mt-2 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title ">Promotions &amp; Salary Increments History
                            </h3>

                        </div>
                        <table class="table table-clean">
                            <thead class="thead">
                                <tr>
                                    <th scope="col">Prev Position</th>
                                    <th scope="col">New Position</th>
                                    <th scope="col">Prev Amount</th>
                                    <th scope="col">New Amount</th>

                                    <th scope="col">Date</th>

                                </tr>
                            </thead>
                            <tbody class="tbody">
                            </tbody>



                        </table>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="Gratuity" role="tabpanel" aria-labelledby="Gratuity-tab">


                <div class="card border-box border-primary mt-2 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title ">Gratuity Calculations
                            </h3>

                        </div>
                        <table class="table table-clean">
                            <thead class="thead">
                                <tr>
                                    <th scope="col">Year</th>
                                    <th scope="col">Last salary paid date of the Year</th>
                                    <th scope="col">Cumulative of Gratuity Payment year wise</th>

                                </tr>
                            </thead>
                            <tbody class="tbody">
                            </tbody>



                        </table>
                    </div>
                </div>


            </div>


            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="card">
                    <div class="card-body">
                        <table class="w-100 table-clean">
                            <tbody>
                                <tr>
                                    <th class="pb-2" style="width: 130px">Job</th>
                                    <th class="pb-2">:</th>
                                    <td class="pb-2 font-weight-bold h3">
                                        Midwife
                                    </td>
                                    <th class="pb-2" style="width: 130px">Division</th>
                                    <th class="pb-2">:</th>
                                    <td class="pb-2 font-weight-bold h3">
                                        Jaffna
                                    </td>
                                </tr>

                                <tr>
                                    <th class="pb-2" style="width: 130px">Basic Salary</th>
                                    <th class="pb-2">:</th>
                                    <td class="pb-2 font-weight-bold h3" colspan="4">
                                        25,000.00 LKR
                                    </td>
                                </tr>
                                <tr>
                                    <th class="pb-2" style="width: 130px">Pay Frequency</th>
                                    <th class="pb-2">:</th>
                                    <td class="pb-2 font-weight-bold h3" colspan="4">
                                        per_month
                                    </td>
                                </tr>
                                <tr>
                                    <th class="pb-2" style="width: 130px">Workable Hours</th>
                                    <th class="pb-2">:</th>
                                    <td class="pb-2 font-weight-bold h3" colspan="4">

                                    </td>
                                </tr>
                                <tr>
                                    <th class="pb-2" style="width: 130px">Hire Date</th>
                                    <th class="pb-2">:</th>
                                    <td class="pb-2 font-weight-bold h3" colspan="4">
                                        2023-04-01
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>