<!doctype html>
<html>

<head>
	<meta name="ac:base" content="/exp">
	<link rel="stylesheet" href="dmxAppConnect/dmxNotifications/dmxNotifications.css" />

	<script src="dmxAppConnect/dmxAppConnect.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="dmxAppConnect/dmxNotifications/dmxNotifications.js" defer=""></script>

	<script src="dmxAppConnect/dmxBrowser/dmxBrowser.js" defer=""></script>

	<meta name="ac:route" content="/auth">
	<base href="/exp/">

	<meta charset="utf-8" />
	<title>OUTLAY | Login Page 1</title>
	<meta name="description" content="Login page example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundlec7e5.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="assets/plugins/global/plugins.bundlec7e5.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/custom/prismjs/prismjs.bundlec7e5.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/style.bundlec7e5.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="assets/css/themes/layout/header/base/lightc7e5.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/themes/layout/header/menu/lightc7e5.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/themes/layout/brand/darkc7e5.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/themes/layout/aside/darkc7e5.css" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/logos/favicon.ico" />
	<link rel="shortcut icon" href="" />


	<script src="dmxAppConnect/dmxBootstrap4Navigation/dmxBootstrap4Navigation.js" defer=""></script>
	<style>
		.form-control.form-control-solid {
			box-shadow: inset -2px -2px 6px rgba(255, 255, 255, 0.05), 2px 2px 6px rgba(0, 0, 0, 0.5);
			background-color: #252525;
			border-color: #252525;
			color: #999eb7
		}

		.form-control.form-control-solid:active,
		.form-control.form-control-solid.active,
		.form-control.form-control-solid:focus,
		.form-control.form-control-solid.focus,
		.form-control.form-control-solid:active,
		.form-control.form-control-solid.active,
		.form-control.form-control-solid:focus,
		.form-control.form-control-solid.focus {
			box-shadow: inset -2px -2px 6px rgba(255, 255, 255, 0.05), 2px 2px 6px rgba(0, 0, 0, 0.5);
			background-color: #252525;
			border-color: #3699FF;
			color: #999eb7
		}

		.form-control.form-control-solid:active,
		.form-control.form-control-solid.active,
		.form-control.form-control-solid:focus,
		.form-control.form-control-solid.focus,
		.btn.btn-primary:not(:disabled):not(.disabled):active:not(.btn-text),
		.btn.btn-primary:not(:disabled):not(.disabled).active,
		.show>.btn.btn-primary.dropdown-toggle,
		.show .btn.btn-primary.btn-dropdown,
			{
			background-color: #252525;
			box-shadow: inset -2px -2px 6px rgba(255, 255, 255, 0.05), 2px 2px 6px rgba(0, 0, 0, 0.5);
			border-color: #21374a;
			color: #999eb7
		}

		input:-webkit-autofill,
		input:-webkit-autofill:hover,
		input:-webkit-autofill:focus,
		input:-webkit-autofill:active,
		input:-internal-autofill-selected {
			background-color: #252525 !important;
			box-shadow: inset -2px -2px 6px rgba(255, 255, 255, 0.05), 2px 2px 6px rgba(0, 0, 0, 0.5) !important;
			border-color: #21374a !important;
			color: #999eb7 !important;
		}

		.btn.btn-primary {
			color: #3099ff;
			background-color: #252525;
			border-color: #252525;
			box-shadow: -5px -5px 10px rgba(255, 255, 255, 0.05), 5px 5px 15px rgba(0, 0, 0, 0.5);
		}

		.btn.btn-primary:hover:not(.btn-text):not(:disabled):not(.disabled),
		.btn.btn-primary:focus:not(.btn-text),
		.btn.btn-primary.focus:not(.btn-text),
		.btn.btn-primary:not(:disabled):not(.disabled):active:not(.btn-text),
		.btn.btn-primary:not(:disabled):not(.disabled).active,
		.show>.btn.btn-primary.dropdown-toggle,
		.show .btn.btn-primary.btn-dropdown,
		.btn.btn-hover-primary:hover:not(.btn-text):not(:disabled):not(.disabled),
		.btn.btn-hover-primary:focus:not(.btn-text),
		.btn.btn-hover-primary.focus:not(.btn-text) {
			color: #3099ff;
			background-color: #272727;
			border-color: #3099ff;
			box-shadow: -5px -5px 10px rgba(255, 255, 255, 0.05), 5px 5px 15px rgba(0, 0, 0, 0.5);
		}
	</style>
</head>

<body is="dmx-app" class="header-fixed header-mobile-fixed subheader-enabled sidebar-enabled page-loading">
	<div is="dmx-browser" id="browser1"></div>
	<dmx-notifications id="notifies1"></dmx-notifications>
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login" style="background: #252525">
			<!--begin::Aside-->
			<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7" style="background: #252525">
				<!--begin::Content body-->
				<div class="d-flex flex-column-fluid flex-center">
					<!--begin::Signin-->
					<div class="login-form login-signin" style="border-radius:10px;box-shadow: -5px -5px 10px rgba(255,255,255,0.05), 5px 5px 15px rgba(0,0,0,0.5)">
						<!--begin::Form-->
						<form class="form p-10" method="post" novalidate="novalidate" id="auth-form" is="dmx-serverconnect-form" action="dmxConnect/api/AccessControl/Login.php"
							dmx-on:success="notifies1.success('Succesfully Logged In');browser1.goto('index.php')" dmx-on:unauthorized="notifies1.danger('&amp;quot;Invalid Login&amp;quot;')">
							<!--begin::Title-->
							<div class="pb-13 pt-lg-0 pt-5">
								<h3 class="text-primary" style="font-weight:300;font-size:32px">Welcome to OUTLAY</h3>
							</div>
							<!--begin::Title-->

							<div class="form-group">
								<label class="font-size-h6 font-weight-bolder text-primary">Email/Username</label>
								<input class="form-control form-control-solid h-auto py-5 px-6 rounded-lg" type="text" name="username" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<div class="form-group">
								<div class="d-flex justify-content-between mt-n5">
									<label class="font-size-h6 font-weight-bolder text-primary pt-5">Password</label>

									<!-- <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">
										Forgot Password ?
									</a> -->
								</div>

								<input class="form-control form-control-solid h-auto py-5 px-6 rounded-lg" type="password" name="password" autocomplete="off" />
							</div>
							<!--end::Form group-->

							<!--begin::Action-->
							<div class="pb-lg-0 pb-5">
								<button type="submit" id="m_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" dmx-bind:disabled="state.executing">Sign In <span
										class="spinner-grow spinner-grow-sm" role="status" dmx-show="state.executing"></span>
								</button>
							</div>
							<!--end::Action-->
						</form>
					</div>
					<!--end::Forgot-->
				</div>
				<!--end::Content body-->
			</div>

		</div>
		<!--end::Login-->
	</div>
	<script src="assets/plugins/global/plugins.bundlec7e5.js"></script>
	<script src="assets/plugins/custom/prismjs/prismjs.bundlec7e5.js"></script>
	<script src="assets/js/scripts.bundlec7e5.js"></script>
	<!--end::Global Theme Bundle-->
	<!--begin::Page Vendors(used by this page)-->
	<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundlec7e5.js"></script>
	<!--end::Page Vendors-->
	<!--begin::Page Scripts(used by this page)-->
	<script src="assets/js/pages/widgetsc7e5.js"></script>
</body>

</html>