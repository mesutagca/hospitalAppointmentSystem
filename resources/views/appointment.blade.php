<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__("appointment.myAppointments")}}
            </h2>
        </div>
        <div class="input-group mb-3" style="position: absolute; right: 450px; top: 80px; width: 242px; ">
            <input id="quickSearch" type="text" placeholder="{{__('global.search')}}" class="form-control"
                   aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2"><a href="javascript:void(0);" onclick="adjustSearch()"><i
                        class="fa fa-search"></i></a></span>
        </div>

        <div onchange="adjustOrder(this)" style="position: absolute; right: 220px; top: 80px;">
            <select id="searchSelect">
                <option value="">{{__('global.default')}}</option>
                <option value="newest">{{__('global.newest')}}</option>
                <option value="oldest">{{__('global.oldest')}}</option>
                @if(Auth::user()->type==\App\Enums\UserTypes::PATIENT)
                    <option value="doctor">{{__('global.orderByDoctor')}}</option>
                @endif
                @if(Auth::user()->type==\App\Enums\UserTypes::DOCTOR)
                    <option value="patient">{{__('global.orderByPatient')}}</option>
                @endif
            </select>

            <input type="checkbox" name="withTrash" id="withTrash"
                   onclick="adjustWithTrash()">
            <label for="withTrash"
            >{{__('global.withTrashed')}}</label>
        </div>
    @if(Auth::user()->type==\App\Enums\UserTypes::PATIENT)
        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary"
                    style="position: absolute; right: 55px; top: 85px;" data-toggle="modal" id="takeAppointmentButton"
                    data-target="#modalTakeAppointment">
                <a href="javascript:void(0)"></a>
                {{__('appointment.takeAppointment')}}
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalTakeAppointment" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('appointment.takeAppointment')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <form method="post" id="takeUpdateAppointmentForm"
                              action={{__('appointment.appointmentRoute')}} enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="modal-body">
                                <div class="form-group">

                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="branchSelector"> {{__('branch.branches')}}</label>
                                        <select id="branchSelector" onchange="branchSelected(this)" class="form-control"
                                                name="branch_name">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="doctorSelector"> {{__('doctor.doctors')}}</label>
                                        <select id="doctorSelector" class="form-control" name="doctor_id">
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label"
                                               for="appointment_time"> {{__('appointment.date')}}</label>
                                        <input type="date" class="form-control" name="appointment_time"
                                               id="appointment_time" value="">
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="disease_documents">{{__('patent.documentsOfPatient')}}</label>
                                        <input type="file" class="form-control" name="disease_documents[]" multiple
                                               id="disease_documents">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="disease_detail">{{__('appointment.detailOfDisease')}}</label>
                                        <textarea class="form-control" rows="3" name="disease_detail"
                                                  id="disease_detail"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="updateAppointmentButton" class="btn btn-secondary">
                                    {{__('global.update')}}
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{__('global.close')}}
                                </button>
                                <button type="submit" class="btn btn-primary" id="takeAppointmentSaveButton"
                                        value="SAVE">
                                    {{__('global.save')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endif
    @if(Auth::user()->type==\App\Enums\UserTypes::DOCTOR)
        <!-- Modal For Doctor Update -->
            <div class="modal fade" id="modalTreatAppointment" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('appointment.treatAppointment')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <form method="post" id="treatAppointmentForm"
                              action={{__('appointment.appointmentRouteForTreat')}} enctype="multipart/form-data">
                            @csrf
                            @method("POST")
                            <div class="modal-body">
                                <div class="form-group">
                                    <div>
                                        <label class="form-label"
                                               for="appointment_time"> {{__('appointment.date')}}</label>
                                        <div class="alert alert-primary" role="alert"
                                             id="appointment_time"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="AppointmentPatientName">{{__('patent.name')}}</label>
                                        <div class="alert alert-primary" role="alert"
                                             id="AppointmentPatientName"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="detailAppointmentFolderDiseaseDetail">{{__('appointment.detailOfDisease')}}</label>
                                        <div class="alert alert-primary" role="alert"
                                             id="detailAppointmentFolderDiseaseDetail"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="diagnoseSelector">{{__('diagnose.diagnoseName')}}</label>
                                        <select id="diagnoseSelector" class="form-control"
                                                name="diagnose_id">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                               for="medicineSelector">{{__('medicine.medicines')}}</label>
                                        <select id="medicineSelector" class="form-control"
                                                name="medicine_id">
                                        </select>
                                    </div>
                                    <div class="container">
                                        <label class="form-label"
                                               for="treatAppointmentPatientDocumentsTable">{{__('patent.documentsOfPatient')}}</label>
                                        <div class="row">
                                            <div class="col col-3">
                                                <table class="table table-striped"
                                                       id="treatAppointmentPatientDocumentsTable">
                                                    <thead>
                                                    <tr>
                                                        <th data-filter-value="Id" scope="col">{{__('folder.documentNoOfPatient')}}</th>
                                                        <th data-filter-value="folder_id" scope="col">{{__('folder.folderNo')}}</th>
                                                        <th data-filter-value="name" scope="col">{{__('folder.documentNameOfPatient')}}</th>
                                                        <th data-filter-value="created_at" scope="col">{{__('global.created_at')}}
                                                        </th>
                                                        <th data-filter-value="operations" scope="col">{{__('global.operations')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    {{__('global.close')}}
                                </button>
                                <button type="submit" class="btn btn-primary" id="treatAppointmentSaveButton"
                                        value="SAVE">
                                {{__('global.save')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endif
    <!-- Modal Detail -->
        <div class="modal fade" id="modalDetailAppointment" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('appointment.appointmentDetail')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="divDetailAppointment">
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentID">{{__('appointment.appointmentID')}}</label>
                                    <div class="alert alert-primary" role="alert" id="detailAppointmentID"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentDate">{{__('appointment.date')}}</label>
                                    <div class="alert alert-primary" role="alert" id="detailAppointmentDate"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentPatientName">{{__('patient.name')}}</label>
                                    <div class="alert alert-primary" role="alert"
                                         id="detailAppointmentPatientName"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentBranch">{{__('branch.branch')}}</label>
                                    <div class="alert alert-primary" role="alert" id="detailAppointmentBranch"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentDoctorName">{{__('doctor.doctorName')}}</label>
                                    <div class="alert alert-primary" role="alert"
                                         id="detailAppointmentDoctorName"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentDoctorPhone">{{__('global.phone')}}</label>
                                    <div class="alert alert-primary" role="alert"
                                         id="detailAppointmentDoctorPhone"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentDoctorEmail">{{__('global.email')}}</label>
                                    <div class="alert alert-primary" role="alert"
                                         id="detailAppointmentDoctorEmail"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentFolderId">{{__('folder.folderNo')}}</label>
                                    <div class="alert alert-primary" role="alert"
                                         id="detailAppointmentFolderId"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentFolderDiseaseDetail">{{__('appointment.detailOfDisease')}}</label>
                                    <div class="alert alert-primary" role="alert"
                                         id="detailAppointmentFolderDiseaseDetail"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="detailAppointmentFolderDiagnose">{{__('diagnose.diagnoseName')}}</label>
                                    <div class="alert alert-primary" role="alert"
                                         id="detailAppointmentFolderDiagnose"></div>
                                </div>
                                <div class="container">
                                    <label class="form-label" for="detailAppointmentPatientDocumentsTable">{{__('patient.documentsOfPatient')}}</label>
                                    <div class="row">
                                        <div class="col col-3">
                                            <table class="table table-striped"
                                                   id="detailAppointmentPatientDocumentsTable">
                                                <thead>
                                                <tr>
                                                    <th data-filter-value="Id" scope="col">{{__('folder.documentNoOfPatient')}}</th>
                                                    <th data-filter-value="folder_id" scope="col">{{__('folder.folderNo')}}</th>
                                                    <th data-filter-value="name" scope="col">{{__('folder.documentNameOfPatient')}}</th>
                                                    <th data-filter-value="created_at" scope="col">{{__('global.created_at')}}
                                                    </th>
                                                    <th data-filter-value="operations" scope="col">{{__('global.operations')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <label class="form-label" for="detailAppointmentRecipeTable">Reçete
                                    </label>
                                    <div class="row">
                                        <div class="col col-3">
                                            <table class="table table-striped"
                                                   id="detailAppointmentRecipeTable">
                                                <thead>
                                                <tr>
                                                    <th data-filter-value="Id" scope="col">{{__('folder.recipeNo')}}</th>
                                                    <th data-filter-value="folder_id" scope="col">{{__('folder.folderNo')}}</th>
                                                    <th data-filter-value="name" scope="col">{{__('medicine.medicineName')}}</th>
                                                    <th data-filter-value="created_at" scope="col">{{__('global.created_at')}}</th>
                                                    <th data-filter-value="download" scope="col">{{__('global.download')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{__('global.close')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>


    <div class="container">
        <div class="row">
            <div class="col col-12">
                <table class="table table-striped" id="appointmentTable">
                    <thead>
                    <tr>
                        <th data-filter-value="Id" scope="col">{{__('appointment.appointmentId')}}</th>
                        <th data-filter-value="appointment_date" scope="col">{{__('appointment.date')}}</th>

                        <th data-filter-value="branch" scope="col" id="branchTh">{{__('branch.branch')}}</th>

                        <th data-filter-value="doctor_name" scope="col"
                            id="doctorNameTh">{{__('doctor.doctorName')}}</th>
                        <th data-filter-value="operations" scope="col">{{__('global.operations')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script>

        var selectedAppointmentId = 0;
        var branches = [];
        var doctors = [];
        var patient_documents = [];
        var diagnoses = [];
        var medicines = [];
        var treatment = [];
        var recipe = [];
        var recipe_medicines = [];
        var folder = [];
        var withTrashed = false;
        var orderBy = 'id';
        var orderType = 'desc';
        var searchKey = '';

        function adjustWithTrash() {
            withTrashed = true;

            if (!$("#withTrash").prop('checked')) {
                withTrashed = false;
            }

            fetchData();
        }

        function adjustSearch(searchItem) {

            searchKey = $('#quickSearch').val();
            if (searchKey.length >= 3) {
                fetchData();
            }
        }

        function fetchData() {

            $.ajax({
                method: "GET",
                url: prepareUrl(),
                success: function (response) {

                    refreshTable(response);
                }
            });
        }

        function adjustOrder(selectObject) {
            var value = $(selectObject).val();
            orderBy = 'id';
            orderType = 'desc';
            if (value === 'newest') {
                orderBy = 'created_at';
                orderType = 'desc';
            }
            if (value === 'oldest') {
                orderBy = 'created_at';
                orderType = 'asc';
            }

            if (value === 'doctor') {
                orderBy = 'doctor_id';
                orderType = 'asc';
            }


            if (value === 'patient') {
                orderBy = 'patient_id';
                orderType = 'asc';
            }


            fetchData();
        }

        @if(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::DOCTOR)

        $(document).before(
            [
                fetchData(),
                loadDiagnoses(0),
                loadMedicines(),
                $('#branchTh').html('{{__('appointment.detailOfDisease')}}'),
                $('#doctorNameTh').html('{{__('patient.name')}}'),

            ]
        );

        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::DOCTOR)

        function deleteRecipe(treatmentId, recipeId, element) {
            $.ajax({
                method: 'DELETE',
                url: 'treatments/recipeMedicines/' + treatmentId + '/' + recipeId,
                success: function (response) {

                    $(element).closest('tr').remove();
                    if ($('#detailAppointmentRecipeTable tbody tr').length == 0) {
                        $('#detailAppointmentRecipeTable').hide();
                    }
                }
            });
        }

        function loadDiagnoses(selectedId) {
            $('#diagnoseSelector').val(selectedId);
            if (diagnoses.length === 0) {
                $.ajax({
                    method: "GET",
                    url: "/diagnoses/list",
                    success: function (response) {
                        diagnoses = response.data;

                        $('#diagnoseSelector').append('<option value="0">Select Diagnose</option>');

                        diagnoses.forEach(function (item, index) {

                            $('#diagnoseSelector').append('<option value="' + item.id + '">' + item.name + '</option>')
                        })

                    }
                });
            }
        }


        function loadMedicines() {

            if (medicines.length === 0) {
                $.ajax({
                    method: "GET",
                    url: "/medicines/list",
                    success: function (response) {
                        medicines = response.data;

                        $('#medicineSelector').append('<option value="0">Select Medicine</option>');

                        medicines.forEach(function (item, index) {

                            $('#medicineSelector').append('<option value="' + item.id + '">' + item.name + '</option>')
                        })

                    }
                });
            }
        }

        function getAppointmentForTreat(id) {
            selectedAppointmentId = id;
            var actionUrl = '/treatments/' + selectedAppointmentId;
            $('#treatAppointmentForm').attr('action', actionUrl);
            $.ajax({
                method: "GET",
                url: "/appointments/" + id,
                success: function (response) {
                    let appointment = response.data;
                    prepareForDetailTable(response);
                    $('#appointment_time').html(appointment.appointment_time);
                    $("#AppointmentPatientName").html(appointment.patient.user.name);
                    $('#disease_detail').val(appointment.folder.disease_detail);
                    loadDiagnoses(appointment.folder.diagnose_id);
                    $("#modalTreatAppointment").modal("show");
                }
            });



        }
        @endif

        @if(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::PATIENT)

        $(document).ready(function () {
            fetchData()
            $('#takeAppointmentButton').click(function () {
                loadBranches(0, 0);
                adjustButtonOfTakeAppointmentModel(0);

            });
        })

        function adjustButtonOfTakeAppointmentModel(selectclick) {
            var actionUrl=null;
            $("#updateAppointmentButton").show();
            $("#takeAppointmentSaveButton").show();
            if (selectclick === 0) {
                $("#updateAppointmentButton").hide();
            }
            if(selectclick>0){
                $("#takeAppointmentSaveButton").hide();

                $("#takeUpdateAppointmentForm input[name=_method]").val('PUT');
                actionUrl = '/appointments/' + selectclick;
                $('#takeUpdateAppointmentForm').attr('action', actionUrl);
            }
            @if(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::DOCTOR)
                $("#takeAppointmentSaveButton").hide();

                $("input[name=_method]").val('PUT');
                actionUrl = '/appointments/' + selectclick;
                $('#treatAppointmentForm').attr('action', actionUrl);
            @endif

        }

        function loadBranches(selectedId, doctorId) {
            var doAfter = function (selectedId, doctorId) {
                $('#branchSelector').val(selectedId);
                if (selectedId > 0) {
                    loadDoctors(selectedId, doctorId);
                }
            };
            if (branches.length === 0) {
                $.ajax({
                    method: "GET",
                    url: "/branches/list",
                    success: function (response) {
                        branches = response.data;
                        $('#branchSelector').append('<option value="0">Select Branch</option>');

                        branches.forEach(function (item, index) {

                            $('#branchSelector').append('<option value="' + item.id + '">' + item.name + '</option>')
                        })
                        doAfter(selectedId, doctorId);
                    }
                });
                return;
            }
            doAfter(selectedId, doctorId);
        }

        function branchSelected(element) {
            var branchId = $(element).val();
            loadDoctors(branchId, 0);
        }

        function loadDoctors(branchId, selectedId) {
            $('#doctorSelector option').remove();
            $.ajax({
                method: "GET",
                url: "/doctors/list?branch_id=" + branchId,
                success: function (response) {
                    doctors = response.data;
                    $('#doctorSelector').append('<option value="0">Select Doctor</option>');

                    doctors.forEach(function (item, index) {

                        $('#doctorSelector').append('<option value="' + item.id + '">' + item['user'].name + '</option>')
                    })
                    $('#doctorSelector').val(selectedId);
                }
            });
        }


        function deleteDocument(appointmentId, path, element) {
            $.ajax({
                method: 'DELETE',
                url: '/patientDocuments/' + appointmentId + '/' + path,
                success: function (response) {

                    $(element).closest('tr').remove();
                    if ($('#detailAppointmentPatientDocumentsTable tbody tr').length == 0) {
                        $('#detailAppointmentPatientDocumentsTable').hide();
                    }
                }
            });
        }

        function getAppointmentForPatientUpdate(id) {

            adjustButtonOfTakeAppointmentModel(id);
            $.ajax({
                method: "GET",
                url: "/appointments/" + id,
                success: function (response) {
                    let appointment = response.data;
                    loadBranches(appointment.doctor.branch_id, appointment.doctor.id);
                    var x = appointment.appointment_time;
                    js_date_str = x.substr(0, 10);
                    $('#appointment_time').val(js_date_str);
                    $('#disease_detail').val(appointment.folder.disease_detail);
                    $("#modalTakeAppointment").modal("show");
                }
            });
        }


        function deleteAppointment(id) {
            $.ajax({
                type: "DELETE",
                url: "/appointments/" + id,
                success: function (response) {

                    location.reload();
                }
            });
        }
        @endif

        function detailAppointment(id) {
            $.ajax({
                method: "GET",
                url: "/appointments/" + id,
                success: function (response) {
                    prepareForDetailTable(response);
                    let appointment = response.data;
                    $("#detailAppointmentID").html(appointment.id);
                    $("#detailAppointmentDate").html(appointment.appointment_time);
                    $("#detailAppointmentPatientName").html(appointment.patient.user.name);
                    $("#detailAppointmentBranch").html(appointment.doctor.branch.name);
                    $("#detailAppointmentDoctorName").html(appointment.doctor.user.name);
                    $("#detailAppointmentDoctorPhone").html(appointment.doctor.user.phone);
                    $("#detailAppointmentDoctorEmail").html(appointment.doctor.user.email);
                    $("#detailAppointmentFolderId").html(appointment.folder.id);
                    if (appointment.folder.disease_detail == null) {
                        $("#detailAppointmentFolderDiseaseDetail").html("--");
                    } else {
                        $("#detailAppointmentFolderDiseaseDetail").html(appointment.folder.disease_detail);
                    }
                    if (appointment.folder.diagnose == null) {
                        $("#detailAppointmentFolderDiagnose").html("--");
                    } else {
                        $("#detailAppointmentFolderDiagnose").html(appointment.folder.diagnose.name);
                    }
                    $("#modalDetailAppointment").modal("show");
                }
            });
        }

        function prepareForDetailTable(response) {
            let appointment = response.data;

            $('#detailAppointmentPatientDocumentsTable tbody tr').remove();
            $('#detailAppointmentRecipeTable tbody tr').remove();
            recipe_medicines= appointment.folder.treatment.recipe.medicines;
                recipe_medicines.forEach(function (item, index) {

                    if (recipe_medicines.length > 0) {
                        $('#detailAppointmentRecipeTable').show();
                    }
                    var createdAt = item.created_at;
                    js_date_str = createdAt.substr(0, 10);
                    recipePrepareTable = '<tr> \
                            <td>' + item.pivot.recipe_id + '</td>\
                            <td>' + appointment.folder.id + '</td>\
                            <td>' + item.name + '</td>\
                            <td>' + js_date_str + '</td>\
                        <td ><a title="download" href="/treatments/' + appointment.folder.treatment.id + '/recipes/' + item.pivot.recipe_id + '" >\
                                <i class="fa\ fa-download"></i></a>\
                                <a id="' + "deneme"+item.id + '" title="delete" href="javascript:void(0);"\
                               onclick="deleteRecipe(' +appointment.folder.treatment.id+ ',\'' + item.pivot.recipe_id + '\',this);"  > \
                                <i class="fa fa-times"></i> \
                                </a>\</td>\
                               </tr>';

                    $('#detailAppointmentRecipeTable tbody').append(recipePrepareTable);
                    @if(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::PATIENT)
                    var getDeleteButtonOfRecipeDetailTable = "deneme"+item.id;
                    $('#getDeleteButtonOfRecipeDetailTable').hide();
                    @endif

            });
            fillPatientDocuments(appointment);

        }

        function fillPatientDocuments(appointment) {
            patient_documents = appointment.folder.patient_documents;
            if (patient_documents.length > 0) {
                $('#detailAppointmentPatientDocumentsTable').show();
            }
            patient_documents.forEach(function (item, index) {

                @if(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::DOCTOR)
                var getDeleteButtonOfDetailTable = item.name;
                $('#getDeleteButtonOfDetailTable').hide();
                @endif
                var createdAt = item.created_at;
                js_date_str = createdAt.substr(0, 10);
                documentPrepareTable = '<tr> \
                            <td>' + item.id + '</td>\
                            <td>' + item.folder_id + '</td>\
                            <td>' + item.name + '</td>\
                            <td>' + js_date_str + '</td>\
                            <td><a title="download" href="/patientDocuments/' + appointment.id + '/' + item.path + '" >\
                                <i class="fa\ fa-download"></i></a>\
                                <a id="' + item.name + '" title="delete" href="javascript:void(0);"\
                               onclick="deleteDocument(' + appointment.id+ ',\'' + (item.path) + '\',this);"  > \
                                <i class="fa fa-times"></i> \
                                </a>\
                            </td>\
                                                </tr>';


                $('#detailAppointmentPatientDocumentsTable tbody').append(documentPrepareTable);
            });
        }

       function prepareUrl() {
            let url = '/appointments/list?order_by=' + orderBy + '&order_type=' + orderType;
            if (withTrashed) {
                url += '&with_trashed=true';
            }
            if (searchKey.length >= 3) {
                url += '&search=' + searchKey;
            }

            return url;

        }

        function refreshTable(response) {
            $('#appointmentTable tbody tr').remove();
            response.data.forEach(function (item, index) {
                @if(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::DOCTOR)
                $('#appointmentTable tbody').append(prepareTableRowForDoctor(item));
                @elseif(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::PATIENT)
                $('#appointmentTable tbody').append(prepareTableRowForPatient(item));
                @endif
            });
        }

        @if(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::DOCTOR)

        function prepareTableRowForDoctor(item) {
            html = '  <tr id="mesut"> \
                    <td> \
                    <a title="detail" href="javascript:void(0)" onclick="detailAppointment(' + item.id + ')"> \
                    ' + item.id + ' \
                    </a> \
            </td> \
            <td>' + item.appointment_time + '</td> \
            <td>' + item.folder.disease_detail + '</td> \
            <td>' + item.patient.user.name + '</td> \
           <td><a title="detail" href="javascript:void(0)" onclick="detailAppointment(' + item.id + ')"> \
            <i class="fa fa-exclamation"></i> \
            </a> \
            <a onclick="getAppointmentForTreat(' + item.id + ');" class="ml-3" title="treat" \
            href="javascript:void(0)"> \
            <i class="fa fa-edit"></i> \
            </a> \
            </td> \
            </tr>';

            return html;
        }

        @elseif(\Illuminate\Support\Facades\Auth::user()->type==\App\Enums\UserTypes::PATIENT)
        function prepareTableRowForPatient(item) {
            html = '  <tr> \
                    <td> \
                    <a title="detail" href="javascript:void(0)" onclick="detailAppointment(' + item.id + ')"> \
                    ' + item.id + ' \
                    </a> \
            </td> \
            <td>' + item.appointment_time + '</td> \
            <td>' + item.doctor.branch.name + '</td> \
            <td>' + item.doctor.user.name + '</td> \
           <td><a title="detail" href="javascript:void(0)" onclick="detailAppointment(' + item.id + ')"> \
            <i class="fa fa-exclamation"></i> \
            </a> \
            <a onclick="getAppointmentForPatientUpdate(' + item.id + ');" class="ml-3" title="update" \
            href="javascript:void(0)"> \
            <i class="fa fa-edit"></i> \
            </a> \
            <a onclick="deleteAppointment(' + item.id + ');" title="delete" class="ml-3" \
            href="javascript:void(0)"> \
            <i class="fa fa-times"></i> \
            </a> \
            </td> \
            </tr>';

            return html;
        }
        @endif

    </script>


</x-app-layout>





