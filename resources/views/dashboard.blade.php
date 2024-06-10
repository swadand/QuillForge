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
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">import_contacts</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Books Remaining</p>
                                <h4 class="mb-0">3</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">library_books</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Shared Books</p>
                                <h4 class="mb-0">7</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">book</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Completed Books</p>
                                <h4 class="mb-0">2</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">groups</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Teams</p>
                                <h4 class="mb-0">4</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p> --}}
                        </div>
                    </div>
                </div>
            </div>
            <hr class="dark horizontal">

            {{-- MAIN CONTENT --}}
            <div class="container-fluid mt-4 px-3">
                <nav aria-label="breadcrumb">
                    <h5 class="font-weight-bolder">Books</h5>
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
                                    <h6 class="mb-0 ">Book Title </h6>
                                    <p class="text-sm">
                                        <i class="fa-solid fa-people-group"></i> Sparta - AB
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
                    <div class="text-center mt-5">
                      <h5 class="text-dark">No Books, Start Typing a New One!</h5>
                    </div>
                @endif


            </div>
        </div>
    </main>
    @include('common.footer')
</body>

</html>
