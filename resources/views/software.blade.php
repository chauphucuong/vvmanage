<div class="container-fluid ">
    <div class="row ">
        <div class="col-12 text-center headersoftware">
            {{ $pcid->Softwarename }}
            <button type="button" class="close" aria-label="Close" >
                <span aria-hidden="true" >&times;</span>
            </button>
        </div>
        <table class="table table-striped table-bordered table-hover bg-white" align="center" >
            <thead>
                <tr align="center">
                    <th>COMPUTER NAME</th>
                    <th>IP</th>
                    <th>USER</th>
                    <th>INSTALLDATE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pcinfo as $pc)
                <?php $computer = App\PcInfo::where('PCname',$pc->PCname)->first();
                $date= App\PcInfo::where('PCname',$pc->PCname)->max('Installed')?>
                    <tr class="odd gradeX" align="left">
                        <td ><a href="OS/{{ $computer->PCname }}" >{{$computer->PCname}}</a></td>
                        <td>{{$computer->PCIP}}</td>
                        <td>{{ $computer->Username }}</td>
                        <?php $string = date('d/m/Y', $computer->Installed+strtotime("2000-1-1")); ?>
                        <td> {{  $string}} </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        <button  type="submit" class="btnExportSF" onclick="window.location.href='software/getSoftwareDownload/{{ $pcid->id }}'">
            Export Data
        </button>
    </div>
</div>
<script>
$(document).ready(function(){
    $(".close").click(function(){
        $(".show1").hide();
    });
});
</script>
