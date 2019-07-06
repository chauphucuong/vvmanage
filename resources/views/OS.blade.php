@extends('home')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row header-table-softwarelist">
                <div class="col-md-2">
                   <h1> OS Information</h1>
                </div>
                <div class="col-md-3 borderleft">
                   <a href="/SoftwareList/{{ $pcinfo->id }}"><h1> Software List</h1></a>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-3 ">
                    <h3 class="nav navbar-top-links " >{{ $pcinfo->PCname }} / {{ $pcinfo->PCIP }}
                    </h3>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">
                <table class="table tbindex" >
                    <thead>
                    <tr align="left">
                        <th>Name</th>
                        <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td>OS Name</td>
                            <td>{{$pcinfo->OSName}}</td>
                        </tr>
                        <tr >
                            <td>Version</td>
                            <td>{{$pcinfo->OSVersion}}</td>
                        </tr>
                        <tr class="odd gradeX" >
                            <td>OS Active</td>
                            <td>{{ $pcinfo->OSActive }}</td>
                        </tr>
                        <tr class="odd gradeX" >
                            <td>Username</td>
                            <td>{{ $pcinfo->Username }}</td>
                        </tr>
                        <tr class="odd gradeX" >
                            <td>PC IP</td>
                            <td>{{ $pcinfo->PCIP }}</td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
