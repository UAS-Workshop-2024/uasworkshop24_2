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
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a
                                href="{{ route('admin.home') }}">Dashboard</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Menu</h6>
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
                <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Add New Menu
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
                                <table id="menuTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2">
                                                Nomor Menu
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nama Menu</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Menu Link</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Menu icon</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Modify</th>
                                        </tr>
                                    <tbody id="menuTableBody">
                                        <!-- Data akan dimuat di sini oleh jQuery -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editMenuForm">
                                <input type="hidden" id="edit_menu_id">

                                <div class="form-group">
                                    <label for="edit_menu_name">Nama Menu</label>
                                    <input type="text" class="form-control" id="edit_menu_name" name="menu_name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_menu_link">Menu Link</label>
                                    <input type="text" class="form-control" id="edit_menu_link" name="menu_link"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_menu_icon">Menu Icon</label>
                                    <input type="text" class="form-control" id="edit_menu_icon" name="menu_icon"
                                        required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Menu -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add New Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createMenuForm">
                                @csrf
                                <div class="form-group">
                                    <label for="menu_id">No Menu</label>
                                    <input type="text" class="form-control" id="menu_id" name="menu_id" required>
                                </div>

                                <div class="form-group">
                                    <label for="menu_name">Nama Menu</label>
                                    <input type="text" class="form-control" id="menu_name" name="menu_name"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="menu_link">Menu Link</label>
                                    <input type="text" class="form-control" id="menu_link" name="menu_link"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="menu_icon">Menu Icon</label>
                                    <input type="text" class="form-control" id="menu_icon" name="menu_icon"
                                        required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        id="closeModalButton">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
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

            // Load menu untuk tabel
            function loadMenu() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/menu',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            let menu = response.data;
                            let tableBody = $('#menuTableBody');
                            tableBody.empty();

                            $.each(menu, function(index, item) {
                                console.log(item);
                                let row = `
                                <tr>
                                    <td><p class="text-sm font-weight-bold mb-0">${item.menu_id}</p></td>
                                    <td><p class="text-sm font-weight-bold mb-0">${item.menu_name}</p></td>
                                    <td><p class="text-sm font-weight-bold mb-0">${item.menu_link}</p></td>
                                    <td><p class="text-sm font-weight-bold mb-0">${item.menu_icon}</p></td>
                                        <td>
                                            <a href="#" class="editMenu" data-id="${item.menu_id}"><i class="bi bi-pencil-square" style="color: #6c757d;"></i></a>
                                            <a href="#" class="deleteMenu" data-id="${item.menu_id}" data-toggle="tooltip" data-original-title="Delete Menu"><i class="bi bi-trash" style="color: #6c757d;"></i></a>
                                        </td>
                                </tr>
                            `;
                                tableBody.append(row);
                            });

                            if ($.fn.DataTable.isDataTable('#menuTable')) {
                                $('#menuTable').DataTable().destroy();
                            }

                            $('#menuTable').DataTable({
                                "paging": true,
                                "searching": true,
                                "ordering": true,
                                "pageLength": 10,
                                "lengthMenu": [5, 10, 25, 50]
                            });

                        } else {
                            alert('Failed to retrieve data.');
                        }
                    },
                    error: function() {
                        alert('Failed to retrieve data.');
                    }
                });
            }

            loadMenu();

            // Tambah menu
            $('#createMenuForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/menu',
                    method: 'POST',
                    data: $(this).serialize(), // Pastikan semua field yang diperlukan terisi
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Menu successfully added.');
                            $('#closeModalButton').click();
                            loadMenu();
                        } else {
                            alert('Failed to add menu.');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseJSON.message);
                    }
                });
            });


            $(document).on('click', '.editMenu', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/menu/' + id,
                    method: 'GET',
                    success: function(response) {
                        console.log(response); // Tambahkan log ini
                        $('#edit_menu_id').val(response.data.menu_id);
                        $('#edit_id_level').val(response.data.id_level);
                        $('#edit_menu_name').val(response.data.menu_name);
                        $('#edit_menu_link').val(response.data.menu_link);
                        $('#edit_menu_icon').val(response.data.menu_icon);
                        $('#edit_create_by').val(response.data.create_by);
                        $('#editMenuModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Error fetching menu data: ' + xhr.responseJSON.message);
                    }
                });
            });


            $('#editMenuForm').submit(function(e) {
                e.preventDefault();
                var id = $('#edit_menu_id').val();
                console.log($(this).serialize());
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/menu/' + id,
                    method: 'PUT',
                    data: {
                        menu_id: $('#edit_menu_id').val(),
                        id_level: $('#edit_id_level').val(),
                        menu_name: $('#edit_menu_name').val(),
                        menu_link: $('#edit_menu_link').val(),
                        menu_icon: $('#edit_menu_icon').val(),
                        create_by: $('#edit_create_by').val()
                    },
                    success: function(response) {
                        $('#editMenuModal').modal('hide');
                        loadMenu();
                        alert('Menu updated successfully.');
                    },
                    error: function(xhr) {
                        alert('Error updating menu: ' + xhr.responseJSON.message);
                    }
                });
            });


            // Hapus menu
            $(document).on('click', '.deleteMenu', function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this menu?')) {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/menu/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            loadMenu();
                            alert('Menu deleted successfully.');
                        },
                        error: function(xhr) {
                            alert('Error deleting menu: ' + xhr.responseJSON.message);
                        }
                    });
                }
            });
        });
    </script>
@endsection
