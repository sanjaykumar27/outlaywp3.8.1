<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="Items" components="{dmxBootstrap4TableGenerator:{},dmxStateManagement:{},dmxBootstrap4PagingGenerator:{},dmxBootstrap4Modal:{},dmxNotifications:{}}" -->
<dmx-value id="varItemName"></dmx-value>
<dmx-value id="varCategoryID"></dmx-value>
<dmx-value id="varID"></dmx-value>

<dmx-notifications id="notifies1"></dmx-notifications>

<dmx-query-manager id="qm"></dmx-query-manager>
<dmx-serverconnect id="scItemList" url="dmxConnect/api/Master/getItemList.php" noload="noload" dmx-param:limit="varPageValue.value ? varPageValue.value : 10" dmx-param:offset="query.offset" dmx-param:sort="" dmx-param:dir=""></dmx-serverconnect>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-2">
			<!--begin::Page Title-->
			<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">All Items</h5>
		</div>
		<!--end::Info-->
		<!--begin::Toolbar-->
		<div class="d-flex align-items-center">
			<button class="btn btn-primary font-weight-bold " data-toggle="modal" data-target="#modalCreateCategory">
				<i class="flaticon-plus"></i>
				Add Category
			</button>
		</div>
		<!--end::Toolbar-->
	</div>
</div>


<div class="container-fluid">
	<div class="row">
		<div class="card card-custom card-stretch gutter-b">
			<div class="card-body mt-n3">
				<div class="table-responsive">
					<table class="table table-striped table-hover font-weight-bold">
						<thead class="text-uppercase">
							<tr>
								<th>#</th>
								<th>Category</th>
								<th>Items</th>
							</tr>
						</thead>
						<tbody is="dmx-repeat" dmx-generator="bs4table" dmx-bind:repeat="scItemList.data.repeatCategories" id="repeatCategories">
							<tr>
								<td>{{$index + qm.data.offset.toNumber() + 1}}</td>
								<td class="text-truncate">{{CategoryName}} ({{CategoryID}})</td>
								<td>
									<span dmx-on:click="varItemName.setValue(ItemName);varID.setValue(ItemID);varCategoryID.setValue(category_id);modalUpdateCategory.show()" class="mr-2 my-1 badge custom-pill mouse-pointer"
										dmx-repeat:repeat1="queryItems">
										{{ItemName}}
									</span>
								</td>
							</tr>

						</tbody>
					</table>
					<div class="d-flex flex-row justify-content-md-center align-items-center my-3">
						<ul class="pagination justify-content-center pagination-lg" dmx-populate="scItemList.data.getCategories" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
							<!-- <select class="form-control form-control-sm text-primary bg-light-light mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scItemList.load()">
								<option value="10" selected>10</option>
								<option value="30">30</option>
								<option value="50">50</option>
								<option value="75">75</option>
								<option value="100">100</option>
							</select> -->
							<li class="page-item" dmx-class:disabled="scItemList.data.getCategories.page.current == 1" aria-label="First">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scItemList.data.getCategories.page.offset.first);scItemList.load()"><span
										aria-hidden="true">&lsaquo;&lsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:disabled="scItemList.data.getCategories.page.current == 1" aria-label="Previous">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scItemList.data.getCategories.page.offset.prev);scItemList.load()"><span aria-hidden="true">&lsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:active="title == scItemList.data.getCategories.page.current" dmx-class:disabled="!active" dmx-repeat="scItemList.data.getCategories.getServerConnectPagination(2,1,'...')">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',(page-1)*scItemList.data.getCategories.limit);scItemList.load()">{{title}}</a>
							</li>
							<li class="page-item" dmx-class:disabled="scItemList.data.getCategories.page.current ==  scItemList.data.getCategories.page.total" aria-label="Next">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scItemList.data.getCategories.page.offset.next);scItemList.load()"><span aria-hidden="true">&rsaquo;</span></a>
							</li>
							<li class="page-item" dmx-class:disabled="scItemList.data.getCategories.page.current ==  scItemList.data.getCategories.page.total" aria-label="Last">
								<a href="javascript:void(0)" class="page-link btn btn-icon   mr-2 my-1" dmx-on:click="qm.set('offset',scItemList.data.getCategories.page.offset.last);scItemList.load()"><span
										aria-hidden="true">&rsaquo;&rsaquo;</span></a>
							</li>
							<!-- <span class="ml-3 pt-2 datatable-pager-detail">Showing {{scItemList.data.getCategories.limit}} of {{scItemList.data.getCategories.total}}</span> -->
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

<div class="modal fade" id="modalCreateCategory" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="dmxConnect/api/Master/createCategory.php" is="dmx-serverconnect-form" id="FormCreateCategory" method="post"
				dmx-on:success="modalCreateCategory.hide();modalCreateCategory.FormCreateCategory.reset();scItemList.load();notifies1.success('Category created succesfully')" dmx-on:invalid="notifies1.danger(lastError.response)">
				<div class="modal-header">
					<h5 class="modal-title">New Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Category Name</label>
						<input type="text" name="CategoryName" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">Save <span class="spinner-border spinner-border-sm" dmx-show="state.executing" role="status"></span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalUpdateCategory" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="dmxConnect/api/Master/Items/UpdateItem.php" is="dmx-serverconnect-form" id="FormUpdateItem" method="post"
				dmx-on:success="modalUpdateCategory.hide();FormUpdateItem.reset();varID.setValue('');varItemName.setValue('');varCategoryID.setValue('');scItemList.load();">
				<div class="modal-header">
					<h5 class="modal-title">Update Item</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Category</label>
						<input type="hidden" name="SubCatID" dmx-bind:value="varID.value">
						<select class="form-control" name="CategoryID" dmx-bind:options="scCategories.data.getCategories" optiontext="category_name" optionvalue="id" dmx-on:changed="scItemLists.load({categoryid: value})"
							dmx-bind:value="varCategoryID.value">
							<option value="" selected>Select Category</option>
						</select>
					</div>
					<div class="form-group">
						<label>Item Name</label>
						<input type="text" name="ItemName" required class="form-control" dmx-bind:value="varItemName.value">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" dmx-bind:disabled="state.executing">Update <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>