<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Browsing Tembang Bali</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    @if($mode==0)
    <div class="container-fluid">
        <h5 class="mb-2">Daftar jenis tembang bali</h5>
        <div class="row">
            @foreach($jenis as $item)
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>
                    <div class="info-box-content">
                        <h4 class="info-box-text">{{ $item["nama"]["value"]  }}</h4>
                        <span class="info-box-link"><a href="browsing?jenis={{ $item['tembang']['value']  }}">More
                                info..</a></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            @endforeach

        </div>
    </div><!-- /.container-fluid -->

    @elseif($mode==1)
    <div class="container-fluid">
        <h5 class="mb-2">Daftar aktivitas tembang bali</h5>
        <div class="row">
            @foreach($aktivitas as $item)
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>
                    <div class="info-box-content">
                        <h4 class="info-box-text">{{ $item["filter"]["value"]  }}</h4>
                        <span class="info-box-link"><a
                                href="browsing?aktivitas={{ $item["filter"]["value"]  }}&jenis={{$pilihan}}">More
                                info..</a></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            @endforeach

        </div>
    </div><!-- /.container-fluid -->
    @elseif($mode==2)
    <div class="container-fluid">
        <h5 class="mb-2">Daftar tembang bali</h5>
        <div class="row">
            @if (empty($data ))
            <div class="col-md-4 col-sm-6 col-12">
                tembang tidak ditemukan...
            </div>
            @else
            @foreach($data as $item)
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                    <div class="info-box-content">
                        <h4 class="info-box-text">{{ $item["nama"]["value"]  }}</h4>
                        <span class="info-box-link"><a href="detail?nama={{ $item["nama"]["value"]  }}">More
                                info..</a></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            @endforeach
            @endif
        </div>
    </div><!-- /.container-fluid -->
    @endif
</section>