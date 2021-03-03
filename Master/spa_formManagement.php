<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="FormManagement" components="{dmxMediumEditor:{},dmxSummernote:{},dmxDropzone:{}}" -->
<dmx-serverconnect id="scValidateForm" url="dmxConnect/api/Form/ValidateForm.php" noload="noload" dmx-param:form_name=""></dmx-serverconnect>
<div is="dmx-browser" id="browser1"></div>
<div class=" container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<div class="d-flex align-items-center flex-wrap mr-1">
		<div class="d-flex align-items-baseline mr-5">
			<h1 class="text-dark my-2 mr-5 font-weight-light">
				Create Form </h1>
		</div>
	</div>
	<div class="d-flex align-items-center">
		<!--begin::Actions-->
		<a href="./form-management" class="btn btn-primary font-weight-bold btn-sm">
			<i class="flaticon-plus"></i>
			Form List
		</a>
	</div>
</div>

<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<form class="form" method="post" is="dmx-serverconnect-form" id="CreateForm" action="dmxConnect/api/Form/CreateForm.php"
			dmx-on:success="CreateForm.reset();scGetForms.load();notifies1.success(&quot;Form Created Succesfully&quot;);browser1.goto('./form/detail/'+CreateForm.data.FormID)">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Form Name</label>
							<input type="text" required placeholder="Enter form name..." name="form_name" class="form-control form-control-solid" dmx-on:changed="scValidateForm.load({form_name: value})" />
							<span class="badge badge-success mt-1" dmx-show="scValidateForm.data.Response == 2 && form_name.value">Available <i class="fa fa-check text-white"></i></span>
							<span class="badge badge-danger  mt-1" dmx-show="scValidateForm.data.Response == 1 && form_name.value">Form with this name already created <i class="fa fa-exclamation-circle text-white"></i></span>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="form-group">
							<label>Grid Size</label>
							<select class="form-control" name="grid_size">
								<option value="col-lg-12">1</option>
								<option value="col-lg-6">2</option>
								<option value="col-lg-4">3</option>
								<option value="col-lg-3">4</option>
							</select>
						</div>
					</div>
					<div class="col-lg-2 pt-5">
						<div class="custom-control custom-checkbox">
							<label class="checkbox checkbox-outline checkbox-success">
								<input type="checkbox" checked name="is_edit" value="1" /> Edit Form
								<span></span>
							</label>
						</div>
					</div>
					<div class="col-lg-2 pt-5 mb-5">
						<div class="custom-control custom-checkbox">
							<label class="checkbox checkbox-outline checkbox-success">
								<input type="checkbox" checked name="is_delete" value="1" /> Delete Form
								<span></span>
							</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<textarea id="form_description" name="form_description" is="dmx-summernote"
							dmx-bind:toolbar="[['style',['style']],['font',['bold','underline','clear']],['fontname',['fontname']],['color',['color']],['para',['ul','ol','paragraph']],['table',['table']],['insert',['link','picture','video']],['view',['fullscreen','codeview','help']]]"
							min-height="250" placeholder="Enter form description here..."></textarea>
					</div>
					<div class="col-lg-6">
						<textarea id="form_instructions" name="form_instructions" is="dmx-summernote"
							dmx-bind:toolbar="[['style',['style']],['font',['bold','underline','clear']],['fontname',['fontname']],['color',['color']],['para',['ul','ol','paragraph']],['table',['table']],['insert',['link','picture','video']],['view',['fullscreen','codeview','help']]]"
							min-height="250" placeholder="Enter form intructions here..."></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<input is="dmx-dropzone" id="form_logo" type="file" name="form_logo" message="Drop form logo here or click to upload.">
					</div>
				</div>
			</div>
			<div class="card-footer text-center">
				<button type="submit" class="btn btn-primary mr-2 btn-lg" dmx-bind:disabled="state.executing || (scValidateForm.data.Response == 1 && form_name.value)">Submit <span class="spinner-border spinner-border-sm" role="status"
						dmx-show="state.executing"></span>
				</button>
			</div>
		</form>
	</div>
</div>