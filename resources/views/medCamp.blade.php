<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__('medComp.medicineCompany')}}
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
            <option value="address">{{__('medComp.address')}}</option>
        </select>
        <div style="position: absolute; right: 130px; top: 90px;">
            <input type="checkbox" name="withTrash" id="withTrash"
                   onclick="adjustWithTrash()">
            <label for="withTrash"
            >{{__('global.withTrashed')}}</label>
        </div>



        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary"
                style="position: absolute; right: 55px; top: 85px;" data-toggle="modal" id="buton" onclick="adjust(0)"
                data-target="#modalStoreMedicineCompany">
            <a href="javascript:void(0)"></a>
            {{__('global.add')}}
        </button>

        <!-- Modal -->
        <div class="modal fade" id="modalStoreMedicineCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('medComp.storeMedicineCompany')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <form method="post" action={{__('medComp.medicineCompanyRoute')}}>
                        @csrf
                        @method("POST")
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanyNameStore">{{__('medComp.medicineCompanyName')}}</label>
                                    <input type="text" class="form-control" name="name" id="medicineCompanyNameStore">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanyAddressStore">{{__('medComp.medicineCompanyAddress')}}</label>
                                    <input type="text" class="form-control" name="address" id="medicineCompanyAddressStore">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateButton" class="btn btn-secondary" onclick="updateMedicineCompany()">
                                {{__('global.update')}}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                {{__('global.close')}}
                            </button>
                            <button type="submit" class="btn btn-primary" id="medicineCompanyStoreButton" value="SAVE">
                                {{__('global.save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Detail -->
        <div class="modal fade" id="modalDetailMedicineCompany" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('medComp.medicineCompanyDetail')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="divDetailMedicineCompany">
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanyId">{{__('medComp.medicineCompanyId')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineCompanyId"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanyName">{{__('medComp.medicineCompanyName')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineCompanyName"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanyAddress">{{__('medComp.medicineCompanyAddress')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineCompanyAddress"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="medicineCompanyCreatedAt">{{__('medComp.medicineCompanyCreatedAt')}}</label>
                                    <div class="alert alert-primary" role="alert" id="medicineCompanyCreatedAt"></div>
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
                <table class="table table-striped" id="medicineCompanyTable">
                    <thead>
                    <tr>
                        <th data-filter-value="Id" scope="col">{{__('medComp.medicineCompanyId')}}</th>
                        <th data-filter-value="Name" scope="col">{{__('medComp.medicineCompanyName')}}</th>
                        <th data-filter-value="Address" scope="col">{{__('medComp.medicineCompanyAddress')}}</th>
                        <th data-filter-value="created_at" scope="col">{{__('global.created_at')}}</th>
                        <th data-filter-value="created_at" scope="col">{{__('global.deleted_at')}}</th>
                        <th data-filter-value="created_at" scope="col">{{__('global.operations')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>                           </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>      </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        var selectedMedicineCompanyId = 0;
        $( document ).ready(function() {
            fetchData();
        });


        function updateMedicineCompany() {
            // data="name="+$("#medicineCompanyNameStore").val();
            // data="address="+$("#medicineCompanyAddressStore").val();
            // $.ajax({
            //     method: "PUT",
            //     url: "/medicineCompanies/" + selectedMedicineCompanyId,
            //     data: data,
            //     success: function (response) {
            //        location.reload();
            //     }
            // });
            data = {
                "name": $("#medicineCompanyNameStore").val(),
                "address": $("#medicineCompanyAddressStore").val()
            };

            $.ajax({
                method: "PUT",
                url: "/medicineCompanies/" + selectedMedicineCompanyId,
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function (response) {
                    location.reload();
                }
            });
        }

        function detailMedicineCompany(id) {
            $.ajax({
                method: "GET",
                url: "/medicineCompanies/" + id,
                success: function (response) {
                    $("#medicineCompanyId").html(response.data.id);
                    $("#medicineCompanyName").html(response.data.name);
                    $("#medicineCompanyAddress").html(response.data.address);
                    $("#medicineCompanyCreatedAt").html(response.data.created_at);
                    $("#modalDetailMedicineCompany").modal("show");
                }
            });
        }

        function getMedicineCompany(id) {
            selectedMedicineCompanyId = id;
            $.ajax({
                method: "GET",
                url: "/medicineCompanies/" + id,
                success: function (response) {
                    $("#medicineCompanyNameStore").val(response.data.name);
                    $("#medicineCompanyAddressStore").val(response.data.address);
                    $("#modalStoreMedicineCompany").modal("show");
                }
            });
        }

        function deleteMedicineCompany(id) {

            $.ajax({
                type: "DELETE",
                url: "/medicineCompanies/" + id,
                success: function (response) {
                    location.reload();
                }
            });
        }

        function adjust($selectclick) {
            $("#updateButton").show();
            $("#medicineCompanyStoreButton").show();
            if ($selectclick === 0) {
                $("#medicineCompanyNameStore").val();
                $("#updateButton").hide();
            }
            if ($selectclick === 1) {
                $("#medicineCompanyStoreButton").hide();
            }
        }

        function prepareUrl() {
            let url = '/medicineCompanies/list?order_by=' + orderBy + '&order_type=' + orderType;
            if (withTrashed) {
                url += '&with_trashed=true';
            }
            if (searchKey.length >= 3) {
                url += '&search=' + searchKey;
            }
            return url;
        }

        function refreshTable(response) {
            $('#medicineCompanyTable tbody tr').remove();
            response.data.forEach(function (item, index) {

                $('#medicineCompanyTable tbody').append(prepareTableRow(item));
            });
        }

        function prepareTableRow(item) {
            html = '  <tr> \
                    <td> \
                    <a title="detail" href="javascript:void(0)" onclick="detailMedicineCompany(' + item.id + ')"> \
                    ' + item.id + ' \
                    </a> \
            </td> \
            <td>' + item.name + '</td> \
            <td>' + item.address + '</td> \
            <td>' + item.created_at + '</td> \
            \<td>' + item.deleted_at + '</td> \
            <td><a title="detail" href="javascript:void(0)" onclick="detailMedicineCompany(' + item.id + ')"> \
            <i class="fa fa-exclamation"></i> \
            </a> \
            <a onclick="getMedicineCompany(' + item.id + '); adjust(1);" class="ml-3" title="update" \
            href="javascript:void(0)"> \
            <i class="fa fa-edit"></i> \
            </a> \
            <a onclick="deleteMedicineCompany(' + item.id + ');" title="delete" class="ml-3" \
            href="javascript:void(0)"> \
            <i class="fa fa-times"></i> \
            </a> \
            </td> \
            </tr>';

            return html;
        }


    </script>
</x-app-layout>


