<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Diagnose
            </h2>

        </div>
        <!-- Button trigger modal -->
        <button type="button" onclick="addDiagnose();" class="btn btn-primary" style="position: absolute; right: 55px; top: 85px;" data-toggle="modal" data-target="#modalAddDiagnose">
            SAVE
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalAddDiagnose" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">branch düzenle</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    </div>
                    <form method="post" action="">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="diagnoseId" value="0" id="hiddenDiagnoseId"/>
                                <div class="mb-3">
                                    <label class="form-label" for="diagnoseName">diagnoseName:</label>
                                    <input type="text" class="form-control" name="name" id="diagnoseName">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="$('#diagnoseFormModal').modal('hide');" class="btn btn-secondary"
                                    data-bs-dismiss="modal">ASılkapat
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>








    <div class="container">
        <div class="row">
            <div class="col col-12">
                <table class="table table-striped" id="diagnosesTable">
                    <thead>
                    <tr>
                        <th data-filter-value="Id" scope="col">id</th>
                        <th data-filter-value="name" scope="col">Diagnose_Name</th>
                        <th data-filter-value="created_at" scope="col">Created_at</th>
                        <th data-filter-value="updated_at" scope="col">Updated_at</th>
                        <th data-filter-value="operations" scope="col">Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($diagnoses as $diagnose)
                        <tr>
                            <td>  <a href="{{route('diagnose.index').'?diagnose_id='.$diagnose->id}}">
                                    <div style="height:100%;width:100%">
                                        {{ $diagnose->id }}
                                    </div>
                                </a></td>
                            <td>{{ $diagnose->name }}</td>
                            <td>{{ $diagnose->created_at }}</td>
                            <td>{{$diagnose->updated_at }}</td>
                            <td><a href="#">
                                <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" >
                                <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function  addDiagnose()
        {
            $("#name").val("");
            $("#hiddenDiagnoseId").val(0);
            $('#diagnoseFormModal').modal('show');

        }
        function editdiagnose(id)
        {
            $.ajax({
                method:"POST",
                url:"/?page=diagnose&bookId="+id,
                data:"getdiagnose",
                success:function (returntext){
                    let obj= JSON.parse(returntext);
                    $("#name").val(obj.name);
                    $("#hiddenBookId").val(id);
                    $("#diagnoseFormModal").modal("show");
                }


            });
        }
        function deletediagnose(id)
        {
            $.ajax({
                method:"POST",
                url:"/?page=diagnose&bookId="+id,
                data:"deletebook",
                success:function (returntext){
                    location.reload();
                }
            });
        }

    </script>






</x-app-layout>



