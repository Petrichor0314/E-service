@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header" >
        <div class="container-fluid">
            <div class="row mb-2" style="margin-top: 0.5cm">
                <div class="col-sm-6 display-4 " style="margin-left: 18px">
                    <h1 >My Subjects <i class="fas fa-book"></i></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-top: 0.75cm">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_messages')
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title">List of Subjects</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" style="background-color: #f8f9fa; color: #333;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th >Subject Name</th>
                                            <th>Subject Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getRecord as $value)
                                        <tr class="table-row" style="background-color:  #ffffff;">
                                            <td>{{ $value->subject_name }}</td>
                                            <td>{{ $value->subject_type }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

@section('script')
    <script type="text/javascript">
        // JavaScript for hover effect
        document.addEventListener("DOMContentLoaded", function() {
            const tableRows = document.querySelectorAll(".table-row");
            tableRows.forEach(row => {
                row.addEventListener("mouseover", function() {
                    this.style.backgroundColor = " #9ba8b5";
                });
                row.addEventListener("mouseout", function() {
                    this.style.backgroundColor = " #ffffff";
                });
            });
        });
    </script>
    </script>

@endsection
