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

	<div class="row">

		<div class="col-lg-12 col-md-12">

			<form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data"
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
									اسم العميل <span class="text-danger">*</span>
								</label>

								<input type="text" class="form-control" id="name" name="name"
									value="{{ old('name', $customer->name) }}" required>
							</div>

							<div class="col-md-4 mb-3">
								<label for="phone" class="font-weight-bold">
									رقم الهاتف <span class="text-danger">*</span>
								</label>

								<input type="text" class="form-control" id="phone" name="phone"
									value="{{ old('phone', $customer->phone) }}" required>
							</div>

							<div class="col-md-4 mb-3">
								<label for="secondary_phone" class="font-weight-bold">
									رقم هاتف إضافي
								</label>

								<input type="text" class="form-control" id="secondary_phone" name="secondary_phone"
									value="{{ old('secondary_phone', $customer->secondary_phone) }}">
							</div>

							<div class="col-md-4 mb-3">
								<label for="national_id" class="font-weight-bold">
									الرقم القومي <span class="text-danger">*</span>
								</label>

								<input type="text" class="form-control" id="national_id" name="national_id"
									value="{{ old('national_id', $customer->national_id) }}" required>
							</div>

							<div class="col-md-4 mb-3">
								<label for="date_of_birth" class="font-weight-bold">
									تاريخ الميلاد
								</label>

								<input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
									value="{{ old('date_of_birth', optional($customer->date_of_birth)->format('Y-m-d')) }}">
							</div>

							<div class="col-md-4 mb-3">
								<label for="is_active" class="font-weight-bold">
									حالة العميل
								</label>

								<select name="is_active" id="is_active" class="form-control">

									<option value="1" {{ old('is_active', $customer->is_active) == '1' ? 'selected' : '' }}>
										نشط
									</option>

									<option value="0" {{ old('is_active', $customer->is_active) == '0' ? 'selected' : '' }}>
										غير نشط
									</option>

								</select>
							</div>

						</div>

					</div>
				</div>


				{{-- National ID --}}
				<div class="card">

					<div class="card-header">
						<h4 class="card-title mb-0">بيانات الهوية</h4>
					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-6 mb-4">

								<label for="national_id_front" class="font-weight-bold d-block">
									صورة وجه البطاقة
								</label>

								@if ($customer->national_id_front)
									<div class="mb-3">
										<a href="{{ asset('storage/' . $customer->national_id_front) }}" target="_blank">

											<img src="{{ asset('storage/' . $customer->national_id_front) }}"
												class="img-fluid rounded border" style="max-height: 250px;"
												alt="صورة وجه البطاقة">
										</a>
									</div>
								@else
									<div class="text-muted mb-3">
										لا توجد صورة حالية
									</div>
								@endif

								<input type="file" class="form-control" id="national_id_front" name="national_id_front"
									accept="image/jpeg,image/png,image/webp">

								<small class="text-muted">
									اترك الحقل فارغًا للاحتفاظ بالصورة الحالية
								</small>

							</div>


							<div class="col-md-6 mb-4">

								<label for="national_id_back" class="font-weight-bold d-block">
									صورة ظهر البطاقة
								</label>

								@if ($customer->national_id_back)
									<div class="mb-3">
										<a href="{{ asset('storage/' . $customer->national_id_back) }}" target="_blank">

											<img src="{{ asset('storage/' . $customer->national_id_back) }}"
												class="img-fluid rounded border" style="max-height: 250px;"
												alt="صورة ظهر البطاقة">
										</a>
									</div>
								@else
									<div class="text-muted mb-3">
										لا توجد صورة حالية
									</div>
								@endif

								<input type="file" class="form-control" id="national_id_back" name="national_id_back"
									accept="image/jpeg,image/png,image/webp">

								<small class="text-muted">
									اترك الحقل فارغًا للاحتفاظ بالصورة الحالية
								</small>

							</div>

						</div>

					</div>
				</div>


				{{-- Work Information --}}
				<div class="card">

					<div class="card-header">
						<h4 class="card-title mb-0">بيانات العمل والعنوان</h4>
					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-4 mb-3">
								<label for="job" class="font-weight-bold">
									المهنة
								</label>

								<input type="text" class="form-control" id="job" name="job"
									value="{{ old('job', $customer->job) }}">
							</div>

							<div class="col-md-4 mb-3">
								<label for="workplace" class="font-weight-bold">
									جهة العمل
								</label>

								<input type="text" class="form-control" id="workplace" name="workplace"
									value="{{ old('workplace', $customer->workplace) }}">
							</div>

							<div class="col-md-12 mb-3">
								<label for="address" class="font-weight-bold">
									العنوان <span class="text-danger">*</span>
								</label>

								<textarea class="form-control" id="address" name="address" rows="3"
									required>{{ old('address', $customer->address) }}</textarea>
							</div>

						</div>

					</div>
				</div>


				{{-- Emergency Contact --}}
				<div class="card">

					<div class="card-header">
						<h4 class="card-title mb-0">بيانات الطوارئ</h4>
					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-4 mb-3">
								<label for="emergency_contact_name" class="font-weight-bold">
									اسم شخص الطوارئ
								</label>

								<input type="text" class="form-control" id="emergency_contact_name"
									name="emergency_contact_name"
									value="{{ old('emergency_contact_name', $customer->emergency_contact_name) }}">
							</div>

							<div class="col-md-4 mb-3">
								<label for="emergency_contact_phone" class="font-weight-bold">
									هاتف شخص الطوارئ
								</label>

								<input type="text" class="form-control" id="emergency_contact_phone"
									name="emergency_contact_phone"
									value="{{ old('emergency_contact_phone', $customer->emergency_contact_phone) }}">
							</div>

							<div class="col-md-4 mb-3">
								<label for="emergency_contact_relation" class="font-weight-bold">
									صلة القرابة
								</label>

								<input type="text" class="form-control" id="emergency_contact_relation"
									name="emergency_contact_relation"
									value="{{ old('emergency_contact_relation', $customer->emergency_contact_relation) }}">
							</div>

						</div>

					</div>
				</div>


				{{-- Additional Information --}}
				<div class="card">

					<div class="card-header">
						<h4 class="card-title mb-0">بيانات إضافية</h4>
					</div>

					<div class="card-body">

						<div class="row">

							<div class="col-md-6 mb-3">
								<label for="additional_data" class="font-weight-bold">
									بيانات إضافية
								</label>

								<textarea class="form-control" id="additional_data" name="additional_data"
									rows="4">{{ old('additional_data', $customer->additional_data) }}</textarea>
							</div>

							<div class="col-md-6 mb-3">
								<label for="notes" class="font-weight-bold">
									ملاحظات
								</label>

								<textarea class="form-control" id="notes" name="notes"
									rows="4">{{ old('notes', $customer->notes) }}</textarea>
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
									أضيف بواسطة
								</label>

								<div class="form-control bg-light">
									{{ $customer->created_by }}
								</div>
							</div>

							<div class="col-md-4 mb-3">
								<label class="font-weight-bold">
									تاريخ الإضافة
								</label>

								<div class="form-control bg-light">
									{{ $customer->created_at?->format('Y-m-d H:i') }}
								</div>
							</div>

							<div class="col-md-4 mb-3">
								<label class="font-weight-bold">
									آخر تحديث
								</label>

								<div class="form-control bg-light">
									{{ $customer->updated_at?->format('Y-m-d H:i') }}
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

					<a href="{{ route('customers.show', $customer->id) }}" class="btn btn-secondary mr-2">
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