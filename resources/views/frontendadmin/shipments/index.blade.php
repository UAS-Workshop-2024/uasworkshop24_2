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
                <h6 class="font-weight-bolder mb-0">Data Shipments</h6>
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

 <section class="content pt-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Shipments</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
              <table id="data-table" class="table table-bordered table-striped">
                          <thead>
                              <th>Order ID</th>
                              <th>Name</th>
                              <th>Status</th>
                              <th>Total Qty</th>
                              <th>Total Weight (gram)</th>
                              <th>Action</th>
                          </thead>
                          <tbody>
                              @forelse ($shipments as $shipment)
                                  <tr>
                                      <td>
                                          {{ $shipment->order->code }}<br>
                                          <span style="font-size: 12px; font-weight: normal"> {{ $shipment->order->order_date }}</span>
                                      </td>
                                      <td>{{ $shipment->order->customer_full_name }}</td>
                                      <td>
                                          {{ $shipment->status }}
                                          <br>
                                          <span style="font-size: 12px; font-weight: normal"> {{ $shipment->shipped_at }}</span>
                                      </td>
                                      <td>{{ $shipment->total_qty }}</td>
                                      <td>{{ $shipment->total_weight }}</td>
                                      <td>
                                          <a href="{{ url('admin/orders/'.$shipment->order->id) }}" class="btn btn-info btn-sm">show</a>
                                      </td>
                                  </tr>
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
