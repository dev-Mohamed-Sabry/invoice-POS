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
		<!-- row opened -->
	{{-- Customer Information --}}
	<div class="row">

		{{-- Basic Information --}}
		<div class="col-lg-12 col-md-12">
			<div class="card">

				<div class="card-header">
					<h4 class="card-title mb-0">البيانات الأساسية</h4>
				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">اسم العميل</label>
							<div class="form-control bg-light">
								{{ $customer->name }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">رقم الهاتف</label>
							<div class="form-control bg-light">
								{{ $customer->phone }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">رقم هاتف إضافي</label>
							<div class="form-control bg-light">
								{{ $customer->secondary_phone ?? 'غير مسجل' }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">الرقم القومي</label>
							<div class="form-control bg-light">
								{{ $customer->national_id }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">تاريخ الميلاد</label>
							<div class="form-control bg-light">
								{{ $customer->date_of_birth?->format('Y-m-d') ?? 'غير مسجل' }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">حالة العميل</label>
							<div class="form-control bg-light">
								@if ($customer->is_active)
									<span class="text-success font-weight-bold">نشط</span>
								@else
									<span class="text-danger font-weight-bold">غير نشط</span>
								@endif
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>


		{{-- National ID --}}
		<div class="col-lg-12 col-md-12">
			<div class="card">

				<div class="card-header">
					<h4 class="card-title mb-0">بيانات الهوية</h4>
				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-6 text-center mb-4">

							<label class="font-weight-bold d-block mb-3">
								صورة وجه البطاقة
							</label>

							@if ($customer->national_id_front)
								<a href="{{ asset('storage/' . $customer->national_id_front) }}"
									target="_blank">
									<img src="{{ asset('storage/' . $customer->national_id_front) }}"
										class="img-fluid rounded border"
										style="max-height: 300px;"
										alt="صورة وجه البطاقة">
								</a>
							@else
								<div class="text-muted">
									لا توجد صورة
								</div>
							@endif

						</div>

						<div class="col-md-6 text-center mb-4">

							<label class="font-weight-bold d-block mb-3">
								صورة ظهر البطاقة
							</label>

							@if ($customer->national_id_back)
								<a href="{{ asset('storage/' . $customer->national_id_back) }}"
									target="_blank">
									<img src="{{ asset('storage/' . $customer->national_id_back) }}"
										class="img-fluid rounded border"
										style="max-height: 300px;"
										alt="صورة ظهر البطاقة">
								</a>
							@else
								<div class="text-muted">
									لا توجد صورة
								</div>
							@endif

						</div>

					</div>

				</div>
			</div>
		</div>


		{{-- Work Information --}}
		<div class="col-lg-12 col-md-12">
			<div class="card">

				<div class="card-header">
					<h4 class="card-title mb-0">بيانات العمل والعنوان</h4>
				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">المهنة</label>
							<div class="form-control bg-light">
								{{ $customer->job ?? 'غير مسجل' }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">جهة العمل</label>
							<div class="form-control bg-light">
								{{ $customer->workplace ?? 'غير مسجل' }}
							</div>
						</div>

						<div class="col-md-12 mb-3">
							<label class="font-weight-bold">العنوان</label>
							<div class="form-control bg-light" style="height: auto; min-height: 80px;">
								{{ $customer->address }}
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>


		{{-- Emergency Contact --}}
		<div class="col-lg-12 col-md-12">
			<div class="card">

				<div class="card-header">
					<h4 class="card-title mb-0">بيانات الطوارئ</h4>
				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">اسم شخص الطوارئ</label>
							<div class="form-control bg-light">
								{{ $customer->emergency_contact_name ?? 'غير مسجل' }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">هاتف شخص الطوارئ</label>
							<div class="form-control bg-light">
								{{ $customer->emergency_contact_phone ?? 'غير مسجل' }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">صلة القرابة</label>
							<div class="form-control bg-light">
								{{ $customer->emergency_contact_relation ?? 'غير مسجل' }}
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>


		{{-- Additional Information --}}
		<div class="col-lg-12 col-md-12">
			<div class="card">

				<div class="card-header">
					<h4 class="card-title mb-0">بيانات إضافية</h4>
				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-6 mb-3">
							<label class="font-weight-bold">بيانات إضافية</label>
							<div class="form-control bg-light"
								style="height: auto; min-height: 100px;">
								{{ $customer->additional_data ?? 'لا توجد بيانات إضافية' }}
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<label class="font-weight-bold">ملاحظات</label>
							<div class="form-control bg-light"
								style="height: auto; min-height: 100px;">
								{{ $customer->notes ?? 'لا توجد ملاحظات' }}
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>


		{{-- System Information --}}
		<div class="col-lg-12 col-md-12">
			<div class="card">

				<div class="card-header">
					<h4 class="card-title mb-0">بيانات النظام</h4>
				</div>

				<div class="card-body">

					<div class="row">

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">أضيف بواسطة</label>
							<div class="form-control bg-light">
								{{ $customer->created_by }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">تاريخ الإضافة</label>
							<div class="form-control bg-light">
								{{ $customer->created_at?->format('Y-m-d H:i') }}
							</div>
						</div>

						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">آخر تحديث</label>
							<div class="form-control bg-light">
								{{ $customer->updated_at?->format('Y-m-d H:i') }}
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>

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