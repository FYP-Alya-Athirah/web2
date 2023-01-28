@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Students Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Students</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Students List</p>
                        <!-- Button trigger add modal -->
                        <button type="button" class="btn btn-primary btn-sm ms-auto mb-0" data-bs-toggle="modal" data-bs-target="#addStudentModal">
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
                                <td><button type="button" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#editStudentModal{{$student->id}}" data-whatever="{{$student->id}}" >
                                Edit
                                </button>&nbsp&nbsp
                                <a class="btn btn-danger btn-xs" href="{{url('/delete-student/'.$student->id) }}" role="button" id="deleteButton{{$student->id}}">Delete</a>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editStudentModal{{$student->id}}" tabindex="-1" aria-labelledby="editStudentModal{{$student->id}}" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation was-validated" novalidate method="POST" action="{{url('/update-student/'.$student->id)}}">
                                                @csrf
                                                <div class="col-md-8">
                                                    <label for="validationCustom01" class="form-label">Full name</label>
                                                    <input type="text" class="form-control input-text" id="validationCustom01" name="fullname" value ='{{$student->fullname}}' required>
                                                    <div class="invalid-feedback">
                                                    Please enter full name
                                                    </div>
                                                </div>  
                                                <div class="col-md-4">
                                                    <label for="validationCustom02" class="form-label">IC Number</label>
                                                    <input type="text" class="form-control input-text" id="validationCustom02" name="ic_number" value ='{{$student->ic_number}}' required>
                                                    <div class="invalid-feedback">
                                                    Please enter IC number
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="validationCustom021" class="form-label">Gender</label>
                                                    <select id="validationCustom021" class="form-select input-text" required aria-label="select example" name="gender" value ='{{$student->gender}}'>
                                                    <option value='{{$student->gender}}' hidden>{{$student->gender}}</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select a gender</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="validationCustom03" class="form-label">Class</label>
                                                    <input type="text" class="form-control input-text" id="validationCustom03" name="class" value ='{{$student->class}}' required>
                                                    <div class="invalid-feedback">
                                                    Please enter class name
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label for="validationCustom04" class="form-label">Pickup Session</label>
                                                    <select id="validationCustom04" class="form-select input-text" required aria-label="select example" name="pickup_session">
                                                    <option value='{{$student->pickup_session}}' hidden>{{$student->pickup_session}}</option>
                                                    <option value="Half">Half</option>
                                                    <option value="Full">Full</option>
                                                    </select>
                                                    <div class="invalid-feedback">Please select pickup session</div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="startDate">Birthday</label>
                                                    <input type="date" name="birthday" value='{{$student->birthday}}' id="birthday_field" class="form-control input-text" min='1899-01-01' max='2000-13-13' required/>
                                                    <div class="invalid-feedback">Please select a date</div>
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

    <!-- Add Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 needs-validation was-validated" novalidate method="POST" action="{{url('add-student')}}">
                @csrf
                    <div class="col-md-8">
                        <label for="validationCustom01" class="form-label">Full name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="fullname" required>
                        <div class="invalid-feedback">
                        Please enter full name
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">IC Number</label>
                        <input type="text" class="form-control" id="validationCustom02" name="ic_number" required>
                        <div class="invalid-feedback">
                        Please enter IC number
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom021" class="form-label">Gender</label>
                        <select id="validationCustom021" class="form-select" required aria-label="select example" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback">Please select a gender</div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">Class</label>
                        <input type="text" class="form-control" id="validationCustom03" name="class" required>
                        <div class="invalid-feedback">
                        Please enter class name
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Pickup Session</label>
                        <select id="validationCustom04" class="form-select" required aria-label="select example" name="pickup_session">
                        <option value="">Select Session</option>
                        <option value="Half">Half</option>
                        <option value="Full">Full</option>
                        </select>
                        <div class="invalid-feedback">Please select pickup session</div>
                    </div>

                    <div class="col-md-6">
                        <label for="startDate">Birthday</label>
                        <input type="date" name="birthday" id="birthday_field" class="form-control" min='1899-01-01' max='2000-13-13' required/>
                        <div class="invalid-feedback">Please select a date</div>
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
        $('#students-table').DataTable();
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
    dd = dd - 1;
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
