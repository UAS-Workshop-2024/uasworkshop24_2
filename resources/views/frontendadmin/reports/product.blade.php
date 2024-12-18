@extends('frontendadmin.layouts.master')
@section('menu')
    @extends('frontendadmin.sidebar.dashboard')
@endsection

@section('content')
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
               <h6 class="font-weight-bolder mb-0">Product Report</h6>
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

	<div class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-default">
					<div class="card-header card-header-border-bottom">
						<h2>Product Report</h2>
					</div>
					<div class="card-body">
						@include('frontendadmin.reports.filter')
						<table id="data-table" class="table table-bordered table-striped">
							<thead>
								<th>Name</th>
								<th>SKU</th>
								<th>Items Sold</th>
								<th>Net Revenue</th>
								<th>Orders</th>
								<th>Stock</th>
							</thead>
							<tbody>
								@php
									$totalNetRevenue = 0;
								@endphp
								@forelse ($products as $product)
									<tr>
										<td>{{ $product->name }}</td>
										<td>{{ $product->sku }}</td>
										<td>{{ $product->items_sold }}</td>
										<td>Rp{{ number_format($product->net_revenue, 0, ",", ".") }}</td>
										<td>{{ $product->num_of_orders }}</td>
										<td>{{ $product->stock }}</td>
									</tr>

									@php
										$totalNetRevenue += $product->net_revenue;
									@endphp
								@empty
									<tr>
										<td colspan="6">No records found</td>
									</tr>
								@endforelse

								@if ($products)
									<tr>
										<td class="d-none">z &nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>Rp{{ number_format($totalNetRevenue, 0, ",", ".") }}</td>
										<td>&nbsp;</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection

@push('style-alt')
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#data-table").DataTable();
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd'
		});
	</script>
@endpush
