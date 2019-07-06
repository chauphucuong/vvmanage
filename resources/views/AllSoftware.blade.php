@include('layouts.header')
<body class="body">
    <div id="app">
            <nav class="navbar navbar-expand-lg navbar-light backgroundhome ">
                <a class="navbar-brand" href="/home">
                    <img class="imgindex" src="/image/LogoVigilantSolutions.png" alt="" >
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse borderleft" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ">
                            <h3>  Software Portfolio</h3>
                    </ul>
                    <ul class="navbar-nav text-right">
                        <form class="form-inline my-2 my-lg-0">
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                       <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item admin" href="/login"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                         <i class="fa fa-sign-out fa-fw"></i>   {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                <!-- /.dropdown-user -->
                            </li>
                        </form>
                    </ul>
                </div>
            </nav>
            <div class="row row-body form-group">
                <div class="col-md-2 menu">
                    @include('layouts.menu')
                </div>
                <div class="col-md-10">
                     <form action="AllSoftware/getApply" method="post">
                        @csrf
                        <div id="page-wrapper">
                            <div class="container-fluid row-container-fluid">
                                <div class="row header-table-software">
                                    <div class="col-md-10">
                                            @if(count($errors)>0)
                                            <div class="alert alert-danger">
                                              @foreach($errors->all() as $err)
                                                  {{$err}}<br>
                                              @endforeach
                                              </div>
                                            @endif
                                            @if(session('thongbao'))
                                            <div class="alert alert-success">{{  session('thongbao')}}</div>
                                            @endif
                                    </div>
                                    <div class="col-lg-2">
                                        <h3 class="nav navbar-top-links navbar-right" > Total Software {{ $pcinfo->count() }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="row " id="software-table">
                                <!-- /.col-lg-12 -->
                                    <div class="show1 mr-1"></div>
                                    <table class="table table-striped table-bordered table-hover tablehome"  id="users-table2"align="center">
                                        <thead>
                                        <tr align="center">
                                            <th width="480px">SOFTWARE</th>
                                            <th width="200px">PUBLISHER</th>
                                            <th width="100px">INSTALLED</th>
                                            <th width="150px">LAST PC</th>
                                            <th width="20px">IGNORE</th>
                                        </tr>
                                        </thead>
                                        <tbody>   
                                        @foreach($pcinfo as $pc)
                                            <?php   $software = App\PcInfo::where('Softwarename',$pc->Softwarename)->first();
                                                     $date= App\PcInfo::where('Softwarename',$pc->Softwarename)->max('LatUpdate');
                                                    $name=trim($software->Softwarename)?>
                                            <tr class="odd gradeX" align="left">
                                                {{-- {!! $software->Softwarename !!}   Hiển thị chuỗi có kí tự đặc biêt--}}
                                            <td>
                                                <a href="#" data-id="{{ $software->id }}" class="ShowPopUp"> 
                                                    {!!  str_replace('?', '-',utf8_decode($name))!!}
                                                </a>
                                            </td>
                                                <td>{{  $software->Publisher}}</td>
                                                <td> {{  date('m/d/Y', $date+strtotime("2000-1-1"))}} </td>
                                                <td><a href="/OS/{{  $software->PCname }}">{{  $software->PCname}}</a></td>
                                                <td align="center"><input type="checkbox" value="{{ $software->Softwarename }} /{{  Auth::id()  }}" id="remember_me" name="checkbox[]"></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <button  type="button" class="btnExportData" onclick="window.location.href='AllSoftware/getAllSoftwareDownload'">
                                        Export Data
                                    </button>
                                    <button type="submit" name="savebtn" class="btnExportData1" onclick="window.location.href='AllSoftware/getApply'">
                                        Apply
                                    </button>
                                    
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                    </form>
                    
                    
                </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".ShowPopUp").click(function(){
                var id=$(this).data('id');
                $.ajax({
                    url: '/software/'+id,
                    type: 'GET',
                    success: function(data) {
                        //called when successful
                        $(".show1").show();
                        $('.show1').html(data);
                    },
                    error: function(e) {
                        // called when there is an error
                        // console.log(e.message);
                    }
                    });
            });

            var height = ($('.container-fluid').height() - ($('.container-fluid').height() * 0.96895))+ 'px';
            console.log(height);
            $('#users-table2').DataTable({
                        "scrollY": height,
                        "scrollCollapse": true,
                        "pagingType": "full",
                        "iDisplayLength": 50,
                        // // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "language": {
                                "info": "Showing page _PAGE_ of _PAGES_",
                            }
                        });
            toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
            // $('#tableInfo').html(
            //     'Currently showing page '+(info.page+1)+' of '+info.pages+' pages.'
            // );            
            $('.dataTables_length').addClass('bs-select');

        });
    </script>
</body>
</html>

