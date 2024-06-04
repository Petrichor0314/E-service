<!DOCTYPE html>
<html>
<head>
    <title>Marks PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Marks</h1>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Midterm Mark</th>
                <th>Final Exam Mark</th>
                <th>Total Mark</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentsWithMarks as $data)
                @foreach($data['marks'] as $mark)
                <tr>
                    <td>{{ $data['student']->name }} {{ $data['student']->last_name }}</td>
                    <td>{{ $mark->midterm }}</td>
                    <td>{{ $mark->final_exam }}</td>
                    <td>{{ $mark->total }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
