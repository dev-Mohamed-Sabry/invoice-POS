<!-- main-sidebar -->

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar sidebar-scroll">


	<div class="main-sidebar-header active">
		<a class="desktop-logo logo-light active" href="{{ url('/index') }}">
			<img src="{{ URL::asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo">
		</a>

		<a class="desktop-logo logo-dark active" href="{{ url('/index') }}">
			<img src="{{ URL::asset('assets/img/brand/logo-white.png') }}" class="main-logo dark-theme" alt="logo">
		</a>

		<a class="logo-icon mobile-logo icon-light active" href="{{ url('/index') }}">
			<img src="{{ URL::asset('assets/img/brand/favicon.png') }}" class="logo-icon" alt="logo">
		</a>

		<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/index') }}">
			<img src="{{ URL::asset('assets/img/brand/favicon-white.png') }}" class="logo-icon dark-theme" alt="logo">
		</a>
	</div>

	<div class="main-sidemenu">

		<div class="app-sidebar__user clearfix">
			<div class="dropdown user-pro-body">

				<div>
					<img alt="user-img" class="avatar avatar-xl brround"
						src="{{ URL::asset('assets/img/faces/6.jpg') }}">

					<span class="avatar-status profile-status bg-green"></span>
				</div>

				<div class="user-info">
					<h4 class="font-weight-semibold mt-3 mb-0">
						{{ auth()->user()->name }}
					</h4>

					<span class="mb-0 text-muted">
						{{ auth()->user()->email }}
					</span>
				</div>

			</div>
		</div>

		<ul class="side-menu">

			{{-- ===================================================== --}}
			{{-- الرئيسية --}}
			{{-- ===================================================== --}}

			<li class="side-item side-item-category">
				الرئيسية
			</li>

			<li class="slide">
				<a class="side-menu__item" href="{{ url('/index') }}">

					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

						<path d="M0 0h24v24H0V0z" fill="none" />

						<path
							d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z" />
					</svg>

					<span class="side-menu__label">
						الرئيسية
					</span>

				</a>
			</li>


			{{-- ===================================================== --}}
			{{-- المبيعات --}}
			{{-- ===================================================== --}}

			<li class="side-item side-item-category">
				المبيعات
			</li>

			<li class="slide">

				<a class="side-menu__item" data-toggle="slide" href="{{ url('#') }}">

					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

						<path d="M0 0h24v24H0V0z" fill="none" />

						<path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />

						<path
							d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />

					</svg>

					<span class="side-menu__label">
						العقود
					</span>

					<i class="angle fe fe-chevron-down"></i>

				</a>

				<ul class="slide-menu">

					<li>
						<a class="slide-item" href="{{ route('contracts.index') }}">
							قائمة العقود
						</a>
					</li>

					<li>
						<a class="slide-item" href="{{ route('contracts.create') }}">
							إضافة عقد
						</a>
					</li>

				</ul>

			</li>


			{{-- ===================================================== --}}
			{{-- العملاء --}}
			{{-- ===================================================== --}}

			<li class="side-item side-item-category">
				العملاء
			</li>

			<li class="slide">

				<a class="side-menu__item" data-toggle="slide" href="{{ url('#') }}">

					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

						<path d="M0 0h24v24H0V0z" fill="none" />

						<path
							d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3z"
							opacity=".3" />

						<path
							d="M8 13c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5zM8 11c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm8 0c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3z" />

					</svg>

					<span class="side-menu__label">
						العملاء
					</span>

					<i class="angle fe fe-chevron-down"></i>

				</a>

				<ul class="slide-menu">

					<li>
						<a class="slide-item" href="{{ route('customers.index') }}">
							قائمة العملاء
						</a>
					</li>

					<li>
						<a class="slide-item" href="{{ route('customers.create') }}">
							إضافة عميل
						</a>
					</li>

				</ul>

			</li>


			{{-- ===================================================== --}}
			{{-- المنتجات --}}
			{{-- ===================================================== --}}

			<li class="side-item side-item-category">
				المنتجات
			</li>

			<li class="slide">

				<a class="side-menu__item" data-toggle="slide" href="{{ url('#') }}">

					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

						<path d="M0 0h24v24H0V0z" fill="none" />

						<path d="M20 8h-3V4H7v4H4l8 5 8-5z" opacity=".3" />

						<path d="M20 8h-3V4H7v4H4l8 5 8-5zm-8 3.27L7.82 9H9V6h6v3h1.18L12 11.27zM4 18h16v2H4z" />

					</svg>

					<span class="side-menu__label">
						المنتجات
					</span>

					<i class="angle fe fe-chevron-down"></i>

				</a>

				<ul class="slide-menu">

					<li>
						<a class="slide-item" href="{{ route('sections.index') }}">
							الأقسام
						</a>
					</li>

					<li>
						<a class="slide-item" href="{{ route('products.index') }}">
							المنتجات
						</a>
					</li>

				</ul>

			</li>


			{{-- ===================================================== --}}
			{{-- التحصيل والمدفوعات --}}
			{{-- ===================================================== --}}

			{{-- سيتم تفعيل هذا القسم بعد بناء Installments / Payments --}}

			{{--
			<li class="side-item side-item-category">
				التحصيل والمدفوعات
			</li>

			<li class="slide">

				<a class="side-menu__item" data-toggle="slide" href="{{ url('#') }}">

					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

						<path d="M0 0h24v24H0V0z" fill="none" />

						<path d="M4 4h16v16H4z" opacity=".3" />

						<path
							d="M20 2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H4V4h16v16zM8 9h8V7H8v2zm0 4h8v-2H8v2zm0 4h5v-2H8v2z" />

					</svg>

					<span class="side-menu__label">
						التحصيل والمدفوعات
					</span>

					<i class="angle fe fe-chevron-down"></i>

				</a>

				<ul class="slide-menu">

					<li>
						<a class="slide-item" href="#">
							الأقساط
						</a>
					</li>

					<li>
						<a class="slide-item" href="#">
							المدفوعات
						</a>
					</li>

					<li>
						<a class="slide-item" href="#">
							إيصالات الدفع
						</a>
					</li>

				</ul>

			</li>
			--}}


			{{-- ===================================================== --}}
			{{-- الفواتير القديمة --}}
			{{-- ===================================================== --}}

			<li class="side-item side-item-category">
				الفواتير
			</li>

			<li class="slide">

				<a class="side-menu__item" data-toggle="slide" href="{{ url('#') }}">

					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

						<path d="M0 0h24v24H0V0z" fill="none" />

						<path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3" />

						<path
							d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z" />

					</svg>

					<span class="side-menu__label">
						الفواتير القديمة
					</span>

					<i class="angle fe fe-chevron-down"></i>

				</a>

				<ul class="slide-menu">

					<li>
						<a class="slide-item" href="{{ route('invoices.index') }}">
							قائمة الفواتير
						</a>
					</li>

				</ul>

			</li>


			{{-- ===================================================== --}}
			{{-- الموظفون --}}
			{{-- ===================================================== --}}

			@auth
				@if (auth()->user()->usertype === 'admin')

					<li class="side-item side-item-category">
						الموظفون
					</li>

					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href="{{ url('#') }}">

							<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

								<path d="M0 0h24v24H0V0z" fill="none" />

								<path
									d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zM8 11c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3z"
									opacity=".3" />

								<path
									d="M8 13c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />

							</svg>

							<span class="side-menu__label">
								الموظفون
							</span>

							<i class="angle fe fe-chevron-down"></i>

						</a>

						<ul class="slide-menu">

							<li>
								<a class="slide-item" href="{{ route('employees.index') }}">
									الموظفون
								</a>
							</li>

							<li>
								<a class="slide-item" href="{{ route('employees.create') }}">
									إضافة موظف
								</a>
							</li>

							{{-- المستخدمون والصلاحيات يتم إضافتهم لاحقاً --}}

						</ul>

					</li>

				@endif
			@endauth


			{{-- ===================================================== --}}
			{{-- التقارير --}}
			{{-- ===================================================== --}}

			<li class="side-item side-item-category">
				التقارير
			</li>

			<li class="slide">

				<a class="side-menu__item" data-toggle="slide" href="{{ url('#') }}">

					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

						<path d="M0 0h24v24H0V0z" fill="none" />

						<path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3" />

						<path
							d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 3h6.93c-.04.34-.11.67-.19 1H13v-1zm0 3h5.24c-.2.35-.43.69-.68 1H13v-1z" />

					</svg>

					<span class="side-menu__label">
						التقارير
					</span>

					<i class="angle fe fe-chevron-down"></i>

				</a>

				<ul class="slide-menu">

					{{-- سيتم إضافة التقارير الفعلية بعد اكتمال النظام المالي --}}

					<li>
						<a class="slide-item" href="#">
							تقارير العقود
						</a>
					</li>

					<li>
						<a class="slide-item" href="#">
							تقارير العملاء
						</a>
					</li>

				</ul>

			</li>


			{{-- ===================================================== --}}
			{{-- الإعدادات --}}
			{{-- ===================================================== --}}

			<li class="side-item side-item-category">
				الإعدادات
			</li>

			<li class="slide">

				<a class="side-menu__item" data-toggle="slide" href="{{ url('#') }}">

					<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">

						<path d="M0 0h24v24H0V0z" fill="none" />

						<path
							d="M19.43 12.98c.04-.32.07-.65.07-.98s-.02-.66-.07-.98l2.11-1.65c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.37-.31-.6-.22l-2.49 1c-.52-.4-1.08-.73-1.69-.98L14.5 2.42C14.47 2.18 14.25 2 14 2h-4c-.25 0-.46.18-.5.42L9.12 5.07c-.61.25-1.18.59-1.69.98l-2.49-1c-.23-.08-.48 0-.6.22l-2 3.46c-.13.22-.07.49.12.64l2.11 1.65c-.04.32-.08.65-.08.98s.03.66.08.98l-2.11 1.65c-.19.15-.24.42-.12.64l2 3.46c.12.22.37.31.6.22l2.49-1c.52.4 1.08.73 1.69.98l.38 2.65c.04.24.25.42.5.42h4c.25 0 .46-.18.5-.42l.38-2.65c.61-.25 1.18-.58 1.69-.98l2.49 1c.23.08.48 0 .6-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.65z"
							opacity=".3" />

						<path
							d="M12 15.5A3.5 3.5 0 1 1 12 8a3.5 3.5 0 0 1 0 7.5zm0-2A1.5 1.5 0 1 0 12 10a1.5 1.5 0 0 0 0 3.5z" />

					</svg>

					<span class="side-menu__label">
						الإعدادات
					</span>

					<i class="angle fe fe-chevron-down"></i>

				</a>

				<ul class="slide-menu">

					<li>
						<a class="slide-item" href="{{ route('sections.index') }}">
							الأقسام
						</a>
					</li>

					<li>
						<a class="slide-item" href="{{ route('products.index') }}">
							المنتجات
						</a>
					</li>

				</ul>

			</li>

		</ul>

	</div>


</aside>
<!-- main-sidebar -->