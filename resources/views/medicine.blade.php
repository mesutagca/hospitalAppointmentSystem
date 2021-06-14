<x-app-layout>
    <x-slot name="header">
       <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('medicine.medicine')}}
        </h2>
       </div>
           <div class="input-group mb-3" style="position: absolute; right: 450px; top: 84px; width: 230px; ">
               <input id="quickSearch" type="text" placeholder="{{__('global.search')}}" class="form-control"
                      aria-describedby="basic-addon2">
               <span class="input-group-text" id="basic-addon2"><a href="javascript:void(0);" onclick="adjustSearch()"><i
                           class="fa fa-search"></i></a></span>
           </div>

           <select id="searchSelect" onchange="adjustOrder(this)" style="position: absolute; right: 250px; top: 84px;">
               <option value="">{{__('global.default')}}</option>
               <option value="newest">{{__('global.newest')}}</option>
               <option value="oldest">{{__('global.oldest')}}</option>
               <option value="name">{{__('global.nameOrder')}}</option>
               <option value="active_ingredient">{{__('medicine.activeIngredientOrder')}}</option>
               <option value="medicine_company_id">{{__('medicine.medicineCompanyOrder')}}</option>
           </select>
           <div style="position: absolute; right: 130px; top: 90px;">
               <input type="checkbox" name="withTrash" id="withTrash"
                      onclick="adjustWithTrash()">
               <label for="withTrash"
               >{{__('global.withTrashed')}}</label>
           </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary"
                style="position: absolute; right: 55px; top: 85px;" data-toggle="modal" id="addButton"
                data-target="#modalStoreMedicine">
            <a href="javascript:void(0)"></a>
            {{__('global.add')}}
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalStoreMedicine" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('medicine.storeMedicine')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <form method="post" action={{__('medicine.medicineRoute')}}>
                        @csrf
                        @method("POST")
                        <div class="modal-body">
                            <div class="form-group">

                                <div class="mb-3">
                                    <label class="form-label" for="medicineNameStore">{{__('medicine.medicineName')}}</label>
                                    <input type="text" class="form-control" name="name" id="medicineNameStore">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanySelectStore">{{__('medComp.medicineCompanies')}}</label>

                                    <select id="medicineCompanySelectStore" class="form-control"  name="medicine_company_id" >
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineActiveIngredientStore">{{__('medicine.activeIngredient')}}</label>
                                    <input type="text" class="form-control" name="active_ingredient" id="medicineActiveIngredientStore">
                                </div>
                                 <div class="mb-3">
                                    <label class="form-label" for="medicineBarcodeStore">{{__('medicine.barcode')}}</label>
                                    <input type="text" class="form-control" name="barcode" id="medicineBarcodeStore">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateButton" class="btn btn-secondary" onclick="updateMedicine()">
                                {{__('global.update')}}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                {{__('global.close')}}
                            </button>
                            <button type="submit" class="btn btn-primary" id="medicineStoreButton" value="SAVE">
                                {{__('global.save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Detail -->
        <div class="modal fade" id="modalDetailMedicine" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('medicine.medicineDetail')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="divDetailMedicine">
                                <div class="mb-3">
                                    <label class="form-label" for="medicineID">{{__('medicine.medicineId')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineID"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineName">{{__('medicine.medicineName')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineName"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineActiveIngredient">{{__('medicine.activeIngredient')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineActiveIngredient"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineBarcode">{{__('medicine.barcode')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineBarcode"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanyName">{{__('medComp.medicineCompanyName')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineCompanyName"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanyAddress">{{__('medComp.medicineCompanyAddress')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineCompanyAddress"></div>
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
        </div>

    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <table class="table table-striped" id="medicineTable">
                    <thead>
                    <tr>
                        <th data-filter-value="Id" scope="col">{{__('medicine.medicineId')}}</th>
                        <th data-filter-value="Name" scope="col">{{__('medicine.medicineName')}}</th>
                        <th data-filter-value="Active_ingredient" scope="col">{{__('medicine.activeIngredient')}}</th>
                        <th data-filter-value="Barcode" scope="col">{{__('medicine.barcode')}}</th>
                        <th data-filter-value="deleted_at" scope="col">{{__('global.deleted_at')}}</th>
                        <th data-filter-value="Operations" scope="col">{{__('global.operations')}}</th>
                     </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>  </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var selectedMedicineId = 0;
        var companies=[];
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
            if (value === 'name') {
                orderBy = 'name';
                orderType = 'asc';
            }
            if (value === 'active_ingredient') {
                orderBy = 'active_ingredient';
                orderType = 'asc';
            }
            if (value === 'medicine_company_id') {
                orderBy = 'medicine_company_id';
                orderType = 'asc';
            }
            if (value === 'address') {
                orderBy = 'address';
                orderType = 'asc';
            }
            fetchData();
        }


        $( document ).ready(function() {
            fetchData();

            $('#addButton').click(function (){
                loadCompanies(0);
                adjust(0);
            });
        });

        function loadCompanies(selectedId){
            if(companies.length===0){
                $.ajax({
                    method: "GET",
                    url: "/medicineCompanies/list",
                    success: function (response) {
                        companies=response.data;
                        console.log(response);

                        $('#medicineCompanySelectStore').append('<option value="0"></option>');
                        companies.forEach(function (item, index){
                            $('#medicineCompanySelectStore').append('<option value="'+item.id+'">'+item.name+'</option>')
                        })
                        $('#medicineCompanySelectStore').val(selectedId);
                    }
                });
                return;
            }
            $('#medicineCompanySelectStore').val(selectedId);
        }

        function getMedicine(id) {
            loadCompanies(0);
            selectedMedicineId = id;
            $.ajax({
                method: "GET",
                url: "/medicines/" + id,
                success: function (response) {
                    $("#medicineNameStore").val(response.data.name);
                    $("#medicineCompanySelectStore").val(response.data.medicine_company_id);
                    $("#medicineActiveIngredientStore").val(response.data.active_ingredient);
                    $("#medicineBarcodeStore").val(response.data.barcode);
                    $("#modalStoreMedicine").modal("show");
                }
            });
        }


        function updateMedicine() {
            // data="name="+$("#medicineNameStore").val();
            // $.ajax({
            //     method: "PUT",
            //     url: "/medicines/" + selectedMedicineId,
            //     data: data,
            //     success: function (response) {
            //        location.reload();
            //     }
            // });


            data = {
                "name": $("#medicineNameStore").val(),
                "barcode": $("#medicineBarcodeStore").val(),
                "active_ingredient": $("#medicineActiveIngredientStore").val(),
                "medicine_company_id": $('#medicineCompanySelectStore').val(),

            };

            $.ajax({
                method: "PUT",
                url: "/medicines/" + selectedMedicineId,
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function (response) {

                    location.reload();
                }
            });
        }


        function deleteMedicine(id) {

            $.ajax({
                type: "DELETE",
                url: "/medicines/" + id,
                success: function (response) {
                    location.reload();
                }
            });
        }

        function detailMedicine(id) {

            $.ajax({
                method: "GET",
                url: "/medicines/" + id,
                success: function (response) {
                    $("#medicineID").html(response.data.id);
                    $("#medicineName").html(response.data.name);
                    $("#medicineActiveIngredient").html(response.data.active_ingredient);
                    $("#medicineBarcode").html(response.data.barcode);
                    $("#medicineCompanyName").html(response.data.medicine_company.name);
                    $("#medicineCompanyAddress").html(response.data.medicine_company.address);
                    $("#modalDetailMedicine").modal("show");
                }
            });
        }
        function adjust(selectClick) {

            $("#updateButton").show();
            $("#medicineStoreButton").show();
            if (selectClick === 0) {
                $("#medicineNameStore").val();
                $("#updateButton").hide();

            }
            if (selectClick === 1) {
                $("#medicineStoreButton").hide();
            }
        }

        function prepareUrl() {
            let url = '/medicines/list?order_by=' + orderBy + '&order_type=' + orderType;
            if (withTrashed) {
                url += '&with_trashed=true';
            }
            if (searchKey.length >= 3) {
                url += '&search=' + searchKey;
            }
            return url;
        }

        function refreshTable(response) {
            $('#medicineTable tbody tr').remove();
            response.data.forEach(function (item, index) {

                $('#medicineTable tbody').append(prepareTableRow(item));
            });
        }

        function prepareTableRow(item) {
            html = '  <tr> \
                    <td> \
                    <a title="detail" href="javascript:void(0)" onclick="detailBranch(' + item.id + ')"> \
                    ' + item.id + ' \
                    </a> \
            </td> \
            <td>' + item.name + '</td> \
            <td>' + item.active_ingredient + '</td> \
            <td>' + item.barcode + '</td> \
            <td>' + item.deleted_at + '</td> \
           <td><a title="detail" href="javascript:void(0)" onclick="detailMedicine(' + item.id + ')"> \
            <i class="fa fa-exclamation"></i> \
            </a> \
            <a onclick="getMedicine(' + item.id + '); adjust(1);" class="ml-3" title="update" \
            href="javascript:void(0)"> \
            <i class="fa fa-edit"></i> \
            </a> \
            <a onclick="deleteMedicine(' + item.id + ');" title="delete" class="ml-3" \
            href="javascript:void(0)"> \
            <i class="fa fa-times"></i> \
            </a> \
            </td> \
            </tr>';

            return html;
        }


    </script>
</x-app-layout>


