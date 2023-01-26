@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Attendance List'])
    <div class="row mt-4 mx-4">
        <div class="col-12 col-md-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Students Attendance List</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Attendance</p>
                    </div>

                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    <table id="students-table" class="table display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Class</th>
                                <th>Pickup Schedule</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{$student->fullname}}</td>
                                <td>{{$student->class}}</td>
                                <td>{{$student->pickup_session}}</td>
                                
                                <td class="align-middle text-center text-sm">
                                    <?php
                                        if ($student->attend == "1") {
                                            echo "<span class='badge badge-sm bg-success'>Attended</span>";
                                        }
                                        elseif ($student->attend == "0") {
                                            echo "<span class='badge badge-sm bg-secondary'>Absent</span>";
                                        }
                                    
                                    ?>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Fullname</th>
                                <th>Class</th>
                                <th>Pickup Schedule</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4" style="display: flex;">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Today's Attendance</p>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <canvas id="chartStudent" style="background-color: transparent;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mx-4">
        <div class="col-12 col-md-8">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Teachers Attendance List</h6>
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Attendance</p>
                    </div>

                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <div class="table-responsive p-0">
                    <table id="teachers-table" class="table display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{$teacher->fullname}}</td>
                                <td>{{$teacher->phone_number}}</td>
                                
                                <td class="align-middle text-center text-sm">
                                    <?php
                                        if ($teacher->attend == "1") {
                                            echo "<span class='badge badge-sm bg-success'>Attended</span>";
                                        }
                                        elseif ($teacher->attend == "0") {
                                            echo "<span class='badge badge-sm bg-secondary'>Absent</span>";
                                        }
                                    
                                    ?>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Fullname</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4" style="display: flex;">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center py-2">
                        <p class="mb-0">Today's Attendance</p>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2">
                    <canvas id="chartTeacher" style="background-color: transparent;"></canvas>
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
    $(document).ready(function () {
        $('#teachers-table').DataTable();
    });

</script>

<!-- jQuery Script -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
<!-- Datatable Script -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
        var studentsattend = JSON.parse("{{ json_encode($studentsattendNum) }}");
        var studentsabsent = JSON.parse("{{ json_encode($studentsabsentNum) }}");
        const ctx = document.getElementById("chartStudent").getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
            labels: ["Attended","Absent"],
            datasets: [{
                label: 'attendance-donut',
                data: [studentsattend, studentsabsent],
                backgroundColor: ["#fb6340","#8392ab"]
            }]
            },
            // options: {
            //     legend: {
            //         display: false,
            //     },
            //     tooltips: {
            //         callbacks: {
            //             label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`, 
            //             title: () => null,
            //         }
            //     },
            // },
        });
</script>
<script>
        var teachersattend = JSON.parse("{{ json_encode($teachersattendNum) }}");
        var teachersabsent = JSON.parse("{{ json_encode($teachersabsentNum) }}");
        const ctx2 = document.getElementById("chartTeacher").getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
            labels: ["Attended","Absent"],
            datasets: [{
                label: 'attendance-donut',
                data: [teachersattend, teachersabsent],
                backgroundColor: ["#fb6340","#8392ab"]
            }]
            },
            // options: {
            //     legend: {
            //         display: false,
            //     },
            //     tooltips: {
            //         callbacks: {
            //             label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`, 
            //             title: () => null,
            //         }
            //     },
            // },
        });
</script>
@endpush
