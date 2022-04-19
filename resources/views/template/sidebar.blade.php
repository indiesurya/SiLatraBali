<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color:#FF9933">

    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset ("/dist/img/AdminLTELogo.png")}}" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Lagu Tradisional</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header">Kriteria</li>
                @foreach($jenis as $jenisTembang)
                <li class="nav-item">
                    <a href="search?variable=*&jenis={{ $jenisTembang['tembang']['value']   }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $jenisTembang['nama']['value']  }}</p>
                    </a>
                </li>
                @endforeach
                <li class="nav-header"><a href="{{ asset("/search")  }}">Pencarian</a></li>
                <li class="nav-header"><a href="{{ asset("/browsing")  }}">Penjelajahan</a></li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>