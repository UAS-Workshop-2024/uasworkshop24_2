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
                <h3 class="card-title">Data Slide</h3>
                <button type="button" class="btn btn-success shadow-sm float-right" data-bs-toggle="modal" data-bs-target="#createModal"> <i class="fa fa-plus"></i> Tambah </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($slides as $slide)
                            <tr>
                                <td>{{ $slide->id }}</td>
                                <td>{{ $slide->title }}</td>
                                <td><img width="200" src="{{ Storage::url($slide->path) }}" /></td>
                                <td>
                                    @if ($slide->prevSlide())
                                        <a href="{{ url('admin/slides/'. $slide->id .'/up') }}">up</a>
                                    @else
                                        up
                                    @endif
                                        |
                                    @if ($slide->nextSlide())
                                        <a href="{{ url('admin/slides/'. $slide->id .'/down') }}">down</a>
                                    @else
                                        down
                                    @endif
                                </td>
                                <td>{{ $slide->status }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                      <!-- Modal Edit Button -->
                                      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $slide->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                        <form onclick="return confirm('are you sure !')" action="{{ route('admin.slides.destroy', $slide) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                              <!-- Modal Edit Slide -->
                              <div class="modal fade" id="editModal{{ $slide->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $slide->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $slide->id }}">Edit Slide</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post" action="{{ route('admin.slides.update', $slide) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="title{{ $slide->id }}" class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title{{ $slide->id }}" value="{{ old('title', $slide->title) }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="url{{ $slide->id }}" class="form-label">Url</label>
                                                    <input type="text" class="form-control" name="url" id="url{{ $slide->id }}" value="{{ old('url', $slide->url) }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="path{{ $slide->id }}" class="form-label">Gambar</label>
                                                    <input type="file" class="form-control" name="path" id="path{{ $slide->id }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="body{{ $slide->id }}" class="form-label">Body</label>
                                                    <textarea class="form-control" name="body" id="body{{ $slide->id }}" cols="30" rows="8">{{ old('body', $slide->body) }}</textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="status{{ $slide->id }}" class="form-label">Status</label>
                                                    <select class="form-control" name="status" id="status{{ $slide->id }}">
                                                        @foreach($statuses as $value => $status)
                                                            <option {{ old('status', $slide->status) == $value ? 'selected' : null }} value="{{ $value }}"> {{ $status }}</option>
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

                        @empty
                            <tr>
                                <td colspan="6">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
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

       <!-- Modal Create Slide -->
       <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.slides.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="url" class="form-label">Url</label>
                            <input type="text" class="form-control" name="url" value="{{ old('url') }}" id="url" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="path" class="form-label">Gambar</label>
                            <input type="file" class="form-control" name="path" id="path" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="8" required>{{ old('body') }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                @foreach($statuses as $value => $status)
                                    <option {{ old('status') == $value ? 'selected' : null }} value="{{ $value }}"> {{ $status }}</option>
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
