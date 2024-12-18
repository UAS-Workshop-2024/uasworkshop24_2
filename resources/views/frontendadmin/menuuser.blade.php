@extends('frontendadmin.layouts.master')
@section('menu')
    @extends('frontendadmin.sidebar.dashboard')
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a
                                href="{{ route('admin.home') }}">Dashboard</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Menu User</h6>
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
                {{-- <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Add New Menu User
                </button> --}}
                <a href="#" class="btn btn-primary btn-sm me-3 createMenuUser">Add New Menu User</a>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Menu User</h6>
                        </div>
                        <!-- Button to trigger Create Modal -->
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="menuuserTable" class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2">
                                                Nomor Menu User
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Jenis User</th>
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Menu</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Modify</th>
                                        </tr>
                                    </thead>
                                    <tbody id="menuUserTableBody">
                                        <!-- Data akan dimuat di sini oleh jQuery -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit User -->
            <div class="modal fade" id="editMenuUserModal" tabindex="-1" aria-labelledby="editMenuUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMenuUserModalLabel">Edit Menu User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editMenuUserForm">
                                <input type="hidden" id="edit_no_setting">

                                <!-- jenis user -->
                                <div class="form-group">
                                    <label for="edit_jenis_user">Jenis User</label>
                                    <select class="form-control" id="edit_jenis_user">
                                        <!-- Data jenis user akan diisi secara dinamis -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="edit_menu">Menu</label>
                                    <select class="form-control" id="edit_menu">
                                        <!-- Data menu akan diisi secara dinamis -->
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Add User -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add New Menu User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createMenuUserForm">
                                @csrf
                                <div class="form-group">
                                    <label for="create_jenis_user">Jenis User</label>
                                    <select class="form-control" id="create_jenis_user" name="create_jenis_user">
                                        <!-- Data jenis user akan diisi secara dinamis -->
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="create_menu">Menu</label>
                                    <select class="form-control" id="create_menu" name="create_menu">
                                        <!-- Data jenis user akan diisi secara dinamis -->
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        id="closeModalButton">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    {{-- <button type="button" class="btn btn-secondary" id="closeModalButton">Close</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            loadMenuUser();

            $('body').on('click', '.createMenuUser', function(e) {
                e.preventDefault();
                loadJenisUser();
                loadMenu();
                $('#createModal').modal('show');
                console.log('berhasil menekan');
            });

            function loadJenisUser(callback) {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/ambilJenisUserDiMenuUser',
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            var jenisUser = response.data;
                            var select = $('#edit_jenis_user');
                            var select_create = $('#create_jenis_user');

                            // Kosongkan select terlebih dahulu
                            select.empty();
                            select_create.empty();

                            // Loop melalui data jenis user dan tambahkan opsi ke dropdown
                            $.each(jenisUser, function(index, jenisUser) {
                                select.append('<option value="' + jenisUser.id_jenis_user +
                                    '">' +
                                    jenisUser.jenis_user + '</option>');
                                select_create.append('<option value="' + jenisUser
                                    .id_jenis_user + '">' +
                                    jenisUser.jenis_user + '</option>');
                            });

                            if (callback) {
                                callback();
                            }
                        } else {
                            alert('Failed to fetch data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Something went wrong: ' + error);
                    }
                });
            }

            function loadMenu(callback) {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/ambilMenuUser',
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            var menus = response.data;
                            var select_edit = $('#edit_menu');
                            var select_create = $('#create_menu');

                            // Kosongkan select terlebih dahulu
                            select_edit.empty();
                            select_create.empty();

                            // Loop melalui data menu dan tambahkan opsi ke dropdown
                            $.each(menus, function(index, menu) {
                                select_edit.append('<option value="' + menu.menu_id + '">' +
                                    menu.menu_name + '</option>');
                                select_create.append('<option value="' + menu.menu_id + '">' +
                                    menu.menu_name + '</option>');
                            });

                            if (callback) {
                                callback(); // Panggil callback setelah selesai load data
                            }
                        } else {
                            alert('Failed to fetch menu data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Something went wrong: ' + error);
                    }
                });
            }


            function loadMenuUser() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/menuUser',
                    method: 'GET',
                    success: function(response) {
                        let rows = '';
                        $.each(response.data, function(index, menuUser) {
                            rows += `
                    <tr>
                        <td class="text-center"><h6 class="text-sm font-weight-bold mb-0">${menuUser.no_setting}</h6></td>
                        <td><p class="text-sm font-weight-bold mb-0">${menuUser.jenis_user.jenis_user}</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">${menuUser.menu.menu_name}</p></td>
                         <td class="align-middle">
                            <a href="#" class="editMenuUser" data-id="${menuUser.no_setting}"><i class="bi bi-pencil-square" style="color: #6c757d;"></i></a>
                            <a href="#" class="deleteMenuUser" data-id="${menuUser.no_setting}" data-toggle="tooltip" data-original-title="Delete Menu User"><i class="bi bi-trash" style="color: #6c757d;"></i></a>
                        </td>
                    </tr>
                `;
                        });
                        // Mengisi tabel dengan data yang telah dimuat
                        $('#menuUserTableBody').html(rows);

                        // Menghancurkan tabel yang ada jika sudah diinisialisasi sebelumnya
                        if ($.fn.DataTable.isDataTable('#menuuserTable')) {
                            $('#menuuserTable').DataTable().destroy();
                        }

                        // Membuat DataTable baru dengan data terbaru
                        $('#menuuserTable').DataTable({
                            "paging": true, // Mengaktifkan pagination
                            "searching": true, // Mengaktifkan pencarian
                            "ordering": true, // Mengaktifkan pengurutan
                            "pageLength": 10, // Jumlah baris per halaman
                            "lengthMenu": [5, 10, 25,
                                50] // Opsi jumlah baris yang dapat dipilih
                        });
                    },
                    error: function(xhr) {
                        alert('An error occurred while fetching menu user data: ' + xhr.responseText);
                    }
                });
            }

            // $(document).on('click', '.editMenuUser', function() {
            //     const id = $(this).data('id');
            //     editMenuUser(id);
            // });


            $(document).on('click', '.deleteMenuUser', function() {
                const id = $(this).data('id');
                deleteMenuUser(id);
            });

            function deleteMenuUser(id) {
                if (confirm('Are you sure you want to delete this menu user?')) {
                    $.ajax({
                        url: `http://127.0.0.1:8000/api/menuUser/${id}`,
                        method: 'DELETE',
                        success: function(response) {
                            alert('Menu User deleted successfully');
                            loadMenuUser();
                        },
                        error: function(xhr) {
                            alert('An error occurred: ' + xhr.responseText);
                        }
                    });
                }
            }

            $('#createMenuUserForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/menuUser',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Menu User added successfully');
                        $('#closeModalButton').click();
                        loadMenuUser();
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            });



            // Event handler for edit button click
            $('body').on('click', '.editMenuUser', function() {
                // Ambil ID dari elemen yang diklik
                const id = $(this).data('id');
                $.ajax({
                    url: `http://127.0.0.1:8000/api/menuUser/${id}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {

                            loadJenisUser(function() {
                                let menuUser = response.data;
                                $('#edit_jenis_user').val(menuUser.id_jenis_user)
                                    .change();
                            });

                            loadMenu(function() {
                                let menuUser = response.data;
                                $('#edit_menu').val(menuUser.menu_id).change();
                            });

                            let menuUser = response.data;
                            $('#edit_no_setting').val(menuUser.no_setting);
                            $('#edit_create_by').val(menuUser.create_by);

                            // Buka modal setelah semuanya selesai
                            $('#editMenuUserModal').modal('show');
                        } else {
                            alert('Gagal mengambil data menu user.');
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat mengambil data untuk edit: ' + xhr
                            .responseText);
                    }
                });

                // Saat form disubmit
                $('#editMenuUserForm').on('submit', function(e) {
                    e.preventDefault();

                    var id = $('#edit_no_setting').val();
                    var data = {
                        id_jenis_user: $('#edit_jenis_user').val(),
                        menu_id: $('#edit_menu').val(),
                        create_by: $('#edit_create_by').val(),
                    };


                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/menuUser/' + id,
                        type: 'PUT',
                        data: data,
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                $('#editMenuUserModal').modal('hide');
                                loadMenuUser();

                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {

                            alert('Error: ' + xhr.responseJSON.message);
                        }
                    });
                });

            });
        });
    </script>
@endsection
