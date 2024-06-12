<table>
    <thead>
        <tr>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>NOTE DS</th>
            <th>NOTE EXAMEN</th>
            <th>NOTE TOTALE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($studentsWithMarks as $data)
            @foreach($data['marks'] as $mark)
            <tr>
                <td>{{ strtoupper($data['student']->last_name) }}</td>
                <td>{{ strtoupper($data['student']->name) }}</td>
                <td>{{ $mark->midterm }}</td>
                <td>{{ $mark->final_exam }}</td>
                <td>{{ $mark->total }}</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
