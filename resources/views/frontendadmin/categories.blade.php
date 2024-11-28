@extends('frontendadmin.layouts.master')
@section('menu')
    @extends('frontendadmin.sidebar.dashboard')
@endsection

@section('content')
    <!-- Main content -->
    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kategori</h3>
                            <a href="#" class="btn btn-success shadow-sm float-right" data-bs-toggle="modal" data-bs-target="#createModal">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Nama Kategori Utama</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <span class="badge badge-info">
                                                        {{ $category->parent->name ?? '✔' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#" class="btn btn-sm btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal-{{ $category->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form onclick="return confirm('are you sure !')"
                                                            action="{{ route('admin.categories.destroy', $category) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger" type="submit"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Data Kosong !</td>
                                            </tr>
                                        @endforelse
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- Modal Edit Kategori -->
                    @foreach ($categories as $category)
                        <div class="modal fade" id="editModal-{{ $category->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel-{{ $category->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $category->id }}">Edit Kategori</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="{{ route('admin.categories.update', $category) }}">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <!-- Nama Kategori -->
                                            <div class="form-group mb-3">
                                                <label for="name-{{ $category->id }}" class="form-label">Nama
                                                    Kategori</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="name-{{ $category->id }}"
                                                    value="{{ old('name', $category->name) }}" required>
                                            </div>

                                            <!-- Kategori Utama -->
                                            <div class="form-group mb-3">
                                                <label for="parent_id-{{ $category->id }}" class="form-label">Kategori
                                                    Utama</label>
                                                <select class="form-control" name="parent_id"
                                                    id="parent_id-{{ $category->id }}">
                                                    <option value="">Atur sebagai Kategori Utama</option>
                                                    @foreach ($main_categories as $main_category)
                                                        <option value="{{ $main_category->id }}"
                                                            {{ old('parent_id', $category->parent_id) == $main_category->id ? 'selected' : null }}>
                                                            {{ $main_category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal Create Kategori -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Buat Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="modal-body">
                        <!-- Nama Kategori -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ old('name') }}" required>
                        </div>

                        <!-- Kategori Utama -->
                        <div class="form-group mb-3">
                            <label for="parent_id" class="form-label">Kategori Utama</label>
                            <select class="form-control" name="parent_id" id="parent_id">
                                <option value="">Atur sebagai Kategori Utama</option>
                                @foreach ($main_categories as $main_category)
                                    <option value="{{ $main_category->id }}"
                                        {{ old('parent_id') == $main_category->id ? 'selected' : null }}>
                                        {{ $main_category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style-alt')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@push('script-alt')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $("#data-table").DataTable();
    </script>
@endpush
