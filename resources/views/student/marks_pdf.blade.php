<!DOCTYPE html>
<html>
<head>
    <title>Mes Notes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #fff;
            color: #333;
            padding: 20px;
            text-align: center;
        }
        .university-name {
            font-size: 24px;
            font-weight: bold;
        }

        .school-name {
            font-size: 18px;
        }
        .header-section {
            display: flex; 
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header-item {
            padding: 10px;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
        }
        .class-name {
            background-color: #4CAF50; /* Green */
        }
        .student-name {
            background-color: #2196F3; /* Blue */
        }
        .department, .filiere, .teacher-name, .year , .coordinator {
            background-color: #ff9800; /* Orange */
        }
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
        .v {
            background: white;
        }
        .r {
            background: red;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="university-name">Université Abdelmalek Essaadi</div>
        <div class="school-name">Ecole Nationale des Sciences Appliquées d'Al Hoceima</div>
    </div>
    <div class="header-section">
        <div class="header-item student-name">Nom complet : {{ $student->name }} {{ $student->last_name }}</div>
        <div class="header-item class-name">Classe : {{ $class->name }}</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Module</th>
                <th>Note de DS</th>
                <th>Note d'Examen Final</th>
                <th>Note Totale</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marks as $mark)
                <tr>
                    <td>{{ $mark->module_name }}</td>
                    <td>{{ $mark->midterm }}</td>
                    <td>{{ $mark->final_exam }}</td>
                    <td style="color: {{ $mark->total >= 12 ? 'green' : 'red' }};">
                        {{ $mark->total }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Moyenne Totale</th>
                <th>{{ number_format($averageTotalMark, 2) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
