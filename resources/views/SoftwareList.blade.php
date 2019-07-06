@extends('home')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid row-container-fluid">
                <div class="row header-table-softwarelist">
                        <div class="col-md-2">
                                <a href="/OS/{{ $pcid->PCname }}">  <h1> OS Information</h1></a>
                        </div>
                        <div class="col-md-3 borderleft">
                           <h1> Software List</h1>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-3">
                        <tr >
                            <td><h3 class="nav navbar-top-links navbar-right" >{{ $pcid->PCname }} / {{ $pcid->PCIP }}<br>Total software {{$pcinfo->count()  }}</h3></td>
                        </tr>
                        </div>
                    </div>
            <!-- /.col-lg-12 -->
            <div class="row ">
                <table class="table table-striped table-bordered table-hover tablehome" id="users-table1" align="center">
                    <thead>
                    <tr align="center">
                        <th  width="530px">SOFTWARE</th>
                        <th width="200px">PUBLISHER</th>
                        <th width="150px">INSTALLED</th>
                        <th width="50px">SIZE</th>
                        <th width="20px"> VERSION</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($pcinfo as $pc)
                        <?php $computer = App\PcInfo::where('Softwarename',$pc->Softwarename)->first();
                                $date= App\PcInfo::where('Softwarename',$pc->Softwarename)->max('LatUpdate');
                              $name=trim($computer->Softwarename)?>
                        <tr class="odd gradeX" align="left">
                            <td> {!!  str_replace('?', '-',utf8_decode($name))!!}</td>
                            <td>{{  $computer->Publisher}}</td>
                            @if($computer->Installed ==0)               
                            <td></td>
                            @else
                            <td> {{  date('m/d/Y ', $date+strtotime("2000-1-1"))}} </td>
                            @endif
                            @if($computer->Size ==null || $computer->Size == " ")
                                <td> </td>
                            @else
                                <td>{{ number_format($computer->Size/1024,2)}}MB</td>
                            @endif    
                            <td> {{  $computer->Version}} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button  type="submit" class=" btnExportData" onclick="window.location.href='/SoftwareList/getSoftwareListDownload/{{ $pcid->id }}'">
                        Export Data
                </button>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<script type="text/javascript">

    $(document).ready( function () {
        var height = ($('.container-fluid').height() - ($('.container-fluid').height() * 0.830))+ 'px';
        console.log(height);
        $('#users-table1').DataTable({
            "scrollY": height,
            "scrollCollapse": true,
            "pagingType": "full",
            "iDisplayLength": 50,
            "language": {
            "info": "Showing page _PAGE_ of _PAGES_",
        }
    });
        $('.dataTables_length').addClass('bs-select');
        });
</script>
@endsection
