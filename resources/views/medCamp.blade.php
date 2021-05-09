<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            MedicineCompany
        </h2>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" style="position: absolute; right: 55px; top: 85px;" data-toggle="modal" data-target="#modalAddcOMPANY">
            KAYDET
        </button>
        <!-- Modal -->
        <div class="modal fade" id="modalAddcOMPANY" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="post" action="{{ route('medicineCompany.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">KAYDET</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="companyName">companyName</label>
                                <input type="text" name="name" class="form-control" id="companyName" >
                                <label for="companyAddress">companyAddress</label>
                                <input type="text" name="address" class="form-control" id="companyAddress" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">KAPAT</button>
                            <button type="submit" class="btn btn-primary">KAYDET</button>
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
                        <th scope="col">iD</th>
                        <th scope="col">NAME</th>
                        <th scope="col">ADDRESS</th>
                        <th scope="col">OPERATIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medcompanies as $medCompany)
                        <tr>
                            <td>  <a href="{{route('medicineCompany.index').'?company_id='.$medCompany->id}}">
                                    <div style="height:100%;width:100%">
                                        {{ $medCompany->id }}
                                    </div>
                                </a></td>
                            <td>{{ $medCompany->name }}</td>
                            <td>{{ $medCompany->address }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>

