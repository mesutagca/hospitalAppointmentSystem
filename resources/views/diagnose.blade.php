<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__('diagnose.diagnose')}}
            </h2>
        </div>
        <div class="input-group mb-3" style="position: absolute; right: 450px; top: 84px; width: 230px; ">
            <input id="quickSearch" type="text" placeholder="{{__('global.search')}}" class="form-control"
                   aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2"><a href="javascript:void(0);" onclick="adjustSearch()"><i
                        class="fa fa-search"></i></a></span>
        </div>
        <!-- Search TextArea -->
        <select id="searchSelect" onchange="adjustOrder(this)" style="position: absolute; right: 250px; top: 84px;">
            <option value="">{{__('global.default')}}</option>
            <option value="newest">{{__('global.newest')}}</option>
            <option value="oldest">{{__('global.oldest')}}</option>
            <option value="name">{{__('global.nameOrder')}}</option>
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
                data-target="#modalStoreDiagnose">
            <a href="javascript:void(0)"></a>
            {{__('global.add')}}
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalStoreDiagnose" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('diagnose.storeDiagnose')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <form method="post" action={{__('diagnose.diagnoseRoute')}}>
                        @csrf
                        @method("POST")
                        <div class="modal-body">
                            <div class="form-group">

                                <div class="mb-3">
                                    <label class="form-label" for="diagnoseNameStore">{{__('diagnose.diagnoseName')}}</label>
                                    <input type="text" class="form-control" name="name" id="diagnoseNameStore">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateButton" class="btn btn-secondary" onclick="updateDiagnose()">
                                {{__('global.update')}}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                {{__('global.close')}}
                            </button>
                            <button type="submit" class="btn btn-primary" id="diagnoseStoreButton" value="SAVE">
                                {{__('global.save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <table class="table table-striped" id="diagnoseTable">
                    <thead>
                    <tr>
                        <th data-filter-value="Id" scope="col">{{__('diagnose.diagnoseId')}}</th>
                        <th data-filter-value="name" scope="col">{{__('diagnose.diagnoseName')}}</th>
                        <th data-filter-value="created_at" scope="col">{{__('global.created_at')}}</th>
                        <th data-filter-value="deleted_at" scope="col">{{__('global.deleted_at')}}</th>
                        <th data-filter-value="operations" scope="col">{{__('global.operations')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>

                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>

        var selectedDiagnoseId = 0;

        $( document ).ready(function() {
            fetchData();
        });

        function updateDiagnose() {
            // data="name="+$("#diagnoseNameStore").val();
            // $.ajax({
            //     method: "PUT",
            //     url: "/diagnose/" + selectedDiagnoseId,
            //     data: data,
            //     success: function (response) {
            //        location.reload();
            //     }
            // });
            data = {
                "name": $("#diagnoseNameStore").val()
            };

            $.ajax({
                method: "PUT",
                url: "/diagnoses/" + selectedDiagnoseId,
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function (response) {
                    location.reload();
                }
            });
        }

        function getDiagnose(id) {

            selectedDiagnoseId = id;
            $.ajax({
                method: "GET",
                url: "/diagnoses/" + id,
                success: function (response) {
                    $("#diagnoseNameStore").val(response.data.name);
                    $("#modalStoreDiagnose").modal("show");
                }
            });
        }

        function deleteDiagnose(id) {

            $.ajax({
                type: "DELETE",
                url: "/diagnoses/" + id,
                success: function (response) {
                    location.reload();
                }
            });
        }

        function adjust($selectclick) {
            $("#updateButton").show();
            $("#diagnoseStoreButton").show();
            if ($selectclick === 0) {
                $("#diagnoseNameStore").val();
                $("#updateButton").hide();
            }
            if ($selectclick === 1) {
                $("#diagnoseStoreButton").hide();
            }
        }

        function prepareUrl() {
            let url = '/diagnoses/list?order_by=' + orderBy + '&order_type=' + orderType;
            if (withTrashed) {
                url += '&with_trashed=true';
            }
            if (searchKey.length >= 3) {
                url += '&search=' + searchKey;
            }
            return url;
        }

        function refreshTable(response) {
            $('#diagnoseTable tbody tr').remove();
            response.data.forEach(function (item, index) {
            $('#diagnoseTable tbody').append(prepareTableRow(item));
            });
        }

        function prepareTableRow(item) {
            html = '  <tr> \
            <td> ' + item.id + ' </td> \
            <td>' + item.name + '</td> \
            <td>' + item.created_at + '</td> \
            <td>' + item.deleted_at + '</td> \
            <td> \
            <a onclick="getDiagnose(' + item.id + '); adjust(1);" class="ml-3" title="update" \
            href="javascript:void(0)"> \
            <i class="fa fa-edit"></i> \
            </a> \
            <a onclick="deleteDiagnose(' + item.id + ');" title="delete" class="ml-3" \
            href="javascript:void(0)"> \
            <i class="fa fa-times"></i> \
            </a> \
            </td> \
            </tr>';

            return html;
        }
    </script>






</x-app-layout>



