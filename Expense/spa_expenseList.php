<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_33="cdn" id="ExpenseList" components="{dmxStateManagement:{},dmxBootstrap4Collapse:{},dmxFormatter:{},dmxBootstrap4Tooltips:{},dmxBootstrap4PagingGenerator:{},dmxBootstrap4Modal:{},dmxPreloader:{},dmxBootstrap4Alert:{},dmxDatePicker:{}}" moment_2="cdn" -->
<dmx-value id="varShowGraph" dmx-bind:value="0"></dmx-value>
<dmx-serverconnect id="scGenerateGraph" url="dmxConnect/api/Expense/CurrentMonthGraph.php" onsuccess="CurrentMonthGraph();" noload="noload"></dmx-serverconnect>
<dmx-serverconnect id="scInvoiceItems" url="dmxConnect/api/Expense/getInvoiceItems.php" noload="noload"></dmx-serverconnect>
<dmx-value id="varExpenseID"></dmx-value>
<dmx-datetime id="varDateTime"></dmx-datetime>
<dmx-notifications id="notifies1" offset-x="30" offset-y="30" closable newest-on-top></dmx-notifications>
<dmx-query-manager id="qm"></dmx-query-manager>
<dmx-serverconnect id="scExpenseList" noload="noload" url="dmxConnect/api/Expense/ExpenseList.php" dmx-param:categoryid="collapse1.FilterCategory.value" dmx-param:itemid="collapse1.FilterItem.value" dmx-param:offset="query.offset"
	dmx-param:limit="varPageValue.value ? varPageValue.value : 10" dmx-param:currentmonth="collapse1.ThisMonth.checked" dmx-param:crstartdate="varStartDate.value" dmx-param:crenddate="varEndDate.value" dmx-param:date="collapse1.date.value"
	dmx-on:success="scGenerateGraph.load({date: varDateTime.datetime.formatDate('y-MM')})" dmx-param:startdate="collapse1.DateRange.start.toDate()" dmx-param:enddate="collapse1.DateRange.end.toDate()">
