<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{__('branch.branch')}}
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
                data-target="#modalStoreBranch">
            <a href="javascript:void(0)"></a>
            {{__('global.add')}}
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalStoreBranch" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('branch.storeBranch')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <form method="post" action={{__('branch.branchRoute')}}>
                        @csrf
                        @method("POST")
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="mb-3">
                                    <label class="form-label" for="branchNameStore">{{__('branch.branchName')}}</label>
                                    <input type="text" class="form-control" name="name" id="branchNameStore">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="updateButton" class="btn btn-secondary" onclick="updateBranch()">
                                {{__('global.update')}}
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                {{__('global.close')}}
                            </button>
                            <button type="submit" class="btn btn-primary" id="branchStoreButton" value="SAVE">
                                {{__('global.save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal Detail -->
        <div class="modal fade" id="modalDetailBranch" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('branch.branchDetail')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="divDetailBranch">
                                <div class="mb-3">
                                    <label class="form-label" for="branchID">{{__('branch.branchId')}}</label>
                                    <div class="alert alert-primary" role="alert" id="branchID"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="branchNameDetail">{{__('branch.branchName')}}</label>
                                    <div class="alert alert-primary" role="alert" id="branchNameDetail"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="created_at">{{__('global.created_at')}}</label>
                                    <div class="alert alert-primary" role="alert" id="created_at"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="doctorStatus">{{__('doctor.doctor_status')}}:</label>
                                    <div class="alert alert-primary" role="alert" id="doctorStatus"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="doctorName">{{__('doctor.doctor_name')}}:</label>
                                    <div class="alert alert-primary" role="alert" id="doctorName"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="doctorPhone">{{__('doctor.doctor_phone')}}:</label>
                                    <div class="alert alert-primary" role="alert" id="doctorPhone"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="doctorEmail">{{__('doctor.doctor_email')}}:</label>
                                    <div class="alert alert-primary" role="alert" id="doctorEmail"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="doctorAddress">{{__('doctor.doctor_address')}}
                                        :</label>
                                    <div class="alert alert-primary" role="alert" id="doctorAddress"></div>
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
                <table class="table table-striped" id="branchTable">
                    <thead>
                    <tr>
                        <th data-filter-value="Id" scope="col">{{__('branch.branchId')}}</th>
                        <th data-filter-value="name" scope="col">{{__('branch.branchName')}}</th>
                        <th data-filter-value="created_at" scope="col">{{__('global.created_at')}}</th>
                        <th data-filter-value="deleted_at" scope="col">{{__('global.deleted_at')}}</th>
                        <th data-filter-value="operations" scope="col">{{__('global.operations')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        var selectedBranchId = 0;
        $( document ).ready(function() {
           fetchData();
        });

        function updateBranch() {
            // data="name="+$("#branchNameStore").val();
            // $.ajax({
            //     method: "PUT",
            //     url: "/branch/" + selectedBranchId,
            //     data: data,
            //     success: function (response) {
            //        location.reload();
            //     }
            // });
            data = {
                "name": $("#branchNameStore").val()
            };

            $.ajax({
                method: "PUT",
                url: "/branches/" + selectedBranchId,
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function (response) {
                    location.reload();
                }
            });
        }

        function detailBranch(id) {
            $.ajax({
                method: "GET",
                url: "/branches/" + id,
                success: function (response) {
                    $("#branchID").html(response.data.id);
                    $("#branchNameDetail").html(response.data.name);
                    $("#created_at").html(response.data.created_at);
                    $("#doctorStatus").html(response.data['doctors'][0].status);
                    $("#doctorName").html(response.data['doctors'][0].user.name);
                    $("#doctorPhone").html(response.data['doctors'][0].user.phone);
                    $("#doctorEmail").html(response.data['doctors'][0].user.email);
                    $("#doctorAddress").html(response.data['doctors'][0].user.address);
                    $("#modalDetailBranch").modal("show");
                }
            });
        }

        function getBranch(id) {
            selectedBranchId = id;
            $.ajax({
                method: "GET",
                url: "/branches/" + id,
                success: function (response) {
                    $("#branchNameStore").val(response.data.name);
                    $("#modalStoreBranch").modal("show");
                }
            });
        }

        function deleteBranch(id) {

            $.ajax({
                type: "DELETE",
                url: "/branches/" + id,
                success: function (response) {
                    location.reload();
                }
            });
        }

        function adjust($selectclick) {
            $("#updateButton").show();
            $("#branchStoreButton").show();
            if ($selectclick === 0) {
                $("#branchNameStore").val();
                $("#updateButton").hide();
            }
            if ($selectclick === 1) {
                $("#branchStoreButton").hide();
            }
        }

        function prepareUrl() {
            let url = '/branches/list?order_by=' + orderBy + '&order_type=' + orderType;
            if (withTrashed) {
                url += '&with_trashed=true';
            }
            if (searchKey.length >= 3) {
                url += '&search=' + searchKey;
            }
            return url;
        }

        function refreshTable(response) {
            $('#branchTable tbody tr').remove();
            response.data.forEach(function (item, index) {

                $('#branchTable tbody').append(prepareTableRow(item));
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
            <td>' + item.created_at + '</td> \
            <td>' + item.deleted_at + '</td> \
            <td><a title="detail" href="javascript:void(0)" onclick="detailBranch(' + item.id + ')"> \
            <i class="fa fa-exclamation"></i> \
            </a> \
            <a onclick="getBranch(' + item.id + '); adjust(1);" class="ml-3" title="update" \
            href="javascript:void(0)"> \
            <i class="fa fa-edit"></i> \
            </a> \
            <a onclick="deleteBranch(' + item.id + ');" title="delete" class="ml-3" \
            href="javascript:void(0)"> \
            <i class="fa fa-times"></i> \
            </a> \
            </td> \
            </tr>';

            return html;
        }

    </script>


</x-app-layout>




