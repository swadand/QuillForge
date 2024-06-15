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
    <style>
        .topics::-webkit-scrollbar {
            display: none;
        }
    </style>
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
                <nav aria-label="breadcrumb" class="d-flex justify-content-between">
                    <p class="h4 font-weight-bolder">{{ $team['team_name'] ?? '-' }}</p>
                    <div>
                        <button class="btn btn-success" type="button" data-bs-target="#create-team"
                            data-bs-toggle="offcanvas" aria-controls="offcanvasEnd">Create New Topic</button>
                        <button type="button" class="btn btn-info" data-bs-toggle="offcanvas"
                            data-bs-target="#members">
                            <i class="fa-solid fa-users"></i>
                        </button>
                        <button type="button" class="btn btn-info" data-bs-target="#notifications"
                            data-bs-toggle="modal">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                    </div>
                    {{-- MODALS --}}
                    <!-- Modal -->
                    <div class="modal fade" id="notifications" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Join Requests</h5>
                                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container w-100">
                                        <div class="row card p-3 border ">
                                            <div class="d-inline-flex justify-content-between">
                                                <div>
                                                    User name Wants to join Team
                                                </div>
                                                <div>
                                                    <span class="badge bg-success" style="cursor: pointer;">
                                                        <i class="fa-solid fa-check"></i>
                                                    </span>
                                                    <span class="badge bg-danger" style="cursor: pointer;">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- OFFCANVAS --}}
                    <div class="offcanvas offcanvas-end {{ $errors->any() ? ($errors->has('join-error') ? '' : 'show') : '' }}"
                        tabindex="-1" id="create-team" aria-labelledby="offcanvasEndLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasEndLabel" class="offcanvas-title">Create a New Topic</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <hr class="dark horizontal mt-0 mb-0">
                        <form action="{{ url('team/create') }}" method="post">
                            @csrf
                            <div class="offcanvas-body mx-0 flex-grow-0">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Topic Name</label>
                                    <input class="form-control" type="text" name="team_name" id="team_name">
                                </div>
                                @error('team_name')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                @error('name-error')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Book Name (Same as Topic name if empty)</label>
                                    <input class="form-control" type="text" name="team_name" id="team_name">
                                </div>
                                @error('team_name')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                @error('name-error')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Synopsis</label>
                                    <input class="form-control" type="text" name="description"
                                        id="team_description">
                                </div>
                                @error('description')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror

                                <button type="submit" class="btn btn-success d-grid mb-2 w-100">Create</button>
                                <button type="button" class="btn btn-label-success border d-grid w-100"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <div class="offcanvas offcanvas-end {{ $errors->any() ? ($errors->has('join-error') ? 'show' : ($errors->has('team_id') ? 'show' : '')) : '' }}"
                        tabindex="-1" id="members" aria-labelledby="offcanvasEndLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasEndLabel" class="offcanvas-title">Members</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <hr class="dark horizontal mt-0 mb-0">
                        <div class="offcanvas-body mx-0 flex-grow-0">
                            <div class="container w-100">
                                <div class="row card p-3 border mb-1">
                                    <div class="d-inline-flex justify-content-between">
                                        <div>
                                            <span class="text-dark">User name</span>
                                            <div class="text-sm">Leader</div>
                                        </div>
                                        <div>
                                            <span class="badge bg-danger" style="cursor: pointer;">
                                                kick
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row card p-3 border mb-1">
                                    <div class="d-inline-flex justify-content-between">
                                        <div>
                                            <span class="text-dark">User name</span>
                                            <div class="text-sm">Member</div>
                                        </div>
                                        <div>
                                            <span class="badge bg-danger" style="cursor: pointer;">
                                                kick
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="row">
                @if (isset($data))
                    @foreach ($data as $key)
                        <div class="col-lg-4 col-md-6 mt-1 mb-4">
                            <div class="card z-index-2 ">
                                <div
                                    class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent pt-4">
                                </div>
                                <div class="card-body">
                                    <div class="d-inline-flex w-100 justify-content-between">
                                        <p class="mb-0 h6">{{ $key['team_name'] }}</p>
                                        <p class="text-sm">#{{ $key['team_id'] }}</p>
                                    </div>
                                    <p class="text-sm">
                                        {{ $key['description'] ?? '-' }}
                                    </p>
                                    <p class="text-sm">
                                        <i class="fa-solid fa-users-line"></i> {{ $key->leader->first_name ?? '-' }}
                                    </p>{{ $key->members ?? '-' }}
                                    <hr class="dark horizontal">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex ">
                                            <i class="material-icons text-sm my-auto me-1">schedule</i>
                                            <p class="mb-0 text-sm"> updated 4 min ago </p>
                                        </div>
                                        <span
                                            class="badge {{ $key['status'] == 0 ? 'bg-gradient-danger' : 'bg-gradient-success' }}">{{ $key['status'] == 0 ? 'Inactive' : 'Active' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- <div class="text-center mt-5">
                      <h5 class="text-dark">No Teams, Create a New One!</h5>
                    </div> --}}
                    <div class="{{-- col-lg-4 col-md-6 mt-1 mb-4 --}}w-50">
                        <div class="card z-index-2">
                            <div class="card-header pt-4 pb-0 mb-0 text-dark h4">
                                Topics
                            </div>
                            <hr class="dark horizontal mb-0">
                            <div class="container overflow-auto topics" style="max-height: 360px !important;">
                                <div class="row my-2 mx-1">
                                    <div class="card z-index-4 border">
                                        <div class="d-inline-flex justify-content-between mt-3">
                                            <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                            <div class="d-inline-flex justify-content-between">
                                                <span
                                                    class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                                <a href="javascript:0;" class="mx-1">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body text-sm px-1">
                                            Write the Synopsis for the chapter 1.
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2 mx-1">
                                    <div class="card z-index-4 border">
                                        <div class="d-inline-flex justify-content-between mt-3">
                                            <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                            <div class="d-inline-flex justify-content-between">
                                                <span
                                                    class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                                <a href="javascript:0;" class="mx-1">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body text-sm px-1">
                                            Write the Synopsis for the chapter 1.
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2 mx-1">
                                    <div class="card z-index-4 border">
                                        <div class="d-inline-flex justify-content-between mt-3">
                                            <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                            <div class="d-inline-flex justify-content-between">
                                                <span
                                                    class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                                <a href="javascript:0;" class="mx-1">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body text-sm px-1">
                                            Write the Synopsis for the chapter 1.
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2 mx-1">
                                    <div class="card z-index-4 border">
                                        <div class="d-inline-flex justify-content-between mt-3">
                                            <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                            <div class="d-inline-flex justify-content-between">
                                                <span
                                                    class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                                <a href="javascript:0;" class="mx-1">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body text-sm px-1">
                                            Write the Synopsis for the chapter 1.
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2 mx-1">
                                    <div class="card z-index-4 border">
                                        <div class="d-inline-flex justify-content-between mt-3">
                                            <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                            <div class="d-inline-flex justify-content-between">
                                                <span
                                                    class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                                <a href="javascript:0;" class="mx-1">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body text-sm px-1">
                                            Write the Synopsis for the chapter 1.
                                        </div>
                                    </div>
                                </div>
                                </tbody>
                                </table>
                                {{-- <h6 class="mb-0 ">Team Name </h6>
                                <p class="text-sm">
                                    Creator: AB
                                </p>
                                <hr class="dark horizontal">
                                <div class="d-flex flex-column">
                                    <div class="col-md-10">
                                        <i class="fa-solid fa-people-group"></i>
                                        <span class="mb-0 text-sm"> 7</span>
                                        <span class="mb-0 text-sm">Members</span>
                                    </div>
                                    <div class="col-md-10">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="mb-0 text-sm"> updated 4 min ago </span>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-footer pt-4 pb-0 mb-0 text-dark">
                            </div>
                        </div>
                    </div>
                @endif
                <div class="{{-- col-lg-4 col-md-6 mt-1 mb-4 --}}w-50">
                    <div class="card z-index-2">
                        <div class="card-header pt-4 pb-0 mb-0 text-dark h4">
                            Your Topics
                        </div>
                        <hr class="dark horizontal mb-0">
                        <div class="container overflow-auto topics" style="max-height: 360px !important;">
                            <div class="row my-2 mx-1">
                                <div class="card z-index-4 border">
                                    <div class="d-inline-flex justify-content-between mt-3">
                                        <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                        <div class="d-inline-flex justify-content-between">
                                            <span class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                            <a href="javascript:0;" class="mx-1">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <li class="dropdown pe-2 mx-2" style="list-style: none;">
                                                <a href="javascript:;" class="nav-link " id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Edit
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Forfeit
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-book"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Mark as Complete
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="card-body text-sm px-1">
                                        Write the Synopsis for the chapter 1.
                                    </div>
                                </div>
                            </div>
                             <div class="row my-2 mx-1">
                                <div class="card z-index-4 border">
                                    <div class="d-inline-flex justify-content-between mt-3">
                                        <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                        <div class="d-inline-flex justify-content-between">
                                            <span class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                            <a href="javascript:0;" class="mx-1">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <li class="dropdown pe-2 mx-2" style="list-style: none;">
                                                <a href="javascript:;" class="nav-link " id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Edit
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Forfeit
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-book"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Mark as Complete
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="card-body text-sm px-1">
                                        Write the Synopsis for the chapter 1.
                                    </div>
                                </div>
                            </div>
                             <div class="row my-2 mx-1">
                                <div class="card z-index-4 border">
                                    <div class="d-inline-flex justify-content-between mt-3">
                                        <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                        <div class="d-inline-flex justify-content-between">
                                            <span class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                            <a href="javascript:0;" class="mx-1">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <li class="dropdown pe-2 mx-2" style="list-style: none;">
                                                <a href="javascript:;" class="nav-link " id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Edit
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Forfeit
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-book"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Mark as Complete
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="card-body text-sm px-1">
                                        Write the Synopsis for the chapter 1.
                                    </div>
                                </div>
                            </div>
                             <div class="row my-2 mx-1">
                                <div class="card z-index-4 border">
                                    <div class="d-inline-flex justify-content-between mt-3">
                                        <div class="h5 text-start mb-0 pt-0">Chapter 1</div>
                                        <div class="d-inline-flex justify-content-between">
                                            <span class="badge badge-pill bg-gradient-warning w-100 mx-2">Open</span>
                                            <a href="javascript:0;" class="mx-1">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <li class="dropdown pe-2 mx-2" style="list-style: none;">
                                                <a href="javascript:;" class="nav-link " id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Edit
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Forfeit
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="javascript:0;">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-book"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Mark as Complete
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="card-body text-sm px-1">
                                        Write the Synopsis for the chapter 1.
                                    </div>
                                </div>
                            </div>
                            </tbody>
                            </table>
                            {{-- <h6 class="mb-0 ">Team Name </h6>
                                <p class="text-sm">
                                    Creator: AB
                                </p>
                                <hr class="dark horizontal">
                                <div class="d-flex flex-column">
                                    <div class="col-md-10">
                                        <i class="fa-solid fa-people-group"></i>
                                        <span class="mb-0 text-sm"> 7</span>
                                        <span class="mb-0 text-sm">Members</span>
                                    </div>
                                    <div class="col-md-10">
                                        <i class="fa-regular fa-clock"></i>
                                        <span class="mb-0 text-sm"> updated 4 min ago </span>
                                    </div>
                                </div> --}}
                        </div>
                        <div class="card-footer pt-4 pb-0 mb-0 text-dark">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    @include('common.footer')
</body>

</html>
