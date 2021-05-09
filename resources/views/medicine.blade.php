<x-app-layout>
    <x-slot name="header">
       <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Medicine
        </h2>

       </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" style="position: absolute; right: 55px; top: 85px;" data-toggle="modal" data-target="#modalAddMedicine">
            SAVE
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalAddMedicine" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="post" action="{{ route('medicine.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">SAVE</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="medicineName">Medicine Name</label>
                                <input type="text" name="name" class="form-control" id="medicineName" >
                                <label for="companyId">company Id</label>
                                <input type="text" name="medicine_company_id" class="form-control" id="companyId" >
                                <label for="activeIngredient">active Ingredient</label>
                                <input type="text" name="active_ingredient" class="form-control" id="activeIngredient" >
                                <label for="barcode">barcode</label>
                                <input type="text" name="barcode" class="form-control" id="barcode" >
                            </div>
                        </div>
                        <div class="modal-footer">
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
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Company_Name</th>
                        <th scope="col">Name</th>
                        <th scope="col">Active_ingredient</th>
                        <th scope="col">Barcode</th>
                        <th scope="col">Operations</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medicines as $medicine)
                        <tr>
                            <td>  <a href="{{route('medicine.index').'?medicine_id='.$medicine->id}}">
                                    <div style="height:100%;width:100%">
                                        {{ $medicine->id }}
                                    </div>
                                </a></td>
                            <td>{{ $medicine->medicine_company_id }}</td>
                            <td>{{ $medicine->name }}</td>
                            <td>{{ $medicine->active_ingredient }}</td>
                            <td>{{ $medicine->barcode }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>


