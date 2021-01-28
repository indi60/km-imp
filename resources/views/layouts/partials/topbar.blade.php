<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-dark topbar mb-5" style="border-bottom-left-radius: 35px;">
    <!-- Topbar Navbar -->
    <div class="container">
        <div class="row" style="margin-left: 50px">
            <div class="col">
                <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none text-white rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <h1 class="text-lg-left mt-3 text-white"><strong>Welcome Back <br>{{ Auth::user()->name }}!</strong>
                </h1>
                <p class="text-lg-left mt-3 text-white">
                    Logged in as {{ Auth::user()->name }} <br>
                    Logged in at {{ date('D, d M Y H:i') }} <br>
                    Here's an update for you.
                </p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-5">
                                <img src="{{ (asset('assets/images/logo/project-topbar.svg')) }}"
                                    width="70" class="mr-5" alt="" srcset="">
                            </div>
                            <div class="col-auto">
                                <div class="h5 mb-0 font-weight-bold" style="font-size: 40px; color: black">
                                    {{ $countTotalProject }}
                                </div>
                                <div class="h6 mb-0 font-weight-bold" style="color: black">Projects</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-5">
                                <img src="{{ (asset('assets/images/logo/issue-topbar.svg')) }}"
                                    width="70" class="mr-5" alt="" srcset="">
                            </div>
                            <div class="col-auto">
                                <div class="h5 mb-0 font-weight-bold" style="font-size: 40px; color: black">
                                    {{ $countTotalTicket }}
                                </div>
                                <div class="h6 mb-0 font-weight-bold" style="color: black">Issues</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- End of Topbar -->
