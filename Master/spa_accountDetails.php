<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="AccountDetails" components="{dmxBootstrap4TableGenerator:{},dmxStateManagement:{},dmxBootstrap4PagingGenerator:{},dmxBootstrap4Modal:{},dmxNotifications:{}}" -->

<dmx-value id="varNetBalance" dmx-bind:value="scGetAccountDetail.data.TotalCredit.TotalCredit - scGetAccountDetail.data.TotalDebit.TotalDebit"></dmx-value>
<dmx-serverconnect id="scGetAccountDetail" url="dmxConnect/api/Master/Account/AccountDetail.php" noload dmx-param:accountid="params.accountid" dmx-param:offset="query.offset" dmx-param:limit="varPageValue.value ? varPageValue.value : 15">
</dmx-serverconnect>
<dmx-query-manager id="qm"></dmx-query-manager>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-2">
			<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Account Details</h5>
		</div>
		<div class="d-flex align-items-center">
			<a href="javascript:void(0)" class="btn btn-primary font-weight-bold" dmx-on:click="modalAccountTransaction.show()">
				<i class="flaticon-plus"></i> Add Transaction
			</a>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<!--begin::Stats Widget 6-->
			<div class="card card-custom card-stretch gutter-b">
				<!--begin::Body-->
				<div class="card-body d-flex align-items-center py-0 mt-4">
					<div class="d-flex flex-column flex-grow-1 py-2 py-lg-5">
						<a href="#" class="card-title font-weight-bolder mb-2">{{scGetAccountDetail.data.AccountDetails.first_name+' '+scGetAccountDetail.data.AccountDetails.last_name}}</a>
						<p class="mb-1 text-dark">
							{{scGetAccountDetail.data.AccountDetails.bank_name}} | {{scGetAccountDetail.data.AccountDetails.AccountType}}</p>
						<span class="font-weight-bold text-muted font-size-lg">A/C No: {{scGetAccountDetail.data.AccountDetails.account_number}}</span>
						<span class="font-weight-bold text-muted font-size-lg">Address: {{scGetAccountDetail.data.AccountDetails.address}} | IFSC Code: {{scGetAccountDetail.data.AccountDetails.ifsc_code}}</span>
					</div>
					<img src="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/avatars/004-boy-1.svg" alt="" class="align-self-end h-100px">
				</div>
				<!--end::Body-->
			</div>
			<!--end::Stats Widget 6-->
		</div>
		<div class="col-xl-4">
			<!--begin::Stats Widget 23-->
			<div class="card card-custom bgi-no-repeat card-stretch gutter-b"
				style="background-position: right top; background-size: 30% auto; background-image: url(https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/media/svg/shapes/abstract-1.svg)">
				<!--begin::Body-->
				<div class="card-body">
					<i class="fa fa-inr fa-2x"></i>
					<span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block">₹
						{{varNetBalance.value}}</span>
					<span class="font-weight-bold text-muted font-size-sm">Net Balance</span>
				</div>
				<!--end::Body-->
			</div>
			<!--end::Stats Widget 23-->
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-custom card-stretch gutter-b w-100">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover font-weight-bolder">
							<thead class="text-uppercase">
								<tr>
									<th width="5%">#</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Date</th>
									<th>Type</th>
									<th>Details</th>
									<th>From A/C</th>
									<th>To A/C</th>
									<th>Exp Ref.</th>
								</tr>
							</thead>
							<tbody is="dmx-repeat" id="repeatAccounts" dmx-bind:repeat="scGetAccountDetail.data.getDetails.data">
								<tr>
									<td>{{$index + qm.data.offset.toNumber() + 1}}</td>
									<td>{{Debit.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</td>
									<td>{{Credit.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</td>
									<td>{{TransactionDate.formatDate("dd MMM yy")}}</td>
									<td>{{TransactionType}}</td>
									<td>{{TransactionDetail}}</td>
									<td>{{FromAccount}}</td>
									<td>{{ToAccount}}</td>
									<td>{{ExpenseID}}</td>
								</tr>
							</tbody>
						</table>
						<div class="d-flex flex-row justify-content-md-center align-items-center my-3">
							<ul class="pagination justify-content-center pagination-lg" dmx-populate="scGetAccountDetail.data.getDetails" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
								<!-- <select class="form-control form-control-sm text-primary bg-light-light mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scItemList.load()">
								<option value="10" selected>10</option>
								<option value="30">30</option>
								<option value="50">50</option>
								<option value="75">75</option>
								<option value="100">100</option>
							</select> -->
								<li class="page-item" dmx-class:disabled="scGetAccountDetail.data.getDetails.page.current == 1" aria-label="First">
									<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scGetAccountDetail.data.getDetails.page.offset.first);scGetAccountDetail.load({})"><span
											aria-hidden="true">&lsaquo;&lsaquo;</span></a>
								</li>
								<li class="page-item" dmx-class:disabled="scGetAccountDetail.data.getDetails.page.current == 1" aria-label="Previous">
									<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scGetAccountDetail.data.getDetails.page.offset.prev);scGetAccountDetail.load({})"><span
											aria-hidden="true">&lsaquo;</span></a>
								</li>
								<li class="page-item" dmx-class:active="title == scGetAccountDetail.data.getDetails.page.current" dmx-class:disabled="!active" dmx-repeat="scGetAccountDetail.data.getDetails.getServerConnectPagination(2,1,'...')">
									<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',(page-1)*scGetAccountDetail.data.getDetails.limit);scGetAccountDetail.load({})">{{title}}</a>
								</li>
								<li class="page-item" dmx-class:disabled="scGetAccountDetail.data.getDetails.page.current ==  scGetAccountDetail.data.getDetails.page.total" aria-label="Next">
									<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scGetAccountDetail.data.getDetails.page.offset.next);scGetAccountDetail.load({})"><span
											aria-hidden="true">&rsaquo;</span></a>
								</li>
								<li class="page-item" dmx-class:disabled="scGetAccountDetail.data.getDetails.page.current ==  scGetAccountDetail.data.getDetails.page.total" aria-label="Last">
									<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scGetAccountDetail.data.getDetails.page.offset.last);scGetAccountDetail.load({})"><span
											aria-hidden="true">&rsaquo;&rsaquo;</span></a>
								</li>
								<!-- <span class="ml-3 pt-2 datatable-pager-detail">Showing {{scGetAccountDetail.data.getDetails.limit}} of {{scGetAccountDetail.data.getDetails.total}}</span> -->
							</ul>
							<div class="d-flex flex-row justify-content-center align-items-center mb-2 mb-md-0 ml-2">
								<p class="mb-0 text-dark font-weight-bold">Page Size:&nbsp;</p>
								<select class="form-control form-control-sm text-primary mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scItemList.load()">
									<option value="15" selected>15</option>
									<option value="30">30</option>
									<option value="50">50</option>
									<option value="75">75</option>
									<option value="100">100</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAccountTransaction" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form action="dmxConnect/api/Master/Account/AccountTransaction.php" is="dmx-serverconnect-form" id="formCreateTransaction" method="post"
				dmx-on:success="modalAccountTransaction.hide();formCreateTransaction.reset();notif.success('Transaction Added!');scGetAccountDetail.load({})">
				<input type="hidden" name="AccountFrom" dmx-bind:value="scGetAccountDetail.data.AccountDetails.AccountID">
				<div class="modal-header">
					<h5 class="modal-title">{{scGetAccountDetail.data.AccountDetails.bank_name}} | {{scGetAccountDetail.data.AccountDetails.account_number}}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Type</label>
								<select name="TransactionType" class="form-control" required>
									<option value="" selected disabled>-Select-</option>
									<option value="Debit">Debit</option>
									<option value="Credit">Credit</option>
								</select>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Date</label>
								<input type="date" class="form-control" name="TransactionDate" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Amount</label>
								<input type="number" placeholder="Enter Amount" class="form-control" name="Amount" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label>Method</label>
								<select name="TransactionMethod" id="TransactionMethod" class="form-control" required dmx-bind:options="scGetAccountDetail.data.TransactionMethod" optiontext="name" optionvalue="id">
									<option value="" disabled>-Select-</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row" dmx-show="TransactionMethod.value == 22 || TransactionMethod.value == 25">
						<div class="col">
							<div class="form-group" dmx-show="TransactionMethod.value == 22">
								<label>Account</label>
								<select dmx-bind:disabled="TransactionMethod.value != 22" name="AccountTo" class="form-control" required dmx-bind:options="scAccountList.data.queryAccountList.where(`type`,24,'!=')"
									optiontext="bank_name + ' ' + account_number" optionvalue="id">
									<option value="" disabled>-Select-</option>
								</select>
							</div>
							<div class="form-group" dmx-show="TransactionMethod.value == 25">
								<label>Credit Card</label>
								<select dmx-bind:disabled="TransactionMethod.value != 25" name="AccountTo" class="form-control" required dmx-bind:options="scAccountList.data.queryAccountList.where(`type`,24,'==')"
									optiontext="bank_name + ' ' + account_number" optionvalue="id">
									<option value="" disabled>-Select-</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label>Transaction Details</label>
								<textarea class="form-control" name="TransactionDetails" rows="1"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>