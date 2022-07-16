@extends('layout')
@section('content')
<div>
    <div class="container" style="margin-top: 100px;">
        <h2>Attendance</h2>
        <table id="presentTable" class="table table-bordered">
            @if (count($emp_res) > 0)
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Working Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            @endif
            <tbody>
                @if ($emp_res)
                    @php $i = 0; @endphp
                    @foreach ($emp_res as $row)
                        <tr>
                            <td class="id-value">{{ $row->id }}</td>
                            <td class="name-value">{{ $row->name }}</td>
                            <td class="date-value"><input type="date" id="current-date" name="current-date" value="@php echo date('Y-m-d'); @endphp" /></td>
                            <td class="status-value">
                                <input id="@php echo 'present' . $i @endphp" type="radio" name="@php echo 'present-group' . $i; @endphp" value="1" @php echo ($row->working_status == "1" ? 'checked="checked"': ''); @endphp />Present
                                <input id="@php echo 'absent' . $i @endphp" type="radio" name="@php echo "present-group" . $i; @endphp" value="0" @php echo ($row->working_status == "0" ? 'checked="checked"': ''); @endphp />Absent
                            </td>
                            <td class="button-value"><button onclick="saveSingleData(this)" class="btn btn-info">Save</button></td>
                        </tr>
                    @php $i++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        <table id="absentTable" class="table table-bordered">
            @if (count($emp_res) == 0)
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Working Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            @endif
            <tbody>
                @if ($absent_emp)
                    @php $i = 0; @endphp
                    @foreach ($absent_emp as $row)
                        <tr>
                            <td class="id-value">{{ $row->id }}</td>
                            <td class="name-value">{{ $row->name }}</td>
                            <td class="date-value"><input type="date" id="current-date" name="current-date" value="@php echo date('Y-m-d'); @endphp" /></td>
                            <td class="status-value">
                                <input type="radio" name="@php echo 'absent-group' . $i; @endphp" onclick="" value="1" />Present
                                <input type="radio" name="@php echo 'absent-group' . $i; @endphp" onclick="" value="0" checked="checked" />Absent
                            </td>
                            <td class="button-value"><button onclick="saveSingleData(this)" class="btn btn-info">Save</button></td>
                        </tr>
                    @php $i++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        <button onclick="saveAllData()" class="btn btn-danger" type="submit" name="saveall" value="submit">Save</button>
    </div>
</div>
@endsection