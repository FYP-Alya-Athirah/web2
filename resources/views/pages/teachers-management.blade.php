@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Teachers Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Teachers</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Teachers List</p>
                        <button type="button" class="btn btn-primary btn-sm ms-auto mb-0" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
                            Add Teacher
                            </button>   
                    </div>

                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    <table id="teachers-table" class="table display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Phone Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{$teacher->fullname}}</td>
                                <td>{{$teacher->phone_number}}</td>
                                <td><button type="button" class="btn btn-secondary btn-xs" data-bs-toggle="modal" data-bs-target="#editTeacherModal{{$teacher->id}}" data-whatever="{{$teacher->id}}" >
                                Edit
                                </button>&nbsp&nbsp
                                <a class="btn btn-danger btn-xs" href="{{url('/delete-teacher/'.$teacher->id) }}" role="button" id="deleteButton{{$teacher->id}}">Delete</a></td>
                            </tr>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editTeacherModal{{$teacher->id}}" tabindex="-1" aria-labelledby="editTeacherModal{{$teacher->id}}" aria-hidden="true" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Teacher</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3 needs-validation was-validated" novalidate method="POST" action="{{url('/update-teacher/'.$teacher->id)}}">
                                                @csrf
                                                <div class="col-md-6">
                                                    <label for="validationCustom01" class="form-label">Full name</label>
                                                    <input type="text" class="form-control input-text" id="validationCustom01" name="fullname" value ='{{$teacher->fullname}}' required>
                                                    <div class="invalid-feedback">
                                                    Please enter full name
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="validationCustom04" class="form-label">Phone number</label>
                                                    <input type="text" class="form-control input-text" id="validationCustom04" name="class" value ='{{$teacher->phone_number}}' required>
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
<!-- Add Modal -->
<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adding Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation was-validated" novalidate method="POST" action="{{url('add-teacher')}}">
                    @csrf
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">User ID</label>
                            <input type="text" class="form-control" id="userID" name="user_id" placeholder="" onkeyup="getMessage()" required>
                            <div class="invalid-feedback">
                            Please enter user id
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="teacher_fullname" name="fullname" placeholder="" onkeyup="getMessage()" required>
                            <div class="invalid-feedback">
                            Please enter teacher's fullname
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="validationCustom02" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="validationCustom02" name="phone_number" required>
                            <div class="invalid-feedback">
                            Please enter phone number
                            </div>
                        </div>
                        <div id='user_msg'>There is no such user in the system.</div>
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
        $('#teachers-table').DataTable();
    });

</script>
<script>
    function getMessage() {
        $.ajax({
            type:'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'show-user/'+document.getElementById("userID").value,
            success:function(data) {
                $("#user_msg").html(data.user_msg);
            }
        });
    }
</script>

<!-- jQuery Script -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Datatable Script -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

@endpush
