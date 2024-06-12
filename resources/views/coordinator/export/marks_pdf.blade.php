<!DOCTYPE html>
<html>
<head>
    <title>Affichage {{$class->name}} | {{$module->name}}</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #fff;
            color: #333;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .university-name {
            font-size: 24px;
            font-weight: bold;
        }

        .school-name {
            font-size: 18px;
        }
        .header-section {
            margin-bottom: 20px;
            display: flex; 
        }
        .header-item {
            flex-direction: row;
            flex-wrap: wrap;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            width: 100%;
            color: #333;
            font-weight: bold;
        }
        .class-name {
            background-color: #4CAF50; /* Green */
        }
        .module-name {
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
        <div class="header-item module-name">Module : {{ $module->name }}</div>
        <div class="header-item teacher-name">Enseignant: {{ $teacher->name }} {{ $teacher->last_name }}</div>
        <div class="header-item class-name">Niveau : {{ $class->name }}</div>
        {{-- <div class="header-item department">{{ $department->name }}</div>
        <div class="header-item filiere">Filière: {{ $filiere->name }}</div>
        <div class="header-item coordinator">Coordinateur: {{ $coordinator->name }} {{ $coordinator->last_name}}</div> --}}
{{--         <div class="header-item year">Année: {{ $year }}</div>
 --}}    </div>
    <table>
        <thead>
            <tr>
                <th>CNE/Massar</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Note DS</th>
                <th>Note d'examen final</th>
                <th>Totale </th>
                <th>V/R</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentsWithMarks as $data)
                @foreach($data['marks'] as $mark)
                <tr>
                    <td>{{ $data['student']->CNE }} </td>
                    <td>{{ $data['student']->name }} </td>
                    <td>{{ strtoupper($data['student']->last_name) }}</td>
                    <td>{{ $mark->midterm }}</td>
                    <td>{{ $mark->final_exam }}</td>
                    <td>{{ $mark->total }}</td>
                    @if ($mark->total >= 12)
                        <td class="v">V</td>
                    @elseif($mark->total < 12)
                        <td class="r">R</td>    
                    @endif
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
