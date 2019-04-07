<table>
    <thead>
    <tr>
        <th>{{trans('general.number')}}</th>
        <th>{{trans('general.form_no')}}</th>
        <th>{{trans('general.name')}}</th>
        <th>{{trans('general.last_name')}}</th>
        <th>{{trans('general.father_name')}}</th>
        <th>{{trans('general.grandfather_name')}}</th>
        <th>{{trans('general.gender')}}</th>
        <th>{{trans('general.province')}}</th>
        <th>{{trans('general.kankor_year')}}</th>
        <th>{{trans('general.school_name')}}</th>
        <th>{{trans('general.school_graduation_year')}}</th>
        <th>{{trans('general.department')}}</th>
        <th>{{trans('general.university')}}</th>
        <th>{{trans('general.grade')}}</th> 
        <th>{{trans('general.status')}}</th> 
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->form_no }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->last_name }}</td>
            <td>{{ $student->father_name }}</td>
            <td>{{ $student->grandfather_name }}</td>
            <td>{{ $student->gender == "Male" ? trans('general.Male') : trans('general.Female') }}</td>
            <td>{{ $student->province }}</td>
            <td>{{ $student->kankor_year }}</td>
            <td>{{ $student->school_name }}</td>
            <td>{{ $student->school_graduation_year }}</td>
            <td>{{ $student->department }}</td>
            <td>{{ $student->university }}</td>
            <td>{{ $student->grade }}</td>
            <td>{{ $student->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>