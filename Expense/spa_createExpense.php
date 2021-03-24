<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_4="cdn" jquery_slim_34="local" id="CreateExpense" components="{dmxFormatter:{},dmxNotifications:{},dmxBootstrap4Toasts:{},dmxAutocomplete:{},dmxDropzone:{},dmxBootstrap5Modal:{}}" bootstrap4="local" -->

<dmx-serverconnect id="scInvoiceItems" url="dmxConnect/api/Expense/getInvoiceItems.php" noload="noload"></dmx-serverconnect>
<dmx-value id="varCategoryID"></dmx-value>
<dmx-serverconnect id="scInvoiceID" url="dmxConnect/api/Expense/getMaxInvoiceID.php" noload="noload"></dmx-serverconnect>
<dmx-datetime id="varDateTime"></dmx-datetime>
<dmx-notifications id="notifies1" offset-x="30" offset-y="30" closable newest-on-top></dmx-notifications>
<dmx-value id="varCounter" dmx-bind:value="1"></dmx-value>
<dmx-value id="varRemark" dmx-bind:value="0"></dmx-value>
<dmx-value id="varInvoiceName" dmx-bind:value="0"></dmx-value>
<dmx-value id="varAttachment" dmx-bind:value="0"></dmx-value>
<dmx-serverconnect id="scExpenseList" url="dmxConnect/api/Expense/ExpenseList.php" dmx-param:offset="query.offset" dmx-param:limit="10" dmx-param:currentmonth="0" dmx-param:date="" dmx-param:newexpense="1">
</dmx-serverconnect>
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap me-2">
			<!--begin::Page Title-->
			<h3 class="text-dark fw-bold mt-2 mb-2 me-5">New Expense</h3>
		</div>
		<div class="d-flex align-items-center">
			<a href="./expense/list" class="btn btn-primary mr-2">
				<i class="flaticon-list"></i> Expense List
			</a>
			<button class="btn btn-primary" dmx-on:click="varCategoryID.setValue(repeatItem.CategoryID.value);modalAddItem.show()"><i class="flaticon-plus"></i> Add Item</button>
		</div>
	</div>
</div>