</dmx-serverconnect>
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-2">
			<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Expense List</h5>
		</div>
		<div class="d-flex align-items-center">
			<!-- <input type="month" id="Month" class="form-control w-150px  mr-1 form-control-sm " name="Month" dmx-on:changed="scGenerateGraph.load({date: value})"> -->
			<a href="./expense/create" class="btn btn-icon btn-primary   mr-2">
				<i class="flaticon-plus"></i>
			</a>
			<a href="#" class="btn btn-icon btn-primary    mr-2" dmx-on:click="collapseGraph.toggle()">
				<i class="flaticon-diagram"></i>
			</a>
			<a href="#" class="btn btn-icon btn-primary    mr-2" dmx-on:click="collapse1.toggle()">
				<i class="flaticon-interface-6"></i>
			</a>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="card card-custom collapse p-3 show mb-3" id="collapse1" is="dmx-bs4-collapse">
		<div class="row">
			<div class="col-lg-3 col-sm-3 form-group">
				<select class="form-control" id="FilterCategory" name="FilterCategory" dmx-bind:options="scCategories.data.getCategories" optiontext="category_name" optionvalue="id" style="width: 100% !important;"
					dmx-on:changed="scItemLists.load({categoryid: value})">
					<option value="" selected>Select Category</option>
				</select>
			</div>
			<div class="col-lg-3 col-sm-3 form-group">
				<select class="form-control" id="FilterItem" name="FilterItem" style="width: 100% !important;" dmx-bind:options="scItemLists.data.getItems" optiontext="subcategory_name" optionvalue="id">
					<option value="" selected>Select Item</option>
				</select>
			</div>
			<div class="col-lg-2 col-sm-3 form-group">
				<input type="date" class="form-control" placeholder="Date" id="date" name="date">
			</div>
			<div class="col-lg-2 col-sm-3 form-group">
				<input type="text" class="form-control" placeholder="Date Range" name="DateRange" id="DateRange" name="date" is="dmx-date-range-picker">
			</div>
			<div class="col-lg-2 col-sm-3 mt-3">
				<div class="custom-control custom-checkbox">
					<label class="checkbox checkbox-outline checkbox-success">
						<input type="checkbox" checked name="ThisMonth" value="1" />This Month&nbsp;
						<span></span>
					</label>
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-2">
			<button class="btn  btn-primary   mr-2 mr-2" dmx-on:click="FilterCategory.setValue('');FilterItem.setValue('');date.setValue('');scExpenseList.load({offset: 0});" data-toggle="collapse" data-target="#collapse1">Clear</button>
			<button class="btn  btn-primary   mr-2" dmx-on:click="scExpenseList.load({offset: 0})" data-toggle="collapse" data-target="#collapse1">Search</button>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div id="collapseGraph" class="mb-3" is="dmx-bs4-collapse">
		<div class="chart-demo">
			<div class="card card-custom overflow-hidden shadow-sm">
				<div class="cad-body p-3">
					<div id="expense_monthly" class="apex-charts"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- <ul class="list-group" is="dmx-repeat" id="repeat2" dmx-bind:repeat="scExpenseList.data.queryExpenseList.data.sort(invoice_number)">
			<div class="align-items-center bg-white d-flex mb-2 p-5 rounded shadow-lg">
				<div class="d-flex flex-column flex-grow-1 mr-2">
					<a href="#" class="font-weight-bolder text-dark-75 text-hover-primary font-size-lg mb-1">{{ItemName}}</a>
					<span class="font-weight-bold text-dark-50">Invoice: {{invoice_number}} | Quantity: {{quantity + ' ' + Unit}} | Type: {{PaymentType}} | Date: {{purchase_date.formatDate("dd MMM yy")}}</span>
				</div>
				<span class="font-weight-bolder py-1 font-size-lg text-right">{{amount.toNumber().formatCurrency("₹", ".", ",", "2")}}&nbsp;
					<a href="#" class="btn btn-hover-light-primary  btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="ki ki-bold-more-hor"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
						
						<ul class="navi">
							<li class="navi-item">
								<a href="#" class="navi-link">
									<span class="navi-icon">
										<i class="flaticon2-shopping-cart-1"></i>
									</span>
									<span class="navi-text">Order</span>
								</a>
							</li>
							<li class="navi-item">
								<a href="#" class="navi-link">
									<span class="navi-icon">
										<i class="navi-icon flaticon2-calendar-8"></i>
									</span>
									<span class="navi-text">Members</span>
									<span class="navi-label">
										<span class="label label-light-danger label-rounded font-weight-bold">3</span>
									</span>
								</a>
							</li>
						</ul>
						
					</div>
				</span>
			</div>
		</ul> -->
	<div class="card card-custom card-stretch gutter-b">
		<div class="card-body mt-n3">
			<div class="table-responsive">
				<table class="table ">
					<thead class="bg-dark-o-20">
						<tr>
							<th>INVOICE</th>
							<th>ITEM</th>
							<th>AMOUNT</th>
							<th>QUANTITY</th>
							<th>DATE</th>
							<th>REMARK</th>
							<th>ACTION</th>
						</tr>
					</thead>
					<tbody is="dmx-repeat" id="repeatExpenseList" dmx-bind:repeat="scExpenseList.data.queryExpenseList.data.sort(invoice_number)" key="Expense_ID">
						<tr>
							<td>
								<div class="symbol symbol-40 symbol-light">
									<span class="symbol-label">
										<a href="javascript:void(0)" class="mouse-pointer font-weight-bolder" dmx-on:click="scInvoiceItems.load({invoiceid: invoice_number});ModalInvoice.show()">{{invoice_number}}</a>
									</span>
								</div>
							</td>
							<td class="text-truncate">
								<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ItemName}}</a>
								<div>
									<a class="text-muted font-weight-bold text-hover-primary" href="#">{{category_name}}</a>
								</div>
							</td>
							<td class="text-truncate">
								<span class="text-info font-weight-bolder d-block font-size-lg">{{amount.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</span>
								<span class="text-muted font-weight-bold">{{PaymentType}}</span>
							</td>
							<td class="text-truncate">
								<span class="font-weight-500">{{quantity + ' ' + Unit}}</span>
							</td>
							<td class="text-truncate">
								<span class="font-weight-500">{{purchase_date.formatDate("dd MMM yy")}}</span>
							</td>
							<td class="text-truncate">
								<span class="font-weight-500" dmx-bs-tooltip="remark">{{remark.trunc(15, true, "...")}}</span>
							</td>
							<td class="text-truncate">
								<a href="#" class="btn btn-icon btn-light   mouse-pointer" href="javascript:void(0)" data-toggle="modal" data-target="#modal_update_expense" dmx-on:click="varExpenseID.setValue(Expense_ID)">
									<span class="svg-icon svg-icon-md svg-icon-primary">
										<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<path
													d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
													fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
												<path
													d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
													fill="#000000" fill-rule="nonzero" opacity="0.3" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</a>
								<a href="#" class="btn btn-icon btn-light   mouse-pointer" href="javascript:void(0)" data-toggle="modal" data-target="#modalReceipt" dmx-on:click="varExpenseID.setValue(Expense_ID)" dmx-show="receipt_name">
									<span class="svg-icon svg-icon-md svg-icon-primary">
										<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
										<span class="svg-icon svg-icon-md svg-icon-primary">
											<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/Settings-1.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path
														d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
														fill="#000000" />
													<path
														d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
														fill="#000000" opacity="0.3" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
										<!--end::Svg Icon-->
									</span>
								</a>
							</td>
							<!-- <td><a href="javascript:void(0)" class="mouse-pointer" dmx-on:click="scInvoiceItems.load({invoiceid: invoice_number});ModalInvoice.show()">{{invoice_number}}</a></td>
								<td class="text-truncate font-weight-bolder">{{ItemName}}</td>
								<td class="font-weight-bolder mt-3 text-truncate">{{amount.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</td>
								<td class="text-truncate">{{quantity + ' ' + Unit}}</td>
								<td class="text-truncate">{{purchase_date.formatDate("dd MMM yy")}}</td>
								<td class="text-truncate">{{PaymentType}}</td>
								<td class="text-truncate" dmx-bs-tooltip="remark">{{remark.trunc(15, true, "...")}}</td>
								<td class="text-truncate">
									<button class="btn  btn-clean btn-icon mr-2" data-toggle="modal" data-target="#modal_update_expense" dmx-on:click="varExpenseID.setValue(Expense_ID)">
										<i class="fa fa-pencil-square-o"></i>
									</button>
									<button class="btn  btn-clean btn-icon mr-2" data-toggle="modal" data-target="#modalReceipt" dmx-on:click="varExpenseID.setValue(Expense_ID)" dmx-show="receipt_name">
										<i class="fa fa-paperclip"></i>
									</button>
								</td> -->
						</tr>
					</tbody>
					<tbody dmx-hide="scExpenseList.data.queryExpenseList.data.hasItems()">
						<tr>
							<td colspan="8">
								<h4 class="text-center text-muted font-weight-bolder">No expense found this month!</h4>
							</td>
						</tr>
					</tbody>
					<tr class="bg-light-primary">
						<td colspan="2">
							<h5 class="font-weight-bolder">Total</h5>
						</td>
						<td class="text-truncate">
							<h5 class="font-weight-bolder">{{scExpenseList.data.TotalAmount.TotalAmount.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</h5>
						</td>
						<td colspan="5"></td>
					</tr>
				</table>
				<div class="d-flex flex-row justify-content-md-center align-items-center my-3">
					<ul class="pagination justify-content-center pagination-lg" dmx-populate="scExpenseList.data.queryExpenseList" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
						<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current == 1" aria-label="First">
							<a href="javascript:void(0)" class="page-link btn btn-icon  mr-2 my-1" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.first);scExpenseList.load()"><span
									aria-hidden="true">&lsaquo;&lsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current == 1" aria-label="Previous">
							<a href="javascript:void(0)" class="page-link btn btn-icon  mr-2 my-1" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.prev);scExpenseList.load()"><span aria-hidden="true">&lsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:active="title == scExpenseList.data.queryExpenseList.page.current" dmx-class:disabled="!active" dmx-repeat="scExpenseList.data.queryExpenseList.getServerConnectPagination(2,1,'...')">
							<a href="javascript:void(0)" class="page-link btn btn-icon  mr-2 my-1" dmx-on:click="qm.set('offset',(page-1)*scExpenseList.data.queryExpenseList.limit);scExpenseList.load()">{{title}}</a>
						</li>
						<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current ==  scExpenseList.data.queryExpenseList.page.total" aria-label="Next">
							<a href="javascript:void(0)" class="page-link btn btn-icon mr-2 my-1" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.next);scExpenseList.load()"><span aria-hidden="true">&rsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:disabled="scExpenseList.data.queryExpenseList.page.current ==  scExpenseList.data.queryExpenseList.page.total" aria-label="Last">
							<a href="javascript:void(0)" class="page-link btn btn-icon  mr-2 my-1" dmx-on:click="qm.set('offset',scExpenseList.data.queryExpenseList.page.offset.last);scExpenseList.load()"><span
									aria-hidden="true">&rsaquo;&rsaquo;</span></a>
						</li>
					</ul>
					<div class="col-8 col-md-auto">
						<div class="d-flex flex-row justify-content-center align-items-center mb-2 mb-md-0">
							<p class="mb-0 text-dark font-weight-bold">Page Size:&nbsp;</p>
							<select class="form-control form-control-sm mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scExpenseList.load()">
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
	<!-- <dmx-chart id="chart1" legend="bottom" dmx-bind:data="scExpenseList.data.groupByDateCurrentMonth" labels="purchase_date" dataset-1:value="totalamount" dataset-1:label="Amount" points point-style="line" smooth thickness="4" width="1300"
			height="300" responsive point-size="" cutout="" colors="colors5">
		</dmx-chart> -->
</div>

<div class="modal fade" id="modal_update_expense" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick>
	<div class="modal-dialog modal-xl" role="document">
		<form is="dmx-serverconnect-form" id="FormUpdateExpense" method="post" action="dmxConnect/api/Expense/updateExpense.php"
			dmx-on:success="modal_update_expense.hide();modal_update_expense.FormUpdateExpense.reset();varExpenseID.setValue('');notifies1.success(&quot;Expense Updated&quot;);scExpenseList.load()">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Update Expense</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="ExpenseID" dmx-bind:value="varExpenseID.value">
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Invoice No:</label>
								<input type="number" name="invoice_number" dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`invoice_number`)"
									class="form-control form-control-solid" />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Invoice Name:</label>
								<input type="text" name="invoice_name" class="form-control form-control-solid" placeholder="Invoice Name"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`invoice_name`)" />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Date:</label>
								<input type="date" name="purchase_date" class="form-control form-control-solid" placeholder="Purchase Date"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`purchase_date`)" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Account</label>
								<select class="form-control" name="account" dmx-bind:options="scAccountList.data.queryAccountList" optiontext="bank_name + ' ' + account_number" optionvalue="id"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`account`)">
									<option selected disabled value="">Account</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Payment Type:</label>
								<select class="form-control" name="payment_type" dmx-bind:options="scPaymentMethods.data.queryPaymentMethods" optiontext="PaymentType" optionvalue="PaymentID"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`payment_type`)">
									<option selected disabled value="">Payment Method</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Remark:</label>
								<input type="text" name="remark" class="form-control form-control-solid" placeholder="Enter full name"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`remark`)" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label>Item:</label>
								<select class="form-control" name="category_id" style="width: 100% !important;" dmx-bind:options="scItemLists.data.getItems" optiontext="subcategory_name" optionvalue="id"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`category_id`)">
									<option value="" selected>Select Item</option>
								</select>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Quantity:</label>
								<input type="number" value="1" name="quantity" class="form-control form-control-solid" placeholder="Quantity"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`quantity`)" />
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label>Unit:</label>
								<select class="form-control" name="unit" style="width: 100% !important;" dmx-bind:options="scUnits.data.queryUnits" optiontext="UnitName" optionvalue="UnitID"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`unitid`)">
									<option value="" selected>Select Item</option>
								</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group">
								<label>Amount:</label>
								<input type="number" name="amount" class="form-control form-control-solid" placeholder="Amount"
									dmx-bind:value="scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`amount`)" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Upload Receipt</label>
								<input is="dmx-dropzone" id="targetFile" type="file" name="target_photo" thumbs="false" data-msg-required="">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">Save changes <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modalReceipt" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">ExpenseID # {{varExpenseID.value}} | </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p><img class="w-100" dmx-bind:src="assets/uploads/{{scExpenseList.data.queryExpenseList.data.where(`Expense_ID`, varExpenseID.value, &quot;==&quot;).values(`receipt_name`)}}"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalInvoice" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
	<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<!--begin::Invoice-->
				<div class="row justify-content-center px-md-0">
					<div class="col-md-12">
						<!-- begin: Invoice header-->
						<div class="d-flex justify-content-between flex-column border-bottom">
							<h1 class="display-4 font-weight-boldest">INVOICE #{{scInvoiceItems.data.queryInvoiceItems[0].invoice_number}}<button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button></h1>

						</div>
						<!--begin: Invoice body-->
						<div class="row border-bottom ">
							<div class="col-md-10 py-md-10 pr-md-10">
								<div class="table-responsive">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th>ITEM</th>
												<th>AMOUNT</th>
												<th>QUANTITY</th>
												<th>DATE</th>
												<th>PAYMENT</th>
												<th>REMARK</th>
											</tr>
										</thead>
										<tbody is="dmx-repeat" id="repeatInvoiceItems" dmx-bind:repeat="scInvoiceItems.data.queryInvoiceItems">
											<tr>
												<td class="text-truncate font-weight-bolder">{{ItemName}}</td>
												<td class="font-weight-bolder mt-3 text-truncate">{{amount.toNumber().formatCurrency("₹", ".", ",", "2")}}</td>
												<td class="text-truncate">{{quantity + ' ' + Unit}}</td>
												<td class="text-truncate">{{purchase_date.formatDate("dd MMM yy")}}</td>
												<td class="text-truncate">{{PaymentType}}</td>
												<td class="text-truncate" dmx-bs-tooltip="remark">{{remark.trunc(15, true, "...")}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-2 border-left-md pl-md-10 py-md-10 text-center">
								<!--begin::Total Amount-->
								<div class="font-size-h4 font-weight-bolder text-muted mb-3">TOTAL</div>
								<div class="font-size-h1 font-weight-boldest">₹ {{scInvoiceItems.data.queryInvoiceItems.sum(`amount`)}}</div>
							</div>
						</div>
						<!--end: Invoice body-->
					</div>
				</div>
			</div>

		</div>
	</div>
</div>