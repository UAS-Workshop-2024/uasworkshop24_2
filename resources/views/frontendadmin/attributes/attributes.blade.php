@extends('frontendadmin.layouts.master')
@section('menu')
    @extends('frontendadmin.sidebar.dashboard')
@endsection

@section('content')
<!-- Main content -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

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
                <h6 class="font-weight-bolder mb-0">Menu Attributes</h6>
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
            <a href="{{ route('admin.attributes.create')}}" class="btn btn-primary btn-sm me-3">
                Add New Data Attributes
        </a>
        </div>
    </div>

<section class="content pt-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Attribute</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                  <table id="data-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>No</th>
                      <th>Code</th>
                      <th>Nama</th>
                      <th>Tipe</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @forelse($attributes as $attribute)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $attribute->code }}</td>
                              <td>{{ $attribute->name }}</td>
                              <td>
                                  <span>
                                      {{ $attribute->type }}
                                  </span>
                              </td>
                              <td>
                                <div class="btn-group btn-group-sm">
                                    <!-- Edit Icon -->
                                    <a href="{{ route('admin.attributes.edit', $attribute) }}" class="me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete Icon -->
                                    <form onsubmit="return confirm('Are you sure?')" action="{{ route('admin.attributes.destroy', $attribute) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent p-0">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="5" class="text-center">Data Kosong !</td>
                          </tr>
                      @endforelse
                  </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</main>
@endsection

@push('style-alt')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush

@push('script-alt')
  <script
      src="https://code.jquery.com/jquery-3.6.3.min.js"
      integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
      crossorigin="anonymous"
  >
  </script>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script>
  $("#data-table").DataTable();
  </script>
@endpush
