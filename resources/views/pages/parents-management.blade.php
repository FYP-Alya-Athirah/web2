@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Parents Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Parents</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Parents List</p>
                    </div>

                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    <table id="parents-table" class="table display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Car Plate</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parents as $parent)
                            <tr>
                                <td>{{$parent->fullname}}</td>
                                <td>{{$parent->carplate}}</td>
                                <td>{{$parent->phone_number}}</td>
                                <td><button type="button" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#editParentModal{{$parent->id}}" data-whatever="{{$parent->id}}" >
                                Edit
                                </button>&nbsp&nbsp
                                <a class="btn btn-danger btn-xs" href="{{url('/delete-parent/'.$parent->id) }}" role="button" id="deleteButton{{$parent->id}}">Delete</a></td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editParentModal{{$parent->id}}" tabindex="-1" aria-labelledby="editParentModal{{$parent->id}}" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation was-validated" novalidate method="POST" action="{{url('/update-parent/'.$parent->id)}}">
                                                @csrf
                                                <div class="col-md-6">
                                                    <label for="validationCustom01" class="form-label">Full name</label>
                                                    <input type="text" class="form-control input-text" id="validationCustom01" name="fullname" value ='{{$parent->fullname}}' required>
                                                    <div class="invalid-feedback">
                                                    Please enter full name
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label for="validationCustom03" class="form-label">Car plate</label>
                                                    <input type="text" class="form-control input-text" id="validationCustom03" name="class" value ='{{$parent->carplate}}' required>
                                                    <div class="invalid-feedback">
                                                    Please enter car plate
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="validationCustom04" class="form-label">Phone number</label>
                                                    <input type="text" class="form-control input-text" id="validationCustom04" name="class" value ='{{$parent->phone_number}}' required>
                                                    <div class="invalid-feedback">
                                                    Please enter phone number
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Fullname</th>
                                <th>Car Plate</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('css')
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
@endpush

@push('js')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
    })()
    // setTimeout(function(){
    //     window.location.reload(1);
    // }, 5000);

    $(document).ready(function () {
        $('#parents-table').DataTable();
    });

</script>
<script>
    //date before today
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
    dd = '0' + dd
    }
    if (mm < 10) {
    mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("birthday_field").setAttribute("max", today);
</script>
<!-- jQuery Script -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Datatable Script -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

@endpush
