@extends('layouts.master')

@section('title', 'الأقسام')

@section('css') <!-- DataTables -->
	<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('page-header') <!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="my-auto">
			<div class="d-flex align-items-center">
				<h4 class="content-title mb-0 my-auto">
					المنتجات </h4>


				<span class="text-muted mt-1 tx-13 mr-2 mb-0">
					/ الأقسام
				</span>
			</div>
		</div>
	</div>
	<!-- breadcrumb -->


@endsection

@section('content')


	<div class="row row-sm">

		<div class="col-xl-12">

			<div class="card mg-b-20">

				{{-- ================================================= --}}
				{{-- Header --}}
				{{-- ================================================= --}}

				<div class="card-header pb-0">

					<div class="d-flex justify-content-between align-items-center flex-wrap">

						<div>
							<h5 class="card-title mb-1">
								قائمة الأقسام
							</h5>

							<p class="text-muted mb-0">
								إدارة أقسام المنتجات
							</p>
						</div>

						<div class="mt-2 mt-md-0">
							<button type="button" class="btn btn-primary font-weight-bold add-section" data-toggle="modal"
								data-target="#sectionModal">
								<i class="fas fa-plus ml-1"></i>
								إضافة قسم
							</button>
						</div>

					</div>

				</div>

				{{-- ================================================= --}}
				{{-- Alerts --}}
				{{-- ================================================= --}}

				<div class="card-body pb-0">

					@if (session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ session('success') }}

							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif

					@if (session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							{{ session('error') }}

							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif

					@if ($errors->any())
						<div class="alert alert-danger alert-dismissible fade show" role="alert">

							{{ $errors->first() }}

							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>

						</div>
					@endif

				</div>

				{{-- ================================================= --}}
				{{-- Table --}}
				{{-- ================================================= --}}

				<div class="card-body pt-2">

					<div class="table-responsive">

						<table id="sectionsTable" class="table table-bordered text-nowrap text-center w-100">

							<thead>

								<tr>

									<th class="border-bottom-0">
										#
									</th>

									<th class="border-bottom-0">
										اسم القسم
									</th>

									<th class="border-bottom-0">
										الوصف
									</th>

									<th class="border-bottom-0">
										العمليات
									</th>

								</tr>

							</thead>

							<tbody>

								@forelse ($sections as $section)

									<tr>

										<td>
											{{ $loop->iteration }}
										</td>

										<td>
											{{ $section->section_name }}
										</td>

										<td>
											{{ $section->section_description ?: 'لا يوجد' }}
										</td>

										<td>

											<div class="d-flex justify-content-center align-items-center">

												{{-- Edit --}}
												<button type="button" class="btn btn-sm btn-primary mx-1 edit-section"
													title="تعديل" data-id="{{ $section->id }}"
													data-name="{{ $section->section_name }}"
													data-description="{{ $section->section_description }}" data-toggle="modal"
													data-target="#sectionModal">
													<i class="fas fa-edit"></i>
												</button>

												{{-- Delete --}}
												<form action="{{ route('sections.destroy', $section) }}" method="POST"
													class="d-inline-block m-0">

													@csrf
													@method('DELETE')

													<button type="submit" class="btn btn-sm btn-danger mx-1" title="حذف"
														onclick="return confirm('هل أنت متأكد من حذف القسم؟')">
														<i class="fas fa-trash"></i>
													</button>

												</form>

											</div>

										</td>

									</tr>

								@empty

									<tr>

										<td colspan="4" class="text-center text-muted py-4">
											لا توجد أقسام حاليًا
										</td>

									</tr>

								@endforelse

							</tbody>

						</table>

					</div>

				</div>

			</div>

		</div>

	</div>


	{{-- ============================================================= --}}
	{{-- Add / Edit Modal --}}
	{{-- ============================================================= --}}

	<div class="modal fade" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="sectionModalTitle"
		aria-hidden="true">

		<div class="modal-dialog modal-dialog-centered" role="document">

			<div class="modal-content">

				<div class="modal-header">

					<h5 class="modal-title" id="sectionModalTitle">
						إضافة قسم
					</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

				</div>

				<form id="sectionForm" action="{{ route('sections.store') }}" method="POST" autocomplete="off">

					@csrf

					<div class="modal-body">

						<div class="form-group">

							<label for="section_name">
								اسم القسم
								<span class="text-danger">*</span>
							</label>

							<input type="text" class="form-control" id="section_name" name="section_name"
								value="{{ old('section_name') }}" placeholder="أدخل اسم القسم" required>

						</div>

						<div class="form-group mb-0">

							<label for="section_description">
								الوصف
							</label>

							<textarea class="form-control" id="section_description" name="section_description" rows="4"
								placeholder="أدخل وصف القسم">{{ old('section_description') }}</textarea>

						</div>

					</div>

					<div class="modal-footer">

						<button type="submit" id="sectionSubmit" class="btn btn-success">
							تأكيد
						</button>

						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							إغلاق
						</button>

					</div>

				</form>

			</div>

		</div>

	</div>


@endsection

@section('js')


	{{-- ============================================================= --}}
	{{-- DataTables --}}
	{{-- ============================================================= --}}

	<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>

	<script>

		$(document).ready(function () {

			/*
			 * ========================================================
			 * DataTable
			 * ========================================================
			 */

			$('#sectionsTable').DataTable({
				responsive: true,
				pageLength: 10,
				ordering: true,
				searching: true,
				language: {
					search: 'بحث:',
					lengthMenu: 'عرض _MENU_ سجل',
					info: 'عرض _START_ إلى _END_ من أصل _TOTAL_ سجل',
					infoEmpty: 'لا توجد سجلات',
					zeroRecords: 'لا توجد نتائج مطابقة',
					emptyTable: 'لا توجد أقسام حاليًا',
					paginate: {
						first: 'الأول',
						last: 'الأخير',
						next: 'التالي',
						previous: 'السابق'
					}
				}
			});


			/*
			 * ========================================================
			 * Add Section
			 * ========================================================
			 */

			$('.add-section').on('click', function () {

				$('#sectionModalTitle').text('إضافة قسم');

				$('#sectionSubmit').text('تأكيد');

				$('#sectionForm').attr(
					'action',
					'{{ route('sections.store') }}'
				);

				$('#section_name').val('');

				$('#section_description').val('');

				/*
				 * Remove Laravel method override
				 * if the form was previously used for edit.
				 */

				$('#sectionForm input[name="_method"]').remove();

			});


			/*
			 * ========================================================
			 * Edit Section
			 * ========================================================
			 */

			$('.edit-section').on('click', function () {

				let id = $(this).data('id');
				let name = $(this).data('name');
				let description = $(this).data('description');

				$('#sectionModalTitle').text('تعديل القسم');

				$('#sectionSubmit').text('تعديل');

				$('#section_name').val(name);

				$('#section_description').val(
					description ? description : ''
				);

				/*
				 * Remove previous method override
				 * to prevent duplicate _method fields.
				 */

				$('#sectionForm input[name="_method"]').remove();

				/*
				 * Update action
				 */

				$('#sectionForm').attr(
					'action',
					"{{ url('sections') }}/" + id
				);

				/*
				 * Laravel method spoofing.
				 */

				$('#sectionForm').prepend(
					'<input type="hidden" name="_method" value="PUT">'
				);

			});

		});

	</script>


@endsection