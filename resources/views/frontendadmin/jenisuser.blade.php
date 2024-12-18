@extends('frontendadmin.layouts.master')
@section('menu')
    @extends('frontendadmin.sidebar.dashboard')
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Jenis User</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="d-flex justify-content-end mb-3 mt-3">
                <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#createModal">
                    Add New Jenis User
                </button>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Menu</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="Menutable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2">
                                                Nomor
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Jenis Level
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Modify
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jenis_users as $item)
                                            <tr>
                                                <td class="text-center">
                                                    <h6 class="text-sm font-weight-bold mb-0">{{ $item->id_jenis_user }}</h6>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0">{{ $item->jenis_user }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->id_jenis_user }}">
                                                        <i class="bi bi-pencil-square" style="color: #6c757d;"></i>
                                                    </a>
                                                    <a href="{{ route('admin.jenisUser.destroy', $item->id_jenis_user) }}"
                                                       onclick="return confirm('Are you sure you want to delete it?')">
                                                        <i class="bi bi-trash" style="color: #6c757d;"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal-{{ $item->id_jenis_user }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $item->id_jenis_user }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel-{{ $item->id_jenis_user }}">Edit Menu</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('admin.jenisUser.update', $item->id_jenis_user) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="edit_jenis_user{{ $item->id_jenis_user }}" class="form-label">Jenis User</label>
                                                                    <input type="text" class="form-control" id="edit_jenis_user{{ $item->id_jenis_user }}" name="jenis_user" value="{{ $item->jenis_user }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modal Add -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add New Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.jenisUser.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="create_jenis_user" class="form-label">Jenis User</label>
                                <input type="text" class="form-control" id="create_jenis_user" name="jenis_user">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#Menutable').DataTable({
                    "paging": true,       // Menampilkan pagination
                    "searching": true,    // Menampilkan kotak pencarian
                    "ordering": true,     // Mengaktifkan pengurutan kolom
                    "info": true,         // Menampilkan informasi jumlah data
                    "dom": 'Bfrtip',      // Menambahkan dom untuk buttons
                    "buttons": [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>


        {{-- <script>
            $(document).ready(function () {
                loadJenisUsers();

                // Event handler untuk tombol Add New Jenis User
                $('body').on('click', '.createJenisUser', function (e) {
                    e.preventDefault();
                    $('#createModal').modal('show');
                });

                // Fungsi untuk memuat data Jenis User
                function loadJenisUsers() {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/jenisUser',
                        method: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            let rows = '';
                            $.each(response.data, function (index, jenisUser) {
                                rows += `
                                    <tr>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-bold mb-0">${jenisUser.id_jenis_user}</h6>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">${jenisUser.jenis_user}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">${jenisUser.create_by}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="editJenisUser" data-id="${jenisUser.id_jenis_user}" data-bs-toggle="modal" data-bs-target="#editModal-${jenisUser.id_jenis_user}">
                                                <i class="bi bi-pencil-square" style="color: #6c757d;"></i>
                                            </a>
                                            <a href="{{ route('jenisUser.destroy', '') }}/${jenisUser.id_jenis_user}" class="deleteJenisUser" onclick="return confirm('Are you sure you want to delete it?')">
                                                <i class="bi bi-trash" style="color: #6c757d;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                `;
                            });

                            // Masukkan data ke dalam tabel
                            $('table tbody').html(rows);
                        },
                        error: function (xhr) {
                            alert('An error occurred while fetching jenis user data: ' + xhr.responseText);
                        }
                    });
                }

                // Form submission untuk menambah Jenis User
                $('#createJenisUserForm').submit(function (e) {
                    e.preventDefault();

                    $.ajax({
                        url: '{{ route('jenisUser.store') }}',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function (response) {
                            alert('Jenis User added successfully');
                            $('#createModal').modal('hide');
                            loadJenisUsers();
                        },
                        error: function (xhr) {
                            alert('An error occurred: ' + xhr.responseText);
                        }
                    });
                });

                // Event handler untuk edit Jenis User
                $('body').on('click', '.editJenisUser', function () {
                    const id = $(this).data('id');
                    $.ajax({
                        url: `{{ route('jenisUser.show', '') }}/${id}`,
                        method: 'GET',
                        success: function (response) {
                            if (response.status === 'success') {
                                $('#edit_jenis_user').val(response.data.jenis_user);
                                $('#edit_create_by').val(response.data.create_by);
                                $('#editJenisUserForm').attr('action', `{{ route('jenisUser.update', '') }}/${id}`);
                            } else {
                                alert('Failed to fetch data.');
                            }
                        },
                        error: function (xhr) {
                            alert('An error occurred: ' + xhr.responseText);
                        }
                    });
                });

                // Form submission untuk mengedit Jenis User
                $('#editJenisUserForm').submit(function (e) {
                    e.preventDefault();

                    const id = $('#editJenisUserForm').attr('action').split('/').pop();
                    const data = {
                        _method: 'PUT',
                        jenis_user: $('#edit_jenis_user').val(),
                        create_by: $('#edit_create_by').val(),
                    };

                    $.ajax({
                        url: `{{ route('jenisUser.update', '') }}/${id}`,
                        method: 'POST',
                        data: data,
                        success: function (response) {
                            alert('Jenis User updated successfully');
                            $('#editModal').modal('hide');
                            loadJenisUsers();
                        },
                        error: function (xhr) {
                            alert('An error occurred: ' + xhr.responseText);
                        }
                    });
                });

                // Hapus Jenis User
                $('body').on('click', '.deleteJenisUser', function (e) {
                    e.preventDefault();

                    if (confirm('Are you sure you want to delete this?')) {
                        const url = $(this).attr('href');
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function (response) {
                                alert('Jenis User deleted successfully');
                                loadJenisUsers();
                            },
                            error: function (xhr) {
                                alert('An error occurred: ' + xhr.responseText);
                            }
                        });
                    }
                });
            });
        </script> --}}

@endsection
