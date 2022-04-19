<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pencarian Tembang Bali</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Pencarian</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Bootstrap Switch -->
        <div class="card card-secondary">
            <form action="/search" method="get">
                <div class="card-header">
                    <h3 class="card-title">Filter</h3>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h3>Output</h3>
                                <select class="form-control select2" name="variable" id="variable" style="width: 100%;">
                                    @foreach ($output as $key => $value)
                                    <option @if ($value=="*" || (!empty($_GET) && $_GET['variable']==$value) )
                                        selected="selected" @endif value="{{ $value  }}">{{ ucwords(  $key) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($filter as $keyFilter => $itemFilter)
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{ ucwords($keyFilter) }}</label>
                                <select class="form-control select2" id="{{ $keyFilter  }}" name="{{ $keyFilter }}"
                                    style="width: 100%;">
                                    <option selected="selected" value=""></option>
                                    @foreach ($itemFilter as $key => $value)
                                    <option value="{{ $value["filter"]["value"]  }}" @if ((!empty($_GET) &&
                                        isset($_GET[$keyFilter]) && $_GET[$keyFilter]==$value["filter"]["value"]))
                                        selected="selected" @endif>{{ $value["filter"]["value"]  }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        @endforeach

                        <div class="col-md-3">
                            <div class="form-group">

                                <label>&nbsp;</label>
                                <div class="col-auto d-flex align-items-center">
                                    <div class="btn-group">
                                        <button class="btn btn-primary start">
                                            <i class="fas fa-search"></i>
                                            <span>Cari</span>
                                        </button>
                                        <a href="/search" class="btn btn-warning cancel">
                                            <i class="fas fa-times-circle"></i>
                                            <span>Reset</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->


        <!-- Bootstrap Switch -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Hasil</h3>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Hasil Pencarian</label>
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    @if (!empty($data))
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                @foreach($data["head"]["vars"] as $key=>$value)
                                                @if (!str_contains($value,'tembang') && !str_contains($value,'Main') )
                                                <th>{{ ucwords( $value)  }}</th>
                                                @endif
                                                @endforeach
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data["results"]["bindings"] as $key=>$value)
                                            <tr>
                                                <th>{{ intval($key+1)  }}</th>
                                                @php($itemSearch = $value)
                                                @foreach($itemSearch as $keyItem=>$valueItem)
                                                @if (!str_contains($keyItem,'tembang') && !str_contains($keyItem,'Main')
                                                )
                                                <th>{{ ucwords( $valueItem["value"])  }}</th>
                                                @endif
                                                @endforeach
                                                <th>
                                                    <div class="col-auto d-flex align-items-center">
                                                        <div class="btn-group mr-1">
                                                            <a href="detail?nama={{ $itemSearch["nama"]["value"]  }}"
                                                                class="btn btn-success">
                                                                <i class="fas fa-file-invoice"></i></a>
                                                        </div>
                                                        @if(isset($itemSearch["tembang"]["value"]))
                                                        <audio id="audio{{  intval($key+1)  }}" controls="controls"
                                                            style="width:  100px;
    overflow: hidden;   direction: ltl;    border-top-right-radius: 0.5em 0.5em;  border-bottom-right-radius: 1em 0.7em;   border-top-left-radius: 0.5em 0.5em;
    border-bottom-left-radius: 1em 0.7em; ">
                                                            <source
                                                                src="{{ asset("suara/".strtolower($itemSearch["tembang"]["value"]).".mp3")  }}"
                                                                type="audio/mpeg">
                                                        </audio>
                                                        @endif
                                                    </div>
                                                </th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>SPARQL Query</label>
                            <textarea class="card col-12 " rows="10"
                                disabled>@if (!empty($data)) {{ $data["query"]  }} @endif</textarea>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->