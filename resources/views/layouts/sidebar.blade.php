<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{ url('/dashboard') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>


                    @php
                    if(auth()->user()->user_type_id == 1){
                        $modules = ['userType', 'articleCategory', 'user', 'article'];
                    }elseif(auth()->user()->user_type_id == 2){
                        $modules = ['article'];
                    }else{
                        $modules = [];
                    }
                    @endphp

                    @foreach ($modules as $key => $value)
                        <a class="nav-link collapsed" href="#" data-toggle="collapse"
                            data-target="#collapseLayouts{{ $key }}" aria-expanded="false"
                            aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            {{ $value }}
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapseLayouts{{ $key }}" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ url($value . '/create') }}">Create</a>
                                <a class="nav-link" href="{{ url($value . '/') }}">Display</a>
                            </nav>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ auth()->user()->name }}
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
