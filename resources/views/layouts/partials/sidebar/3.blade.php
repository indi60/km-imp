<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-white sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-5 mb-5" href="#">
        <img src="{{ (asset('assets/images/logo/logo-sidebar.svg')) }}" width="100" height="100" alt="" srcset="">
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/home') }}">
            <img src="{{ (asset('assets/images/logo/home.svg')) }}" width="30" class="img-fluid" alt="" srcset="">
            <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b class="text-center">Home</b></span>
        </a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/article') }}">
            <img src="{{ (asset('assets/images/logo/explore.svg')) }}" width="30" class="img-fluid" alt="" srcset="">
            <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>Explore</b></span>
        </a>
    </li>

    <!-- Nav Item - User Information -->
    <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#profile" aria-expanded="true"
                aria-controls="collapseUtilities">
                @if (auth()->user()->avatar === null)
                    <img src="{{ asset('storage/photos/upload/avatar/default.png') }}" alt="avatar" width="30" class="img-fluid rounded-circle" srcset="">
                    <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>{{ Auth::user()->name }}</b></span>
                @else
                    <img src="{{ asset('storage/photos/upload/avatar/'.Auth::user()->avatar) }}" alt="avatar" width="30" class="img-fluid rounded-circle" srcset="">
                    <span class="ml-md-4 mb-sm-2" style="font-size: 17.5px"><b>{{ Auth::user()->name }}</b></span>
                @endif
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

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Footer -->
    <a class="sidebar-brand d-flex align-items-center justify-content-between mt-auto" href="#">
        <img src="{{ (asset('assets/images/logo/logo-footer.svg')) }}" width="110px" class="img-fluid" alt="" srcset="">
    </a>
    <p class="text-xs ml-3 text-dark">Powered by &copy;IMPStudio {{ Date('Y') }}</p>
    <!-- End of Footer -->

</ul>
<!-- End of Sidebar -->
