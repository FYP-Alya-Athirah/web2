@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Children Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>{{ Session::get('success') }}</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Children List</p>
                        <!-- Button trigger add modal -->
                        @if($user->role == 1)   
                            <button type="button" class="btn btn-primary btn-sm ms-auto mb-0" data-bs-toggle="modal" data-bs-target="#addChildModal">
                            Add Child
                            </button>   
                        @endif
                        
                    </div>
                </div>
                @if($user->role == 0)   
                    <div class="card-body px-4 pt-0 pb-2 my-6 m-auto">
                    <button type="button" class="btn btn-primary btn-lg ms-auto mb-0" data-bs-toggle="modal" data-bs-target="#registerParentModal">
                        Register Parent
                    </button>
                    </div>
                @else
                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="table-responsive p-0">
                        <table id="children-table" class="table display" style="width:100%">
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
                                    <td>
                                        <a class="btn btn-secondary btn-xs" href="{{url('/photos-child/'.$student->id) }}" role="button" id="goPhotosButton{{$student->id}}">Photos</a>
                                        &nbsp&nbsp
                                        <a class="btn btn-danger btn-xs" href="{{url('/delete-child/'.$student->id) }}" role="button" id="deleteButton{{$student->id}}">Remove</a>
                                    </td>
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
                @endif
                
            </div>
        </div>
    </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addChildModal" tabindex="-1" aria-labelledby="addChildModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adding Child to Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation was-validated" novalidate method="POST" action="{{url('add-child')}}">
                    @csrf
                        <div class="col-md-12">
                            <label for="validationCustom02" class="form-label">IC Number</label>
                            <input type="text" class="form-control" id="childICnum" name="ic_number" placeholder="EX: 012345678910" onkeyup="getMessage()" required>
                            <div class="invalid-feedback">
                            Please enter IC number
                            </div>
                        </div>
                        <div id='ic_msg'>There is no such student in the system.</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Parent -->
    <div class="modal fade" id="registerParentModal" tabindex="-1" aria-labelledby="registerParentModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation was-validated" novalidate method="POST" action="{{url('register-parent')}}">
                    @csrf
                        <div class="col-md-8">
                            <label for="validationCustom01" class="form-label">Car Plate</label>
                            <input type="text" class="form-control" id="validationCustom01" name="carplate" required>
                            <div class="invalid-feedback">
                            Please enter car plate
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="validationCustom02" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="validationCustom02" name="phone_number" required>
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
@endsection

@push('css')
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
        $('#children-table').DataTable();
    });


</script>
<script>
    function getMessage() {
        $.ajax({
            type:'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'show-child/'+document.getElementById("childICnum").value,
            success:function(data) {
                $("#ic_msg").html(data.ic_msg);
            }
        });
    }
</script>

<!-- jQuery Script -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- Datatable Script -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
@endpush
