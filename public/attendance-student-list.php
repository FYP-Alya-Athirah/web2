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
