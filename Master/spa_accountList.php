<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="AccountList" components="{dmxBootstrap4TableGenerator:{},dmxStateManagement:{},dmxBootstrap4PagingGenerator:{},dmxBootstrap4Modal:{},dmxNotifications:{}}" -->

<dmx-serverconnect id="scGetAccountList" url="dmxConnect/api/Master/Account/AccountList.php" noload></dmx-serverconnect>
<dmx-query-manager id="qm"></dmx-query-manager>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-2">
			<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Account List</h5>
		</div>
		<div class="d-flex align-items-center">
			<a href="javascript:void(0)" class="btn btn-icon btn-primary mr-2">
				<i class="flaticon-plus"></i>
			</a>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="card card-custom card-stretch gutter-b w-100">
			<div class="card-body mt-n3">
				<div class="table-responsive">
					<table class="table table-striped table-hover font-weight-bolder">
						<thead class="text-uppercase">
							<tr>
								<th width="5%">#</th>
								<th>Owner</th>
								<th>Bank</th>
								<th>Account</th>
								<th>A/C No</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody is="dmx-repeat" id="repeatAccounts" dmx-bind:repeat="scGetAccountList.data.getList.data">
							<tr>
								<td>{{$index + qm.data.offset.toNumber() + 1}}</td>
								<td>{{FirstName+' '+LastName}}</td>
								<td>{{BankName}}</td>
								<td>{{AccountType}}</td>
								<td>{{AccountNumber}}</td>
								<td>
									<a href="#" class="btn btn-icon btn-light   mouse-pointer" dmx-bind:href="./account/details/{{AccountID}}" data-toggle="modal" data-target="#modal_update_expense" dmx-on:click="varExpenseID.setValue(Expense_ID)">
										<span class="svg-icon svg-icon-primary svg-icon-2x">
											<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2020-09-15-014444/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Arrow-from-left.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http
												://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-90.000000) translate(-14.000000, -12.000000) " x="13" y="5" width="2" height="14" rx="1" />
													<rect fill="#000000" opacity="0.3" x="3" y="3" width="2" height="18" rx="1" />
													<path
														d="M11.7071032,15.7071045 C11.3165789,16.0976288 10.6834139,16.0976288 10.2928896,15.7071045 C9.90236532,15.3165802 9.90236532,14.6834152 10.2928896,14.2928909 L16.2928896,8.29289093 C16.6714686,7.914312 17.281055,7.90106637 17.675721,8.26284357 L23.675721,13.7628436 C24.08284,14.136036 24.1103429,14.7686034 23.7371505,15.1757223 C23.3639581,15.5828413 22.7313908,15.6103443 22.3242718,15.2371519 L17.0300721,10.3841355 L11.7071032,15.7071045 Z"
														fill="#000000" fill-rule="nonzero" transform="translate(16.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-16.999999, -11.999997) " />
												</g>
											</svg>
										</span>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="d-flex flex-row justify-content-md-center align-items-center my-3">
						<ul class="pagination justify-content-center pagination-lg" dmx-populate="scGetAccountList.data.getList" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
							<!-- <select class="form-control form-control-sm text-primary bg-light-light mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scItemList.load()">
								<option value="10" selected>10</option>
								<option value="30">30</option>
								<option value="50">50</option>
								<option value="75">75</option>
								<option value="100">100</option>
							</select> -->
							<li class="page-item" dmx-class:disabled="scGetAccountList.data.getList.page.current == 1" aria-label="First">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scGetAccountList.data.getList.page.offset.first);scGetAccountList.load()"><span
										aria-hidden="true">&lsaquo;&lsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:disabled="scGetAccountList.data.getList.page.current == 1" aria-label="Previous">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scGetAccountList.data.getList.page.offset.prev);scGetAccountList.load()"><span
										aria-hidden="true">&lsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:active="title == scGetAccountList.data.getList.page.current" dmx-class:disabled="!active" dmx-repeat="scGetAccountList.data.getList.getServerConnectPagination(2,1,'...')">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',(page-1)*scGetAccountList.data.getList.limit);scGetAccountList.load()">{{title}}</a>
							</li>
							<li class="page-item" dmx-class:disabled="scGetAccountList.data.getList.page.current ==  scGetAccountList.data.getList.page.total" aria-label="Next">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scGetAccountList.data.getList.page.offset.next);scGetAccountList.load()"><span
										aria-hidden="true">&rsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:disabled="scGetAccountList.data.getList.page.current ==  scGetAccountList.data.getList.page.total" aria-label="Last">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scGetAccountList.data.getList.page.offset.last);scGetAccountList.load()"><span
										aria-hidden="true">&rsaquo;&rsaquo;</span></a>
							</li>
							<!-- <span class="ml-3 pt-2 datatable-pager-detail">Showing {{scGetAccountList.data.getList.limit}} of {{scGetAccountList.data.getList.total}}</span> -->
						</ul>
						<div class="d-flex flex-row justify-content-center align-items-center mb-2 mb-md-0 ml-2">
							<p class="mb-0 text-dark font-weight-bold">Page Size:&nbsp;</p>
							<select class="form-control form-control-sm text-primary mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scItemList.load()">
								<option value="10" selected>10</option>
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