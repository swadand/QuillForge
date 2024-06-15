<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                {{-- <div class="input-group input-group-outline">
                    <label class="form-label">Type here...</label>
                    <input type="text" class="form-control">
                </div> --}}
            </div>
            <ul class="navbar-nav  justify-content-end">

                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>

                <li class="nav-item dropdown pe-2">
                    <a href="javascript:;" class="nav-link " id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="material-icons cursor-pointer">
                            person
                        </i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <div class="dropdown-item border-radius-md">
                                {{ session("user_name") }}
                            </div>
                        </li>
                        <li class="mb-2">
                            <a class="dropdown-item border-radius-md" href="../pages/profile.php">
                                <div class="d-flex align-items-center py-1">
                                    <div class="my-auto">
                                        <span class="material-icons">
                                            settings
                                        </span>
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="text-sm font-weight-normal mb-0">
                                            Settings
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="">
                            <a class="dropdown-item border-radius-md" href="/logout">
                                <div class="d-flex align-items-center py-1">
                                    <div class="my-auto">
                                        <span class="material-icons">
                                            logout
                                        </span>
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="text-sm font-weight-normal mb-0">
                                            Logout
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>