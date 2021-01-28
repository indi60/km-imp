<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-white sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-5 mb-5" href="#">
        <img src="{{ (asset('assets/images/logo/logo-sidebar.svg')) }}" width="100" height="100" alt="" srcset="">
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/home') }}">
            <img src="{{ (asset('assets/images/logo/home.svg')) }}" width="30" alt="" srcset="">
            <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b class="text-center">Home</b></span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/article') }}">
            <img src="{{ (asset('assets/images/logo/explore.svg')) }}" width="30" alt="" srcset="">
            <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>Explore</b></span>
        </a>
    </li>

    @if (auth()->user()->role_id == '1')
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <img src="{{ (asset('assets/images/logo/manage.svg')) }}" width="30" alt="" srcset="">
            <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>Manage</b></span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/manage-member') }}">
                    <img src="{{ (asset('assets/images/logo/manage-user.svg')) }}" width="30" height="20" alt="" srcset="">
                    <span class="ml-1" style="font-size: 14px"><b>User</b></span>
                </a>

                <a class="collapse-item" href="{{ url('/category-project') }}">
                    <img src="{{ (asset('assets/images/logo/manage-kategori-project.svg')) }}" width="30" height="20" alt="" srcset="">
                    <span class="ml-1" style="font-size: 14px"><b>Kategori Project</b></span>
                </a>

                <a class="collapse-item" href="{{ url('/laporan') }}">
                    <img src="{{ (asset('assets/images/logo/manage-laporan.svg')) }}" width="30" height="20" alt="" srcset="">
                    <span class="ml-1" style="font-size: 14px"><b>Laporan</b></span>
                </a>

                <a class="collapse-item" href="{{ url('/setting') }}">
                    <img src="{{ (asset('assets/images/logo/setting.svg')) }}" width="30" height="20" alt="" srcset="">
                    <span class="ml-1" style="font-size: 14px"><b>More+</b></span>
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/project') }}">
            <img src="{{ (asset('assets/images/logo/project.svg')) }}" width="30" alt="" srcset="">
            <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>Project</b></span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/issue') }}">
            <img src="{{ (asset('assets/images/logo/issue.svg')) }}" width="30" alt="" srcset="">
            <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>Issue</b></span>
        </a>
    </li>
    @else
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/ticket') }}">
            <img src="{{ (asset('assets/images/logo/issue.svg')) }}" width="30" alt="" srcset="">
            <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>Issue</b></span>
        </a>
    </li>
    @endif

    <!-- Nav Item - User Information -->
    <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#profile" aria-expanded="true"
                aria-controls="collapseUtilities">
                <img src="{{ asset('storage/photos/upload/avatar/'.Auth::user()->avatar) }}" alt="avatar" width="30" class="rounded-circle" srcset="">
                <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>{{ Auth::user()->name }}</b></span>
            </a>
            <div id="profile" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('/profile') }}">
                        <img src="{{ (asset('assets/images/logo/profile.svg')) }}" width="30" height="20" alt="" srcset="">
                        <span class="ml-1">Profile</span>
                    </a>
                    <a class="collapse-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <img src="{{ (asset('assets/images/logo/logout.svg')) }}" width="30" height="20" alt="" srcset="">
                        <span class="ml-1">Logout</span>
                    </a>
                </div>
            </div>
        </li>

    {{-- <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img class="ml-2 img-responsive img-fluid rounded-circle " width="33px"
                src="{{ asset('assets/images/avatar/'.Auth::user()->avatar) }}"
                alt="{{ Auth::user()->avatar }}">
            <span class="ml-2 d-none d-lg-inline text-dark-600 small"><b>{{ Auth::user()->name }}</b></span>
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-left shadow" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="/profile">
                <i class="fas fa-user-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Footer -->
    <a class="sidebar-brand d-flex align-items-center justify-content-between mt-auto" href="#">
        <img src="{{ (asset('assets/images/logo/logo-footer.svg')) }}" width="115" height="115" alt="" srcset="">
    </a>
    <p class="text-xs ml-3 text-dark">Powered by &copy;IMPStudio {{ Date('Y') }}</p>
    <!-- End of Footer -->

</ul>
<!-- End of Sidebar -->
