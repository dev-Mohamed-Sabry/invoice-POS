@extends('layouts.master')

@section('title', 'قائمة الموظفين')

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
				<h4 class="content-title mb-0 my-auto">الموظفين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
					قائمة الموظفين</span>
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

	<div class="row">

		<div class="col-lg-12 col-md-12">

			<form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data"
				autocomplete="off">

				@csrf
				@method('PUT')
				{{-- Basic Information --}}
				<div class="card">

					<div class="card-header">
						<h4 class="card-title mb-0">البيانات الأساسية</h4>
					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-4 mb-3">
								<label for="name" class="font-weight-bold">
									اسم الموظف <span class="text-danger">*</span>
								</label>

								<input type="text" class="form-control" id="name" name="name"
									value="{{ old('name', $employee->name) }}" required>
							</div>

							<div class="col-md-4 mb-3">
								<label for="email" class="font-weight-bold">
									البريد الإلكتروني <span class="text-danger">*</span>
								</label>

								<input type="email" class="form-control" id="email" name="email"
									value="{{ old('email', $employee->email) }}" required>
							</div>

							<div class="col-md-4 mb-3">
								<label for="phone" class="font-weight-bold">
									رقم الهاتف
								</label>

								<input type="text" class="form-control" id="phone" name="phone"
									value="{{ old('phone', $employee->phone) }}">
							</div>

							<div class="col-md-6 mb-3">
								<label for="job_title" class="font-weight-bold">
									المسمى الوظيفي
								</label>

								<input type="text" class="form-control" id="job_title" name="job_title"
									value="{{ old('job_title', $employee->job_title) }}">
							</div>

							<div class="col-md-6 mb-3">
								<label for="is_active" class="font-weight-bold">
									حالة الموظف
								</label>

								<select name="is_active" id="is_active" class="form-control">

									<option value="1" {{ old('is_active', $employee->is_active) == 1 ? 'selected' : '' }}>
										نشط
									</option>

									<option value="0" {{ old('is_active', $employee->is_active) == 0 ? 'selected' : '' }}>
										غير نشط
									</option>

								</select>
							</div>

						</div>

					</div>

				</div>


				{{-- Employee ID Images --}}
				<div class="card">

					<div class="card-header">
						<h4 class="card-title mb-0">بطاقة الموظف</h4>
					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-6 mb-4">

								<label for="attachment_front" class="font-weight-bold d-block">
									صورة وجه البطاقة
								</label>

								@if ($employee->attachment_front)

									<div class="mb-3">

										<a href="{{ asset('storage/' . $employee->attachment_front) }}" target="_blank">

											<img src="{{ asset('storage/' . $employee->attachment_front) }}"
												class="img-fluid rounded border" style="max-height:250px">

										</a>

									</div>

								@else

									<div class="text-muted mb-3">
										لا توجد صورة حالية
									</div>

								@endif

								<input type="file" class="form-control" id="attachment_front" name="attachment_front"
									accept="image/jpeg,image/png,image/webp">

								<small class="text-muted">
									اترك الحقل فارغاً للاحتفاظ بالصورة الحالية
								</small>

							</div>


							<div class="col-md-6 mb-4">

								<label for="attachment_back" class="font-weight-bold d-block">
									صورة ظهر البطاقة
								</label>

								@if ($employee->attachment_back)

									<div class="mb-3">

										<a href="{{ asset('storage/' . $employee->attachment_back) }}" target="_blank">

											<img src="{{ asset('storage/' . $employee->attachment_back) }}"
												class="img-fluid rounded border" style="max-height:250px">

										</a>

									</div>

								@else

									<div class="text-muted mb-3">
										لا توجد صورة حالية
									</div>

								@endif

								<input type="file" class="form-control" id="attachment_back" name="attachment_back"
									accept="image/jpeg,image/png,image/webp">

								<small class="text-muted">
									اترك الحقل فارغاً للاحتفاظ بالصورة الحالية
								</small>

							</div>

						</div>

					</div>

				</div>


				{{-- System Information --}}
				<div class="card">

					<div class="card-header">
						<h4 class="card-title mb-0">بيانات النظام</h4>
					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-4 mb-3">
								<label class="font-weight-bold">
									نوع المستخدم
								</label>

								<div class="form-control bg-light">

									@if ($employee->usertype === 'admin')
										مدير
									@else
										موظف
									@endif

								</div>
							</div>

							<div class="col-md-4 mb-3">
								<label class="font-weight-bold">
									تاريخ الإضافة
								</label>

								<div class="form-control bg-light">
									{{ $employee->created_at?->format('Y-m-d H:i') }}
								</div>
							</div>

							<div class="col-md-4 mb-3">
								<label class="font-weight-bold">
									آخر تحديث
								</label>

								<div class="form-control bg-light">
									{{ $employee->updated_at?->format('Y-m-d H:i') }}
								</div>
							</div>

						</div>

					</div>

				</div>


				{{-- Actions --}}
				<div class="d-flex justify-content-center mb-4">

					<button type="submit" class="btn btn-primary">
						حفظ التعديلات
					</button>

					<a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary mr-2">
						إلغاء
					</a>

				</div>

			</form>

		</div>

	</div>

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