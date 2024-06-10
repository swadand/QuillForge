<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Material Dashboard 2 by Creative Tim
    </title>

    @include('common.header')

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('common.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('common.navbar')

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            {{-- MAIN CONTENT --}}
            <div class="container-fluid px-3">
                <nav aria-label="breadcrumb">
                    <h4 class="font-weight-bolder">Teams</h4>
                </nav>
            </div>
            <div class="row">
                @if (isset($data))
                    @foreach ($data as $key)
                        <div class="col-lg-4 col-md-6 mt-1 mb-4">
                            <div class="card z-index-2  ">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent pt-4">
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-0 ">Team Name </h6>
                                    <p class="text-sm">
                                        <i class="fa-solid fa-users-line"></i> Sparta - AB
                                    </p>
                                    <hr class="dark horizontal">
                                    <div class="d-flex ">
                                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                                        <p class="mb-0 text-sm"> updated 4 min ago </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- <div class="text-center mt-5">
                      <h5 class="text-dark">No Teams, Create a New One!</h5>
                    </div> --}}
                    <div class="col-lg-3 col-md-6 mt-1 mb-4">
                        <div class="card z-index-2">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent pt-4">
                            </div>
                            <div class="card-body">
                                <h6 class="mb-0 ">Team Name </h6>
                                <p class="text-sm">
                                    Creator: AB
                                </p>
                                <hr class="dark horizontal">
                                <div class="d-flex flex-column">
                                    <div class="col-md-10">
                                        <i class="fa-solid fa-people-group"></i>
                                        <span class="mb-0 text-sm">  7</span>
                                        <span class="mb-0 text-sm">Members</span>
                                    </div>
                                    <div class="col-md-10">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="mb-0 text-sm"> updated 4 min ago </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </main>
    @include('common.footer')
</body>

</html>
