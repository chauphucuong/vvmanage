@extends('home')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid row-container-fluid">
            <div class="row header-table-software">
                <div class="col-md-10">
                </div>
                <div class="col-lg-2" >
                    <h3 class="nav navbar-top-links navbar-right" > Total Computers: {{ $pcinfo->count() }}
                    </h3>
                </div>
            </div>
            <div class="row ">
            <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover tablehome" id="users-table"align="center">
                    <thead>
                    <tr align="center">
                        <th width="200px">COMPUTER NAME </th>
                        <th width="150px">IP</th>
                        <th width="250px">OS VERSION</th>
                        <th width="150px">USER</th>
                        <th width="150px">LAST UPDATE</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($pcinfo as $pc)
                        <?php $computer = App\PcInfo::where('PCname',$pc->PCname)->first();
                                $date= App\PcInfo::where('PCname',$pc->PCname)->max('LatUpdate');?> 
                        <tr class="odd gradeX" align="left">
                            <td><a href="OS/{{ $computer->PCname }}">{{ $computer->PCname }}</a></td>
                            <td>{{  $computer->PCIP}}</td>
                            <td>{{  $computer->OSName}}</td>
                            <td>{{  $computer->Username}}</td>
                            <td> {{  date('m/d/Y h:m:s', $date+strtotime("2000-1-1"))}} </td>
                        </tr>
                        @endforeach
                    </tbody> 
                </table>
                <button  type="submit" class="btnExportData" onclick="window.location.href='home/getComputerDownload'">
                    Export Data
                </button>
            </div>
            
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
<script type="text/javascript">
$(document).ready( function () {
    var height = ($('.container-fluid').height() - ($('.container-fluid').height() * 0.1))+ 'px';
    console.log(height);
    $('#users-table').DataTable({
        "scrollY": height,
        "scrollCollapse": true,
        "pagingType": "full",
        "iDisplayLength": 50,
        "language": {
            "info": "Showing page _PAGE_ of _PAGES_",
        }
        });
    $('.dataTables_length').addClass('bs-select');
    console.log('sdf');
    $('.dataTables_scrollBody').css('max-height', '100vh');
});
</script>
@endsection
