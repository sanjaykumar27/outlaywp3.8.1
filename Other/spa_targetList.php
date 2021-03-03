<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_33="cdn" id="TargetList" components="{dmxBootstrap4Modal:{},dmxDropzone:{},dmxStateManagement:{},dmxNotifications:{},dmxFormatter:{},dmxCharts:{}}" -->

<dmx-value id="varTargetID"></dmx-value>

<dmx-notifications id="notifies1"></dmx-notifications>
<dmx-query-manager id="qm"></dmx-query-manager>
<dmx-serverconnect id="scTargetList" url="dmxConnect/api/Other/Target/getTargetList.php"></dmx-serverconnect>
<div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<div class="d-flex align-items-center flex-wrap mr-1">
		<div class="d-flex align-items-baseline mr-5">
			<h1 class="text-dark my-2 mr-5 font-weight-light">
				Target List
			</h1>
		</div>
	</div>
	<div class="d-flex align-items-center">
		<!--begin::Actions-->
		<button class="btn btn-primary font-weight-bold btn-sm" data-toggle="modal" data-target="#createtarget">
			<i class="flaticon-plus"></i>
			Add Target
		</button>
	</div>
</div>

<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-6" dmx-repeat:repeattargets="scTargetList.data.queryTargetList.data">
				<!--begin::Mixed Widget 7-->
				<div class="card card-custom gutter-b card-stretch shadow">
					<!--begin::Body-->
					<div class="card-body">
						<div class="d-flex flex-wrap align-items-center py-1">
							<!--begin:Pic-->
							<div class="symbol symbol-80 symbol-light-danger mr-5">
								<span class="symbol-label">
									<img class="w-100 align-self-center" alt="" dmx-bind:src="assets/uploads/target/{{target_photo}}">
								</span>
							</div>
							<!--end:Pic-->

							<!--begin:Title-->
							<div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
								<a href="#" class="text-dark font-weight-bolder text-hover-primary font-size-h5 py-1 border-bottom">
									{{target_name}} <span class="label label-lg label-light-primary label-inline float-right" dmx-on:click="varTargetID.setValue(id);modalTransaction.show()">
										<i class="fa fa-plus"></i> &nbsp;Transaction
									</span>
								</a>
								<span class="text-muted font-weight-bold font-size-lg py-1 border-bottom">
									{{target_description}}
								</span>
								<h4 class="py-2 border-bottom"> <span class="text-success">{{(TotalCredit - TotalDebit).formatCurrency("₹", ".", ",", "2")}}</span> of {{target_amount.formatCurrency("₹", ".", ",", "2")}}</h4>
							</div>
							<!--end:Title-->

							<!--begin:Stats-->
							<div class="d-flex flex-column w-100 mt-6">
								<span class="text-dark mr-2 font-size-lg font-weight-bolder pb-3">
									Progress
									<span class="text-primary float-right h1 font-weight-light">{{((TotalCredit - TotalDebit) / target_amount * 100).formatNumber(2, ".", ",")}}% </span>

								</span>

								<div class="progress progress-xs w-100" style="height:10px">
									<div class="progress-bar bg-success" role="progressbar" dmx-bind:style="width: {{(TotalCredit - TotalDebit) / target_amount * 100}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>

						</div>
					</div>
					<!--end::Body-->
				</div>
				<!--end::Mixed Widget 7-->
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="createtarget" is="dmx-bs4-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form" is="dmx-serverconnect-form" id="formCreateTarget" action="dmxConnect/api/Other/Target/CreateTarget.php" method="post"
				dmx-on:success="scTargetList.load({});notifies1.success(&quot;Target created succesfully!&quot;);formCreateTarget.reset();createtarget.hide()">
				<div class="modal-header">
					<h5 class="modal-title">Create Target</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body bg-light">
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Target Name:</label>
						<div class="col-lg-9">
							<input type="text" required class="form-control" placeholder="Enter Target Name..." name="target_name" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Purposes:</label>
						<div class="col-lg-9">
							<textarea class="form-control" rows="2" placeholder="Enter Purpose" name="target_description"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-lg-3 col-form-label">Amount:</label>
						<div class="col-lg-9">
							<div class="input-group">
								<input type="number" required class="form-control" placeholder="Amount" name="target_amount" />
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-3">Upload Image</label>
						<div class="col-lg-9">
							<input is="dmx-dropzone" id="targetFile" type="file" name="target_photo" thumbs="false" required="" data-msg-required="Please select a file.">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">Save <span class="spinner-grow spinner-grow-sm" role="status" dmx-show="state.executing"></span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modalTransaction" is="dmx-bs4-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" is="dmx-serverconnect-form" id="scAddTransaction" action="dmxConnect/api/Other/Target/createTransaction.php"
				dmx-on:success="notifies1.success(&quot;Trasaction Added Succesfully&quot;);modalTransaction.hide();scAddTransaction.reset();scTargetList.load({})">
				<div class="modal-header">
					<h5 class="modal-title">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body bg-light">
					<input type="hidden" name="target_id" dmx-bind:value="varTargetID.value">
					<div class="form-group row">
						<label class="col-form-label col-lg-12">Transaction Type</label>
						<div class="col-lg-12">
							<select class="form-control" required name="transaction_type">
								<option value="" selected disabled>-Select-</option>
								<option value="credit">Credit</option>
								<option value="debit">Debit</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-lg-12">Amount</label>
						<div class="col-lg-12">
							<input type="number" required class="form-control" name="amount">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" dmx-on:click="varTargetID.setValue('');scAddTransaction.reset();modalTransaction.hide()">Close</button>
					<button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">Save <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
					</button>
				</div>
			</form>
		</div>

	</div>
</div>