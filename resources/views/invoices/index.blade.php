@extends('layouts.master')

@section('title', 'قائمة الفواتير')

@section('css')
	<!-- Internal Data table css -->
	<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
	<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
	<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex">
				<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
					قائمة الفواتير</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection



@section('content')
	<!-- row opened -->
	<div class="row row-sm">

		<!--div-->
		<div class="col-xl-12">
			<div class="card mg-b-20">
				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0">عرض وإدارة الفواتير</h4>
					</div>
					<div class="col-sm-4 col-md-1">
						<div class="d-flex justify-content-between mt-3">
							<a class="modal-effect btn btn-outline-primary btn-block font-weight-bold fas fa-plus"
								data-effect="effect-scale" href="{{ route('invoices.create') }}">إضافة
								فاتورة</a>
						</div>
					</div>

				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table key-buttons text-nowrap w-100 text-center">
							<thead>

								<tr>
									<th class="border-bottom-0">#</th>
									<th class="border-bottom-0">رقم الفاتورة</th>
									<th class="border-bottom-0">تاريخ الفاتورة</th>
									<th class="border-bottom-0">تاريخ الاستحقاق</th>
									<th class="border-bottom-0">المنتج</th>
									<th class="border-bottom-0">القسم</th>
									<th class="border-bottom-0">نسبة العمولة </th>
									<th class="border-bottom-0">ضريبة القيمة المضافة</th>
									<th class="border-bottom-0">قيمة الضريبة</th>
									<th class="border-bottom-0"> المدفوع</th>
									<th class="border-bottom-0">إجمالي مبلغ العمولة</th>
									<th class="border-bottom-0">ملاحظات</th>
								</tr>


							</thead>
							<tbody>

								@forelse ($invoices as $invoice)
									<tr>
										<td>{{ $loop->iteration }}</td>

										<td>{{ $invoice->invoice_number }}</td>

										<td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d-m-Y') }}</td>

										<td>{{ \Carbon\Carbon::parse($invoice->due_date)->format('d-m-Y') }}</td>

										<td>{{ $invoice->product->product_name }}</td>

										<td>{{ $invoice->section->section_name }}</td>

										<td>{{ $invoice->commission_rate }}%</td>

										<td>{{ $invoice->rate_vat }}%</td>

										<td>{{ $invoice->value_vat }}</td>

										<td>{{ $invoice->amount_collection }}</td>

										<td>{{ $invoice->amount_commission }}</td>

										<td>{{ $invoice->note ?? 'لا توجد ملاحظات' }}</td>
									</tr>
								@empty
									<tr>
										<td colspan="12" class="text-center">
											لا توجد فواتير مسجلة
										</td>
									</tr>
								@endforelse

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--/div-->

	</div>
	<!-- main-content closed -->
@endsection


@section('js')
	<!-- Internal Data tables -->
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
	<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
	{{--
	<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script> --}}
	<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
	<!--Internal  Datatable js -->
	<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection