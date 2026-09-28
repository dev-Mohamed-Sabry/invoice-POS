@extends('layouts.master')

@section('title', 'قائمة العملاء')

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
				<h4 class="content-title mb-0 my-auto">العملاء</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
					قائمة العملاء</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->
@endsection



@section('content')

	{{-- Success Session --}}
	@if (session('success'))
		<div class="alert alert-success alert-dismissible fade show h5 w-25" role="alert">
			{{ session('success') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	{{-- Error Session --}}
	@if (session('error'))
		<div class="alert alert-danger alert-dismissible fade show h5 w-25" role="alert">
			{{ session('error') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif

	{{-- Validation Errors --}}
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible fade show h5 w-25" role="alert">
			{{ $errors->first() }}

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endif


	<!-- row opened -->
	<div class="row row-sm">

		<!--div-->
		<div class="col-xl-12">
			<div class="card mg-b-20">
				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0">عرض وإدارة العملاء</h4>
					</div>

					<div class="col-sm-4 col-md-2">
						<div class="d-flex justify-content-between mt-3">
							<a class="btn btn-outline-primary btn-block font-weight-bold fas fa-plus"
								href="{{ route('customers.create') }}">
								إضافة عميل
							</a>
						</div>
					</div>

				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table id="example" class="table key-buttons text-nowrap w-100 text-center">
							<thead>
								<tr>
									<th>#</th>
									<th>اسم العميل</th>
									<th>رقم الهاتف</th>
									<th>رقم إضافي</th>
									<th>الرقم القومي</th>
									<th>العنوان</th>
									<th>الحالة</th>
									<th>أضيف بواسطة</th>
									<th>ملاحظات</th>
									<th>العمليات</th>
								</tr>
							</thead>

							<tbody>

								@forelse ($customers as $customer)
									<tr>

										<td>{{ $loop->iteration }}</td>

										<td>{{ $customer->name }}</td>

										<td>{{ $customer->phone }}</td>

										<td>{{ $customer->secondary_phone ?? '-' }}</td>

										<td>{{ $customer->national_id }}</td>

										<td>{{ Str::limit($customer->address, 30) }}</td>

										<td>
											@if ($customer->is_active)
												<span class="badge badge-success">نشط</span>
											@else
												<span class="badge badge-danger">غير نشط</span>
											@endif
										</td>

										<td>{{ $customer->created_by }}</td>

										<td>{{ $customer->notes ?? 'لا توجد ملاحظات' }}</td>

										<td>
											{{-- عرض --}}
											<a href="{{ route('customers.show', $customer->id) }}" class="btn btn-sm btn-info"
												title="عرض بيانات العميل">
												<i class="fas fa-eye"></i>
											</a>

											{{-- تعديل --}}
											<a href="{{ route('customers.edit', $customer->id) }}"
												class="btn btn-sm btn-primary" title="تعديل العميل">
												<i class="fas fa-edit"></i>
											</a>

											{{-- حذف --}}
											@if (auth()->user()->usertype === 'admin')
												<form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
													class="d-inline">
													@csrf
													@method('DELETE')

													<button type="submit" class="btn btn-sm btn-danger" title="حذف العميل"
														onclick="return confirm('هل أنت متأكد من حذف العميل؟')">
														<i class="fas fa-trash"></i>
													</button>
												</form>
											@endif
										</td>

									</tr>
								@empty
									<tr>
										<td colspan="10" class="text-center">
											لا يوجد عملاء مسجلون
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