<div class="container-fluid">
	<form class="form" method="post" is="dmx-serverconnect-form" id="CreateExpense" action="dmxConnect/api/Expense/createExpense.php"
		dmx-on:success="CreateExpense.reset();scGetExpense.load();varCounter.setValue(1);scInvoiceID.load();notifies1.success(&quot;Expense Created Succesfully&quot;);scExpenseList.load()">
		<div class="card card-custom card-stretch gutter-b mb-2 ">
			<div class="card-body border-dark-75 rounded pb-0">
				<div class="row mb-2 py-1 row rounded p-2">
				
					<div class="col-lg-3 col-6 pl-2">
						<div class="mb-3">
							<label class="form-label">Invoice</label>
							<input type="number" step="0.1" name="InvoiceNumber" dmx-bind:value="scInvoiceID.data.getMaxInvoiceID.InvoiceID+1" class="form-control form-control-sm" />
						</div>
					</div>
					<div class="col-lg-3 col-6">
						<div class="mb-3">
							<label class="form-label">Date:</label>
							<input type="date" name="PurchaseDate" class="form-control form-control-sm" placeholder="Purchase Date" dmx-bind:value="varDateTime.datetime.formatDate(&quot;yyyy-MM-dd&quot;)" />
						</div>
					</div>
					<div class="col-lg-3 col-6 pl-2">
						<div class="mb-3">
							<label class="form-label">Account</label>
							<select class="form-control form-control-sm" name="AccountID" id="AccountID" dmx-bind:options="scAccountList.data.queryAccountList" optiontext="bank_name + ' ' + account_number" optionvalue="id" value="2">
								<option selected disabled value="">Account</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3 col-6" dmx-hide="AccountID.value == 2">
						<div class="mb-3">
							<label class="form-label">Payment Type:</label>
							<select class="form-control form-control-sm" name="PaymentMethod" dmx-bind:options="scPaymentMethods.data.queryPaymentMethods" optiontext="PaymentType" optionvalue="PaymentID" value="6">
								<option selected disabled value="">Payment Method</option>
							</select>
						</div>
					</div>
				</div>
				<div class="d-flex">
					<div class="border rounded-lg table-responsive  bg-light-o-25">
						<table class="table table-head-custom table-vertical-center mb-0 table-borderless">
							<thead class="bg-primary-o-15 border-bottom">
								<tr>
									<th>#</th>
									<th class="text-truncate">New Item</th>
									<th class="text-truncate">Search Item</th>
									<th class="text-truncate">Quantity</th>
									<th class="text-truncate">Unit</th>
									<th class="text-truncate">Amount</th>
									<th class="text-truncate">+/-</th>
								</tr>
							</thead>
							<tbody is="dmx-repeat" id="repeatItems" dmx-bind:repeat="varCounter.value" >
								<td>{{$index + 1}}</td>
								<td class="text-truncate"><input type="text" class="form-control form-control-sm" autocomplete="off" name="NewItem[]"></td>
								<td class="text-truncate"><input class="form-control form-control-sm" name="ItemID[]" is="dmx-autocomplete" dmx-bind:data="scItemLists.data.getItems" optiontext="subcategory_name" optionvalue="id"></td>
								<td class="text-truncate"><input type="number" value="1" step="0.1" id="Quantity" name="Quantity[]" class="form-control form-control-sm" placeholder="Quantity" /></td>
								<td class="text-truncate"><select class="form-control form-control-sm" name="UnitID[]" style="width: 100% !important;" dmx-bind:options="scUnits.data.queryUnits" optiontext="UnitName" optionvalue="UnitID"
										dmx-bind:value="scItemLists.data.getItems.where(`id`,ItemID.value,'==').values(`default_unit`)">
										<option value="" selected disabled>Select</option>
									</select></td>
								<td class="text-truncate"><input type="number" id="Price" dmx-bind:value="scItemLists.data.getItems.where(`id`,ItemID.value,'==').values(`default_price`) * Quantity.value" step="0.1" name="Amount[]" class="form-control form-control-sm" placeholder="Amount" />
								</td>
								<td class="text-truncate">
									<button class="btn btn-icon btn-sm btn-light-primary me-2 fw-500" dmx-on:click="varCounter.setValue(varCounter.value + 1)">
										<i class="fa fa-plus"></i>
									</button>
									<button class="btn btn-icon btn-light-danger btn-sm  me-2  fw-500" dmx-show="varCounter.value != 1" dmx-on:click="varCounter.setValue(varCounter.value - 1)">
										<i class="fa fa-minus"></i>
									</button>
								</td>
							</tbody>
							<tr class="bg-primary-o-15">
								<td colspan="5" class="text-right">Total: </td>
								<td class="text-right font-weight-bold">{{repeatItems.items.sum(`Price.value`).formatCurrency("₹ ", ".", ",", "2")}}</td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="row mb-2 py-1 mt-5 row rounded p-2">
					<div class="col-lg-6 col-12" dmx-show="varInvoiceName.value">
						<div class="mb-3">
							<label class="form-label">Invoice Name:</label>
							<input type="text" name="InvoiceName" class="form-control form-control-sm" placeholder="Invoice Name" />
						</div>
					</div>
					<div class="col-lg-6 col-8" dmx-show="varRemark.value">
						<div class="mb-3">
							<label class="form-label">Remark:</label>
							<textarea name="Remark" rows="1" class="form-control form-control-sm" placeholder="Enter full name"></textarea>
						</div>
					</div>
				</div>
				<div class="row mb-2 py-1 row rounded p-2" dmx-show="varAttachment.value">
					<div class="mb-3 col">
						<label class="form-label">Receipt</label>
						<input is="dmx-dropzone" id="targetFile" type="file" name="target_photo">
					</div>
				</div>
				<div class="d-flex mb-3 align-items-center justify-content-between" >
				<div class="flex-column">
				<span class="font-weight-bold mr-3">Add More Options: </span>
					<button class="btn btn-light-primary font-weight-bold mr-3 btn-sm rounded-3" dmx-on:click="varInvoiceName.value ? varInvoiceName.setValue(0) : varInvoiceName.setValue(1)"><i class="flaticon-plus"></i> Invoice Name</button>
					<button class="btn btn-light-success font-weight-bold mr-3 btn-sm rounded-3" dmx-on:click="varRemark.value ? varRemark.setValue(0) : varRemark.setValue(1)"><i class="flaticon-plus"></i> Remark</button>
					<button class="btn btn-light-warning font-weight-bold mr-3 btn-sm rounded-3" dmx-on:click="varAttachment.value ? varAttachment.setValue(0) : varAttachment.setValue(1)"><i class="flaticon-plus"></i> Attachment</button></div>
				<div class="flex-column">
				<button type="submit" class="btn btn-primary me-2 btn-lg fw-500" dmx-bind:disabled="state.executing">SUBMIT <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
			</button>
			</div>
					
					
				</div>
			</div>
		</div>
	</form>
	<div class="card card-custom card-stretch gutter-b mt-5">
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
						</tr>
					</thead>
					<tbody is="dmx-repeat" id="repeatExpenseList" dmx-bind:repeat="scExpenseList.data.queryExpenseList.data.sort(invoice_number)" key="Expense_ID">
						<tr>
							<td>
								<div class="symbol symbol-40 symbol-light">
									<span class="symbol-label">
										<a href="javascript:void(0)" class="mouse-pointer fw-bolder" dmx-on:click="scInvoiceItems.load({invoiceid: invoice_number});ModalInvoice.show()">{{invoice_number}}</a>
									</span>
								</div>
							</td>
							<td class="text-truncate">
								<a href="#" class="text-dark-75 fw-bolder text-hover-primary mb-1 font-size-lg">{{ItemName}}</a>
								<div>
									<a class="text-muted fw-bold text-hover-primary" href="#">{{category_name}}</a>
								</div>
							</td>
							<td class="text-truncate">
								<span class="text-info fw-bolder d-block font-size-lg">{{amount.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</span>
								<span class="text-muted fw-bold">{{PaymentType}}</span>
							</td>
							<td class="text-truncate">
								<span class="fw-500">{{quantity + ' ' + Unit}}</span>
							</td>
							<td class="text-truncate">
								<span class="fw-500">{{purchase_date.formatDate("dd MMM yy")}}</span>
							</td>
							<td class="text-truncate">
								<span class="fw-500" dmx-bs-tooltip="remark">{{remark.trunc(15, true, "...")}}</span>
							</td>
						</tr>
					</tbody>
					<tbody dmx-hide="scExpenseList.data.queryExpenseList.data.hasItems()">
						<tr>
							<td colspan="8">
								<h4 class="text-center text-muted fw-bolder">No expense found this month!</h4>
							</td>
						</tr>
					</tbody>
					<tr class="bg-light-primary">
						<td colspan="2">
							<h5 class="fw-bolder">Total</h5>
						</td>
						<td class="text-truncate">
							<h5 class="fw-bolder">{{scExpenseList.data.TotalAmount.TotalAmount.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</h5>
						</td>
						<td colspan="5"></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAddItem" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form is="dmx-serverconnect-form" id="FormAddItem" action="dmxConnect/api/Master/createItem.php" method="post"
				dmx-on:success="notifies1.success('Item added succesfully');scItemLists.load({categoryid: varCategoryID.value});modalAddItem.hide();modalAddItem.FormAddItem.reset();varCategoryID.setValue('')">
				<div class="modal-header">
					<h5 class="modal-title">Add Item</h5>
					<button class="btn-close" aria-label="Close" data-dismiss="modal" dmx-on:click="modalAddItem.hide()">
						<span aria-hidden="true" class="visually-hidden">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Category:</label>
						<select class="form-control form-control-sm" name="category_id" dmx-bind:options="scCategories.data.getCategories" optiontext="category_name" optionvalue="id"
							dmx-bind:value="scCategories.data.getCategories.where(`id`, varCategoryID.value, '==').values(`id`)">
							<option selected disabled value="">Categories</option>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Item:</label>
						<input type="text" name="subcategory_name" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" dmx-on:click="varCategoryID.setValue('')" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">Save changes <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
					</button>
				</div>
			</form>
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
							<h1 class="display-4 fw-boldest">INVOICE #{{scInvoiceItems.data.queryInvoiceItems[0].invoice_number}}<button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button></h1>

						</div>
						<!--begin: Invoice body-->
						<div class="row border-bottom ">
							<div class="col-md-10 py-md-10 pe-md-10">
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
												<td class="text-truncate fw-bolder">{{ItemName}}</td>
												<td class="fw-bolder mt-3 text-truncate">{{amount.toNumber().formatCurrency("₹", ".", ",", "2")}}</td>
												<td class="text-truncate">{{quantity + ' ' + Unit}}</td>
												<td class="text-truncate">{{purchase_date.formatDate("dd MMM yy")}}</td>
												<td class="text-truncate">{{PaymentType}}</td>
												<td class="text-truncate" dmx-bs-tooltip="remark">{{remark.trunc(15, true, "...")}}</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-2 border-left-md ps-md-10 py-md-10 text-center">
								<!--begin::Total Amount-->
								<div class="font-size-h4 fw-bolder text-muted mb-3">TOTAL</div>
								<div class="font-size-h1 fw-boldest">₹ {{scInvoiceItems.data.queryInvoiceItems.sum(`amount`)}}</div>
							</div>
						</div>
						<!--end: Invoice body-->
					</div>
				</div>
			</div>

		</div>
	</div>
</div>