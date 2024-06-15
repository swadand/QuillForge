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
                <nav aria-label="breadcrumb" class="d-flex justify-content-between">
                    <p class="h4 font-weight-bolder">Teams</p>
                    <div>
                        <button class="btn btn-success" type="button" data-bs-target="#create-team"
                            data-bs-toggle="offcanvas" aria-controls="offcanvasEnd">Create Team</button>
                        <button class="btn btn-success" type="button" data-bs-target="#join-team"
                            data-bs-toggle="offcanvas" aria-controls="offcanvasEnd">Join Team</button>
                    </div>
                    {{-- OFFCANVAS --}}
                    <div class="offcanvas offcanvas-end {{ $errors->any() ? ($errors->has('join-error') ? '' : 'show') : '' }}" tabindex="-1"
                        id="create-team" aria-labelledby="offcanvasEndLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasEndLabel" class="offcanvas-title">Create a New Team</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ url('u/team/create') }}" method="post">
                            @csrf
                            <div class="offcanvas-body mx-0 flex-grow-0">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Team Name</label>
                                    <input class="form-control" type="text" name="team_name" id="team_name">
                                </div>
                                @error('team_name')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                @error('name-error')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Description</label>
                                    <input class="form-control" type="text" name="description" id="team_description">
                                </div>
                                @error('description')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group">
                                    <label class="form-label mb-3">Status</label><br>
                                    <div class="d-inline-flex" style="margin-top:32px;">
                                        <div class="form-check col-md-7">
                                            <input class="form-check-input" type="radio" value="1" name="status"
                                                id="status_active" checked>
                                            <label class="form-check-label" for="status_active">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check col-md-7">
                                            <input class="form-check-input" type="radio" value="0" name="status"
                                                id="status_inactive">
                                            <label class="form-check-label" for="status_inactive">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                    @error('error')
                                        <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success d-grid mb-2 w-100">Create</button>
                                <button type="button" class="btn btn-label-success border d-grid w-100"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <div class="offcanvas offcanvas-end {{ $errors->any() ? ($errors->has('join-error') ? "show" : ($errors->has('team_id') ? 'show' : '')) : ''  }}" tabindex="-1"
                        id="join-team" aria-labelledby="offcanvasEndLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasEndLabel" class="offcanvas-title">Join a Team</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ url('u/team/join') }}" method="post">
                            @csrf
                            <div class="offcanvas-body mx-0 flex-grow-0">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Team Id</label>
                                    <input class="form-control" type="text" name="team_id" id="team_name">
                                </div>
                                @error('team_id')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                @error('join-error')
                                    <div class="p-0 mt-0 mb-2 text-sm text-danger">{{ $message }}</div>
                                @enderror
                                
                                <button type="submit" class="btn btn-success d-grid mb-2 w-100">Join</button>
                                <button type="button" class="btn btn-label-success border d-grid w-100"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
            <div class="row">
                @if (isset($data))
                    @foreach ($data as $key)
                        <div class="col-lg-4 col-md-6 mt-1 mb-4">
                            <div class="card z-index-2 ">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent pt-4">
                                </div>
                                <div class="card-body">
                                    <div class="d-inline-flex w-100 justify-content-between">
                                        <a href="{{ url('u/team') . "/" . $key['team_name'] }}" class="mb-0 h6">{{ $key['team_name'] }}</a>
                                        <p class="text-sm">#{{ $key['team_id'] }}</p>
                                    </div>
                                    <p class="text-sm">
                                        {{ $key['description'] ?? '-' }}
                                    </p>
                                    <p class="text-sm">
                                        <i class="fa-solid fa-users-line"></i> {{ $key->leader->first_name ?? '-' }}
                                    </p>{{-- {{ $key->members ?? "-" }} --}}
                                    <p>{{ count($key->members) }} Members</p>

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
                                        <span class="mb-0 text-sm"> 7</span>
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
