@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mes Notes</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body">
                            <table class="table table-bordered">
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
                            <a href="{{ route('student.downloadMarksPdf') }}" class="btn btn-danger mt-3">Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

