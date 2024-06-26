<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Books
    </title>

    @include('common.header')

</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('common.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        @include('common.navbar')

        <!-- End Navbar -->
        <div class="container-fluid py-4 ">
            {{-- MAIN CONTENT --}}
            <div class="container-fluid mt-4 px-3 d-inline-flex gap-4">
                <nav aria-label="breadcrumb">
                    <h5 class="font-weight-bolder">Open Books</h5>
                </nav>
            </div>
            @isset($data['open'])
            @if (!empty($data['open']))
                <div class="row">
                    @foreach ($data['open'] as $key)
                        <div class="col-lg-4 col-md-6 mt-1 mb-4">
                            <div class="card z-index-4">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent pt-4">
                                </div>
                                <div class="card-body">
                                    <div class="d-inline-flex justify-content-between w-100">
                                        <p class="mb-0 h6">{{ $key['title'] }}</p>

                                        <div class="d-inline-flex justify-content-between">
                                            <div
                                                class="badge badge-pill bg-gradient-{{ $key['status'] == 0 ? 'danger' : ($key['status'] == 1 ? 'warning' : 'success') }} w-100 mx-2">
                                                {{ $key['status'] == 0 ? 'Closed' : ($key['status'] == 1 ? 'Open' : 'Completed') }}
                                            </div>
                                            <a href="javascript:0;" data-bs-target="#edit-book" data-bs-toggle="offcanvas"
                                                aria-controls="offcanvasEnd" class="mx-1 edit"
                                                data-id="{{ $key['book_id'] }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>

                                            <li class="dropdown pe-2 mx-2" style="list-style: none;">
                                                <a href="javascript:;" class="nav-link" data-id="{{ $key['book_id'] }}"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="{{ url('u/editor/b') . '/' . $key['book_id'] }}">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-regular fa-eye"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Open
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md forfeit"
                                                            href="javascript:0;" data-id="{{ $key['book_id'] }}">
                                                            <div class="d-flex align-items-center py-1 ">
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
                                                        <a class="dropdown-item border-radius-md complete"
                                                            href="javascript:0;" data-id="{{ $key['book_id'] }}">
                                                            <div class="d-flex align-items-center py-1 ">
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
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md delete"
                                                            href="javascript:0;" data-id="{{ $key['book_id'] }}">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Delete
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </div>
                                    <p class="text-sm">{{ $key['description'] ?? '-' }}</p>
                                    <p class="text-sm">
                                        @isset($key->team)
                                            <i class="fa-solid fa-people-group"></i> {{ $key->team ?? '' }}
                                        @endisset
                                    </p>
                                    {{-- <hr class="dark horizontal">
                                    <div class="d-flex ">
                                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                                        <p class="mb-0 text-sm"> updated 4 min ago </p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center mt-5 mb-5">
                        <h5 class="text-dark">No Books, Start Typing a New One!</h5>
                    </div>
                    @endif
                @endisset
            </div>
        </div>

        <div class="container-fluid mt-4 px-3 d-inline-flex gap-4">
            <nav aria-label="breadcrumb">
                <h5 class="font-weight-bolder">Completed Books</h5>
            </nav>
        </div>
        @isset($data['completed'])
        @if (!empty($data['completed']))
            <div class="row">
                @foreach ($data['completed'] as $key)
                    <div class="col-lg-4 col-md-6 mt-1 mb-4">
                        <div class="card z-index-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent pt-4">
                            </div>
                            <div class="card-body">
                                <div class="d-inline-flex justify-content-between w-100">
                                    <p class="mb-0 h6">{{ $key['title'] }}</p>

                                    <div class="d-inline-flex justify-content-between">
                                        <div
                                            class="badge badge-pill bg-gradient-{{ $key['status'] == 0 ? 'danger' : ($key['status'] == 1 ? 'warning' : 'success') }} w-100 mx-2">
                                            {{ $key['status'] == 0 ? 'Closed' : ($key['status'] == 1 ? 'Open' : 'Completed') }}
                                        </div>
                                        <a href="javascript:0;" data-bs-target="#edit-book" data-bs-toggle="offcanvas"
                                            aria-controls="offcanvasEnd" class="mx-1 edit"
                                            data-id="{{ $key['book_id'] }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        <li class="dropdown pe-2 mx-2" style="list-style: none;">
                                            <a href="javascript:;" class="nav-link" data-id="{{ $key['book_id'] }}"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4"
                                                aria-labelledby="dropdownMenuButton">
                                                <li class="mb-2">
                                                    <a class="dropdown-item border-radius-md"
                                                        href="{{ url('u/editor/b') . '/' . $key['book_id'] }}">
                                                        <div class="d-flex align-items-center py-1">
                                                            <div class="my-auto">
                                                                <span>
                                                                    <i class="fa-regular fa-eye"></i>
                                                                </span>
                                                            </div>
                                                            <div class="ms-2">
                                                                <h6 class="text-sm font-weight-normal mb-0">
                                                                    Open
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="mb-2">
                                                    <a class="dropdown-item border-radius-md forfeit" href="javascript:0;"
                                                        data-id="{{ $key['book_id'] }}">
                                                        <div class="d-flex align-items-center py-1 ">
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
                                                    <a class="dropdown-item border-radius-md complete"
                                                        href="javascript:0;" data-id="{{ $key['book_id'] }}">
                                                        <div class="d-flex align-items-center py-1 ">
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
                                                <li class="mb-2">
                                                    <a class="dropdown-item border-radius-md delete" href="javascript:0;"
                                                        data-id="{{ $key['book_id'] }}">
                                                        <div class="d-flex align-items-center py-1">
                                                            <div class="my-auto">
                                                                <span>
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </span>
                                                            </div>
                                                            <div class="ms-2">
                                                                <h6 class="text-sm font-weight-normal mb-0">
                                                                    Delete
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </div>
                                </div>
                                <p class="text-sm">{{ $key['description'] ?? '-' }}</p>
                                <p class="text-sm">
                                    @isset($key->team)
                                        <i class="fa-solid fa-people-group"></i> {{ $key->team ?? '' }}
                                    @endisset
                                </p>
                                {{-- <hr class="dark horizontal">
                                    <div class="d-flex ">
                                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                                        <p class="mb-0 text-sm"> updated 4 min ago </p>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center mt-5 mb-5">
                    <h5 class="text-dark">No Completed Books, Take your time.</h5>
                </div>
                @endif
            @endisset
        </div>
        </div>

        <div class="container-fluid mt-4 px-3 d-inline-flex gap-4">
            <nav aria-label="breadcrumb">
                <h5 class="font-weight-bolder">Open Books</h5>
            </nav>
        </div>
        @isset($data['closed'])
            @if (!empty($data['closed']))
                <div class="row">
                    @foreach ($data['closed'] as $key)
                        <div class="col-lg-4 col-md-6 mt-1 mb-4">
                            <div class="card z-index-4">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent pt-4">
                                </div>
                                <div class="card-body">
                                    <div class="d-inline-flex justify-content-between w-100">
                                        <p class="mb-0 h6">{{ $key['title'] }}</p>

                                        <div class="d-inline-flex justify-content-between">
                                            <div
                                                class="badge badge-pill bg-gradient-{{ $key['status'] == 0 ? 'danger' : ($key['status'] == 1 ? 'warning' : 'success') }} w-100 mx-2">
                                                {{ $key['status'] == 0 ? 'Closed' : ($key['status'] == 1 ? 'Open' : 'Completed') }}
                                            </div>
                                            <a href="javascript:0;" data-bs-target="#edit-book"
                                                data-bs-toggle="offcanvas" aria-controls="offcanvasEnd" class="mx-1 edit"
                                                data-id="{{ $key['book_id'] }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>

                                            <li class="dropdown pe-2 mx-2" style="list-style: none;">
                                                <a href="javascript:;" class="nav-link" data-id="{{ $key['book_id'] }}"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md"
                                                            href="{{ url('u/editor/b') . '/' . $key['book_id'] }}">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-regular fa-eye"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Open
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md forfeit"
                                                            href="javascript:0;" data-id="{{ $key['book_id'] }}">
                                                            <div class="d-flex align-items-center py-1 ">
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
                                                        <a class="dropdown-item border-radius-md complete"
                                                            href="javascript:0;" data-id="{{ $key['book_id'] }}">
                                                            <div class="d-flex align-items-center py-1 ">
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
                                                    <li class="mb-2">
                                                        <a class="dropdown-item border-radius-md delete"
                                                            href="javascript:0;" data-id="{{ $key['book_id'] }}">
                                                            <div class="d-flex align-items-center py-1">
                                                                <div class="my-auto">
                                                                    <span>
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <h6 class="text-sm font-weight-normal mb-0">
                                                                        Delete
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </div>
                                    <p class="text-sm">{{ $key['description'] ?? '-' }}</p>
                                    <p class="text-sm">
                                        @isset($key->team)
                                            <i class="fa-solid fa-people-group"></i> {{ $key->team ?? '' }}
                                        @endisset
                                    </p>
                                    {{-- <hr class="dark horizontal">
                                    <div class="d-flex ">
                                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                                        <p class="mb-0 text-sm"> updated 4 min ago </p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center mt-5 mb-5">
                        <h5 class="text-dark">No Closed Books, a good sight.</h5>
                    </div>
            @endif
        @endisset
        </div>
        </div>
    </main>


    {{-- OFFCANVAS --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="edit-book" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Edit Book
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <hr class="dark horizontal mt-0 mb-0">
        <form action="{{ url('team/create') }}" id="editBook" method="post">
            @csrf
            <div class="offcanvas-body mx-0 flex-grow-0">
                <input type="hidden" name="id" readonly id="edit_id">
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Book Name</label>
                    <input class="form-control" type="text" name="title" id="edit_book_name">
                </div>
                @error('team_name')
                    <div class="p-0 mt-0 mb-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
                @error('name-error')
                    <div class="p-0 mt-0 mb-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Book Description </label>
                    <input class="form-control" type="text" name="description" id="edit_book_description">
                </div>
                @error('name-error')
                    <div class="p-0 mt-0 mb-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
                @error('description')
                    <div class="p-0 mt-0 mb-2 text-sm text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit" class="btn btn-success d-grid mb-2 w-100">Update</button>
                <button type="button" class="btn btn-label-success border d-grid w-100"
                    data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
    @include('common.footer')
</body>

</html>
<script>
    $(document).ready(function() {

        $(document).on("click", ".edit", function() {
            console.log("triggered");
            let token = '@csrf';
            token = token.substr(42, 40);
            var thisID = $(this).attr('data-id');

            $.ajax({
                type: "POST",
                url: "{{ url('api/book/show') }}",
                dataType: "json",
                data: {
                    "_token": token,
                    "id": thisID,
                },
                cache: true,
                success: function(response) {
                    if (response.statusCode == 200) {
                        $('#edit_id').val(response.data.id);
                        $('#edit_book_name').val(response.data.title);
                        $('#edit_book_name').parent().addClass('focused is-focused');
                        $('#edit_book_description').val(response.data.description);
                        $('#edit_book_description').parent().addClass('focused is-focused');

                    } else if (response.statusCode == '401') {
                        error_toastr(response.msg);
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 1000);
                    } else {
                        error_toastr(response.msg);
                    }
                },
                error: function(err) {
                    response = JSON.parse(err.responseText);

                    if (response.statusCode == '401') {
                        error_toastr(response.msg);
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 1000);
                    } else {
                        toastr['error']('something went wrong please try again', '', {
                            timeOut: 2000
                        });
                    }
                }
            });
        });

        $(document).on("click", ".forfeit", function() {
            console.log("triggered");
            let token = '@csrf';
            token = token.substr(42, 40);
            var thisID = $(this).attr('data-id');

            $.ajax({
                type: "POST",
                url: "{{ url('api/book/forfeit') }}",
                dataType: "json",
                data: {
                    "_token": token,
                    "id": thisID,
                },
                cache: true,
                success: function(response) {
                    if (response.statusCode == 200) {
                        success_toastr('Book Updated.');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else if (response.statusCode == '401') {
                        error_toastr(response.msg);
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 1000);
                    } else {
                        error_toastr(response.msg);
                    }
                },
                error: function(err) {
                    response = JSON.parse(err.responseText);

                    if (response.statusCode == '401') {
                        error_toastr(response.msg);
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 1000);
                    } else {
                        toastr['error']('something went wrong please try again', '', {
                            timeOut: 2000
                        });
                    }
                }
            });
        });

        $(document).on("click", ".complete", function() {
            console.log("triggered");
            let token = '@csrf';
            token = token.substr(42, 40);
            var thisID = $(this).attr('data-id');

            $.ajax({
                type: "POST",
                url: "{{ url('api/book/complete') }}",
                dataType: "json",
                data: {
                    "_token": token,
                    "id": thisID,
                },
                cache: true,
                success: function(response) {
                    if (response.statusCode == 200) {
                        success_toastr('Book Updated.');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else if (response.statusCode == '401') {
                        error_toastr(response.msg);
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 1000);
                    } else {
                        error_toastr(response.msg);
                    }
                },
                error: function(err) {
                    response = JSON.parse(err.responseText);

                    if (response.statusCode == '401') {
                        error_toastr(response.msg);
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 1000);
                    } else {
                        toastr['error']('something went wrong please try again', '', {
                            timeOut: 2000
                        });
                    }
                }
            });
        });

        $(document).on("click", ".delete", function() {
            var thisID = $(this).attr('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete Book!',
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: `{{ url('u/b/delete') . '/' }}${thisID}`,
                        dataType: "json",
                        success: function(response) {

                            if (response.statusCode == '200') {
                                sweet_alert_confirm('Book has been deleted.',
                                    'Deleted!');
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else if (response.statusCode == '401') {
                                error_toaster(response.msg);
                                setTimeout(function() {
                                    window.location = response.redirect;
                                }, 1000);
                            } else {
                                error_toaster(response.msg);
                            }
                        },
                        error: function(err) {
                            response = JSON.parse(err.responseText);

                            if (response.statusCode == '401') {
                                error_toaster(response.msg);
                                setTimeout(function() {
                                    window.location = response.redirect;
                                }, 1000);
                            } else {
                                toastr['error'](
                                    'something went wrong please try again',
                                    '', {
                                        timeOut: 2000
                                    });
                            }
                        }
                    });
                }
            });
        });

        $("#editBook").submit(function(e) {
            e.preventDefault();

            $("#editBook").find("button:submit").prop("disabled", true);
            $.ajax({
                type: "POST",
                url: "{{ url('api/book/update') }}",
                dataType: "json",
                data: $('#editBook').serialize(),
                success: function(response) {

                    if (response.statusCode == '200') {
                        success_toastr('Book Updated.');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else if (response.statusCode == '401') {
                        error_toastr(response.msg);
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 1000);
                    } else {
                        error_toastr(response.msg);
                        $("#editBook").find("button:submit").prop("disabled", false);
                    }
                },
                error: function(err) {
                    response = JSON.parse(err.responseText);

                    if (response.statusCode == '401') {
                        error_toastr(response.msg);
                        setTimeout(function() {
                            window.location = response.redirect;
                        }, 1000);
                    } else {
                        toastr['error']('something went wrong please try again', '', {
                            timeOut: 2000
                        });
                        $("#editBook").find("button:submit").prop("disabled", false);
                    }
                }
            });
        });

    });
</script>
