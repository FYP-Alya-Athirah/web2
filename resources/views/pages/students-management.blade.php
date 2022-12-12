@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Students Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Students</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Students List</p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm ms-auto mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add New Student
                        </button>
                    </div>

                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    <table id="students-table" class="table display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>IC Number</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Class</th>
                                <th>Pickup Schedule</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{$student->fullname}}</td>
                                <td>{{$student->ic_number}}</td>
                                <td>{{$student->birthday}}</td>
                                <td>{{$student->gender}}</td>
                                <td>{{$student->class}}</td>
                                <td>{{$student->pickup_session}}</td>
                                <td><button type="button" class="dds__button dds__button--mini" data-bs-toggle="modal" data-bs-target="#editModal" data-whatever="{{ $student->id }}">
                                Edit
                                </button>&nbsp&nbsp
                                <a class="dds__button dds__button--mini" href="{{url('/admin-student-participant/'.$student->id) }}" role="button" id="{{ $student->id }}">View</a>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Fullname</th>
                                <th>IC Number</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Class</th>
                                <th>Pickup Schedule</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                    $fullname = $ic_number = $gender = $class = $pickup_session = "";
                    $birthday = "";
                ?>
                <form class="row g-3 needs-validation was-validated" novalidate method="POST" action="{{url('add-student')}}">
                @csrf
                    <div class="col-md-8">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="fullname" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">IC Number</label>
                        <input type="text" class="form-control" id="validationCustom02" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom021" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="validationCustom021" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Class</label>
                        <input type="text" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                        Please input class name.
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">Pickup Session</label>
                        <select id="validationCustom04" class="form-select" required aria-label="select example">
                        <option value="">Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        </select>
                        <div class="invalid-feedback">Example invalid select feedback</div>
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
@endsection

@push('css')
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
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
        $('#students-table').DataTable();
    });
</script>
<!-- jQuery Script -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Datatable Script -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

@endpush
