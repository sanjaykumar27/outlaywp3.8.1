<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" bootstrap4="cdn" fontawesome_4="cdn" jquery_slim_34="local" id="formList" -->
<dmx-serverconnect id="scFormList" url="dmxConnect/api/Form/getFormList.php" noload="noload"></dmx-serverconnect>

<dmx-notifications id="notifies1" offset-x="30" offset-y="30" closable newest-on-top></dmx-notifications>
<dmx-query-manager id="qm"></dmx-query-manager>
<div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<div class="d-flex align-items-center flex-wrap mr-1">
		<div class="d-flex align-items-baseline mr-5">
			<h1 class="text-dark my-2 mr-5 font-weight-light">
				Form List </h1>
		</div>
	</div>
	<div class="d-flex align-items-center">

		<a href="./form/create" class="btn btn-primary font-weight-bold btn-sm">
			<i class="flaticon-plus"></i>
			Create Form
		</a>
	</div>
</div>

<div class="d-flex flex-column-fluid pt-2">
	<div class="container-fluid">
		<div class="card card-custom overflow-hidden">
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-hover table-striped font-weight-bolder">
						<thead>
							<tr>
								<th scope="col">Logo</th>
								<th scope="col">Form Name</th>
								<th scope="col">Description</th>
								<th scope="col">Grid Size</th>
								<th scope="col">ACTION</th>
							</tr>
						</thead>
						<tbody is="dmx-repeat" id="repeat1" dmx-bind:repeat="scFormList.data.getList.data">
							<tr>
								<td>{{invoice_number}}</td>
								<td>{{form_name}}</td>
								<td dmx-html="form_description"></td>
								<td>{{grid_size}}</td>
								<td>
									<a class="btn btn-sm btn-primary mr-2" dmx-bind:href="'./form/detail/'+form_id">
										<i class="fa fa-pencil-square-o"></i> Fields
									</a>
								</td>
							</tr>
						</tbody>
					</table>

					<ul class="pagination justify-content-center" dmx-populate="scFormList.data.getList" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
						<select class="form-control form-control-sm text-primary bg-light-light mr-4 rounded" style="width: 75px;" name="varPageValue" dmx-on:changed="scFormList.load()">
							<option value="10" selected>10</option>
							<option value="30">30</option>
							<option value="50">50</option>
							<option value="75">75</option>
							<option value="100">100</option>
						</select>
						<li class="page-item" dmx-class:disabled="scFormList.data.getList.page.current == 1" aria-label="First">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scFormList.data.getList.page.offset.first);scFormList.load()"><span
									aria-hidden="true">&lsaquo;&lsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:disabled="scFormList.data.getList.page.current == 1" aria-label="Previous">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scFormList.data.getList.page.offset.prev);scFormList.load()"><span
									aria-hidden="true">&lsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:active="title == scFormList.data.getList.page.current" dmx-class:disabled="!active" dmx-repeat:gfgf="scFormList.data.getList.getServerConnectPagination(2,1,'...')">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1" dmx-on:click="qm.set('offset',(page-1)*scFormList.data.getList.limit);scFormList.load()">{{title}}</a>
						</li>
						<li class="page-item" dmx-class:disabled="scFormList.data.getList.page.current ==  scFormList.data.getList.page.total" aria-label="Next">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scFormList.data.getList.page.offset.next);scFormList.load()"><span
									aria-hidden="true">&rsaquo;</span></a>
						</li>
						<li class="page-item" dmx-class:disabled="scFormList.data.getList.page.current ==  scFormList.data.getList.page.total" aria-label="Last">
							<a href="javascript:void(0)" class="page-link btn btn-icon btn-sm btn-light-primary mr-2 my-1" dmx-on:click="qm.set('offset',scFormList.data.getList.page.offset.last);scFormList.load()"><span
									aria-hidden="true">&rsaquo;&rsaquo;</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>