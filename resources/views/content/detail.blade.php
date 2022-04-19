<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Tembang Bali</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    @if (!empty($data))
    @php($Detail = $data["results"]["bindings"][0] )
    <div class="container-fluid">
        <div class="card centered p-3">
            <h4 class=" text-center">{{ ucwords($Detail['nama']['value']) }}</h4>
            <audio controls="controls" style="width:  100%;
    overflow: hidden;   direction: ltl;    border-top-right-radius: 0.5em 0.5em;  border-bottom-right-radius: 1em 0.7em;   border-top-left-radius: 0.5em 0.5em;
    border-bottom-left-radius: 1em 0.7em; ">
                <source src="{{ asset("suara/".strtolower($Detail["tembang"]["value"]).".mp3")  }}" type="audio/mpeg">
            </audio>
        </div>

        <div class="row">
            <div class="col-md-4">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Instance Attribute</h3>
                    </div>
                    <div class="card-body">
                        @foreach($attribute as $key => $value )
                        <div class="form-group">
                            <label>{{ ucfirst(  $key) }}:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" disabled value="{{ $value  }}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        @endforeach

                        <!-- /.form group -->


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (left) -->
            <div class="col-md-8">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Tentang Tembang Bali</h3>
                    </div>
                    <div class="card-body">
                        <!-- Date -->
                        @foreach($Detail as $key=>$value)
                        @if(!str_contains($key,"Main" ))
                        @if(isset($Detail[$key."Main"]))
                        @php( $useLink = true)
                        @else
                        @php( $useLink = false)
                        @endif
                        <div class="form-group">
                            <label>{{ ucfirst( $key)  }}:</label>
                            @if($useLink)
                            <a href="search?variable=*&{{ $key  }}={{ $Detail[$key."Main"]["value"]  }}">
                                <div class="input-group  ">
                                    {{ $value["value"]  }}
                                </div>
                            </a>
                            @else
                            <div class="input-group  ">
                                {{ $value["value"]  }}
                            </div>
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col (right) -->
        </div>
    </div>
    @endif
    <!-- /.container-fluid -->
</section>
<!-- /.content -->