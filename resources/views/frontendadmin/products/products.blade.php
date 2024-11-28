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
                <h3 class="card-title">Data Produk</h3>
                <button type="button" class="btn btn-success shadow-sm float-right" data-toggle="modal" data-target="#createProductModal">
                    <i class="fa fa-plus"></i> Tambah
                  </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>SKU</th>
                        <th>Tipe</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->type }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ number_format($product->price) }}</td>
                                <td>{{ $product->statusLabel() }}</td>
                                <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editProductModal" onclick="populateModal('{{ $product->id }}')">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <form onclick="return confirm('are you sure !')" action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data Kosong !</td>
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

    <!-- Modal Create Product -->
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="POST" action="{{ route('admin.products.store') }}">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="createProductModalLabel">Buat Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="type" class="col-sm-2 col-form-label">Tipe Kategori</label>
              <div class="col-sm-10">
                <select class="form-control product-type" name="type" id="type">
                  @foreach($types as $value => $type)
                  <option {{ old('type') == $value ? 'selected' : null }} value="{{ $value }}"> {{ $type }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="sku" class="col-sm-2 col-form-label">SKU</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="sku" value="{{ old('sku') }}" id="sku">
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name">
              </div>
            </div>
            <div class="form-group row">
              <label for="category_id" class="col-sm-2 col-form-label">Kategori Produk</label>
              <div class="col-sm-10">
                <select class="form-control select-multiple" multiple="multiple" name="category_id[]" id="category_id">
                  @foreach($categories as $category)
                  <option {{ old('category_id') == $category->id ? 'selected' : null }} value="{{ $category->id }}"> {{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="configurable-attributes">
              @if(count($configurable_attributes) > 0)
              <p class="text-primary mt-4">Konfigurasi Attribute Produk</p>
              <hr />
              @foreach($configurable_attributes as $configurable_attribute)
              <div class="form-group row">
                <label for="{{ $configurable_attribute->code }}" class="col-sm-2 col-form-label">{{ $configurable_attribute->code }}</label>
                <div class="col-sm-10">
                  <select class="form-control select-multiple" multiple="multiple" name="{{ $configurable_attribute->code }}[]" id="{{ $configurable_attribute->code }}">
                    @foreach($configurable_attribute->attribute_options as $attribute_option)
                    <option value="{{ $attribute_option->id }}"> {{ $attribute_option->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              @endforeach
              @endif
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edit Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="POST" action="{{ route('admin.products.update', $product) }}">
          @csrf
          @method('put')

          <div class="modal-header">
            <h5 class="modal-title" id="editProductModalLabel">Edit Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="type" class="col-sm-2 col-form-label">Tipe Kategori</label>
              <div class="col-sm-10">
                <select class="form-control" name="type" id="type">
                  @foreach($types as $value => $type)
                  <option {{ old('type', $product->type) == $value ? 'selected' : null }} value="{{ $value }}"> {{ $type }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="sku" class="col-sm-2 col-form-label">SKU</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="sku" value="{{ old('sku', $product->sku) }}" id="sku">
              </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Nama Produk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}" id="name">
              </div>
            </div>
            <div class="form-group row">
              <label for="category_id" class="col-sm-2 col-form-label">Kategori Produk</label>
              <div class="col-sm-10">
                <select class="form-control select-multiple" multiple="multiple" name="category_id[]" id="category_id">
                  @foreach($categories as $category)
                  <option {{ in_array($category->id, $product->categories->pluck('id')->toArray()) ? 'selected' : null }} value="{{ $category->id }}"> {{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            @if(!empty($configurable_attributes))
            <p class="text-primary mt-4">Konfigurasi Attribute Produk</p>
            <hr />
            @foreach($configurable_attributes as $configurable_attribute)
            <div class="form-group row">
              <label for="{{ $configurable_attribute->code }}" class="col-sm-2 col-form-label">{{ $configurable_attribute->code }}</label>
              <div class="col-sm-10">
                <select class="form-control select-multiple" multiple="multiple" name="{{ $configurable_attribute->code }}[]" id="{{ $configurable_attribute->code }}">
                  @foreach($configurable_attribute->attribute_options as $attribute_option)
                  <option value="{{ $attribute_option->id }}" {{ in_array($attribute_option->id, old($configurable_attribute->code, [])) ? 'selected' : '' }}>
                    {{ $attribute_option->name }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
            @endforeach
            @endif

            <div class="form-group row">
              <label for="short_description" class="col-sm-2 col-form-label">Deskripsi Singkat</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="short_description" id="short_description" cols="30" rows="5">{{ old('short_description', $product->short_description) }}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-sm-2 col-form-label">Deskripsi Produk</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ old('description', $product->description) }}</textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status" id="status">
                  @foreach($statuses as $value => $status)
                  <option {{ old('status', $product->status) == $value ? 'selected' : null }} value="{{ $value }}"> {{ $status }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Simpan</button>
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
