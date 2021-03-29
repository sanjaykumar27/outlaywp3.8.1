<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" bootstrap4="local" components="{dmxAutocomplete:{},dmxBootstrap4TableGenerator:{},dmxCharts:{},dmxFormatter:{},dmxBootstrap4Tooltips:{},dmxBootstrap4Modal:{},dmxNotifications:{}}" id="MutualFunds" -->
<dmx-serverconnect id="scGetInvestedFunds" url="dmxConnect/api/Investments/MutualFunds/getInvestedFunds.php"></dmx-serverconnect>
<dmx-notifications id="notifies1"></dmx-notifications>
<dmx-value id="varGraphSize" dmx-bind:value="0"></dmx-value>
<dmx-datetime id="varDateTime"></dmx-datetime>
<dmx-serverconnect id="scGetSavedFunds" url="dmxConnect/api/Investments/MutualFunds/getSavedFunds.php"></dmx-serverconnect>
<dmx-array id="arrGraphData" dmx-bind:items="scFundDetails.data.apiFundDetails.data.dataset.data"></dmx-array>
<dmx-serverconnect id="scFundDetails" url="dmxConnect/api/Investments/MutualFunds/getFundDetails.php" noload dmx-param:foliocode="varFolioID.value"></dmx-serverconnect>
<dmx-serverconnect id="scGetFundsList" url="dmxConnect/api/Investments/MutualFunds/getFundsList.php" dmx-param:query="fundQuery.value" noload></dmx-serverconnect>
<dmx-value id="varFolioID"></dmx-value>
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap me-2">
            <h3 class="text-dark fw-bold mt-2 mb-2 me-5">Mutual Funds</h3>
        </div>
        <div class="d-flex align-items-center">
            <a href="#" class="btn btn-primary mr-2" dmx-on:click="" data-toggle="modal" data-target="#modalNewFunds">
                <i class="flaticon-plus"></i> Buy Fund
            </a>
        </div>
    </div>
</div>
<div class="container-fluid px-0">
    <div class="card card-custom card-stretch gutter-b mb-2 pb-0">
        <div class="card-body border-dark-75 rounded p-4">
            <div class="d-flex">
                <div class="col-11">
                    <div class="form-group mb-1 d-flex align-items-center">
                        <input id="fundQuery" name="fundQuery" type="text" class="form-control mr-2" placeholder="Search Mutual Funds..." dmx-on:input.debounce:500="scGetFundsList.load({})">
                        <span dmx-show="scGetFundsList.state.executing"><i class="fas fa-sync-alt text-info fa-lg fa-spin"></i></span>
                    </div>
                    <div class="d-flex" dmx-show="scGetFundsList.data.getList.hasItems()">
                        <ul class="list-group w-100 mutual-fund-list" is="dmx-repeat" id="repeatFunds" dmx-bind:repeat="scGetFundsList.data.getList" key="fund_id">
                            <li class="list-group-item mouse-pointer text-hover-primary" dmx-on:click="varFolioID.setValue(code);scGetFundsList.reset();scFundDetails.load({})">{{name}}</li>
                        </ul>
                    </div>
                    <button class="btn mt-2 btn-light-danger font-weight-bold float-right small btn-sm rounded-3" dmx-show="scGetFundsList.data.getList.hasItems()" dmx-on:click="scGetFundsList.reset()">Close
                    </button>
                </div>
            </div>
            <div class="d-flex flex-wrap mx-4" id="repeatmf" is="dmx-repeat" dmx-bind:repeat="scGetSavedFunds.data.getSavedFunds">
                <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-primary mr-2 font-weight-bold" dmx-on:click="varFolioID.setValue(folio_id);scFundDetails.load({})">{{name}}</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid card card-custom card-stretch gutter-b mb-2 pb-0">
    <p class="text-center mt-5" dmx-show="scFundDetails.state.executing"><i class="fas fa-sync-alt text-info fa-3x fa-spin"></i></p>
    <div class="row my-5" dmx-show="arrGraphData.items.count() > 0">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="text-center" dmx-class:col-lg-6="varGraphSize.value == 0" dmx-class:col-lg-12="varGraphSize.value == 1">
                        <dmx-chart id="chart1" dmx-bind:data="arrGraphData.items.reverse()" dataset-1:value="$value[1]" dataset-1:label="Nav" smooth="true" legend="bottom" colors="colors6" point-style="rectRounded" point-size="1"
                            labels="$value[0].formatDate('dd-MM-yyyy')" responsive="true">
                        </dmx-chart>
                        <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-info small mr-2 font-weight-bold" dmx-on:click="scFundDetails.load({end_date: varDateTime.datetime.toDate(), start_date: varDateTime.datetime.addDays(-30)})">1 Month
                        </button>
                        <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-info small mr-2 font-weight-bold" dmx-on:click="scFundDetails.load({end_date: varDateTime.datetime.toDate(), start_date: varDateTime.datetime.addDays(-183)})">6 Month
                        </button>
                        <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-info small mr-2 font-weight-bold" dmx-on:click="scFundDetails.load({end_date: varDateTime.datetime.toDate(), start_date: varDateTime.datetime.addDays(-365)})">1
                            Year</button>
                        <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-info small mr-2 font-weight-bold" dmx-on:click="scFundDetails.load({end_date: varDateTime.datetime.toDate(), start_date: varDateTime.datetime.addDays(-730)})">2
                            Year</button>
                        <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-info small mr-2 font-weight-bold" dmx-on:click="scFundDetails.load({end_date: varDateTime.datetime.toDate(), start_date: varDateTime.datetime.addDays(-1096)})">3
                            Year</button>
                        <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-info small mr-2 font-weight-bold" dmx-on:click="scFundDetails.load({})">All</button>
                        <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-info small mr-2 font-weight-bold" dmx-on:click="varGraphSize.setValue(1)" dmx-show="varGraphSize.value == 0" dmx-bs-tooltip="'Expand Graph'">
                            <i class="fas fa-expand p-0"></i>
                        </button>
                        <button class="btn btn-sm py-1 px-2 mt-2 btn-outline-info small mr-2 font-weight-bold" dmx-on:click="varGraphSize.setValue(0)" dmx-show="varGraphSize.value == 1" dmx-bs-tooltip="'Minmize Graph'">
                            <i class="fas fa-compress-arrows-alt p-0"></i>
                        </button>
                    </div>
                    <div class="col-lg-6 d-flex flex-column">
                        <!--begin::Engage Widget 2-->
                        <div class="flex-grow-1 bg-success-o-10 p-8 rounded-xl flex-grow-1 bgi-no-repeat">
                            <div class="d-flex ml-3 align-items-center justify-content-between">
                                <span class="font-weight-boldest text-info font-size-h5">NAV: {{scFundDetails.data.apiFundDetails.data.dataset.data[0][1]}} ({{arrGraphData.items[0][0].formatDate('dd MMM yyyy')}})</span>
                                <form method="post" is="dmx-serverconnect-form" id="FormSaveFund" action="dmxConnect/api/Investments/MutualFunds/SaveFund.php" dmx-on:success="scGetSavedFunds.load()">
                                    <input type="hidden" name="folio_id" dmx-bind:value="scFundDetails.data.apiFundDetails.data.dataset.dataset_code">
                                    <input type="hidden" name="name" dmx-bind:value="scFundDetails.data.apiFundDetails.data.dataset.name">
                                    <button class="btn btn-icon float-right btn-lg" type="submit" dmx-bs-tooltip="'Remove Fund'"
                                        dmx-show="scGetSavedFunds.data.folio_ids.split(',').contains(scFundDetails.data.apiFundDetails.data.dataset.dataset_code)">
                                        <i class="fas fa-heart fa-2x text-success"></i>
                                    </button>
                                    <button class="btn btn-icon float-right btn-lg" type="submit" dmx-bs-tooltip="'Save Fund'" dmx-hide="scGetSavedFunds.data.folio_ids.split(',').contains(scFundDetails.data.apiFundDetails.data.dataset.dataset_code)">
                                        <i class="far fa-heart fa-2x text-success"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody dmx-generator="bs4table" dmx-populate="scFundDetails.data.apiFundDetails.data.dataset">
                                        <tr>
                                            <th>Folio Number</th>
                                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.dataset_code"></td>
                                        </tr>
                                        <tr>
                                            <th>Fund Name</th>
                                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.name"></td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td dmx-html="scFundDetails.data.apiFundDetails.data.dataset.description"></td>
                                        </tr>
                                        <tr>
                                            <th>Refreshed at</th>
                                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.refreshed_at.formatDate('dd MM yyyy')"></td>
                                        </tr>
                                        <tr>
                                            <th>Newest available date</th>
                                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.newest_available_date.formatDate('dd-MM-yyyy')"></td>
                                        </tr>
                                        <tr>
                                            <th>Oldest available date</th>
                                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.oldest_available_date.formatDate('dd-MM-yyyy')"></td>
                                        </tr>
                                        <tr>
                                            <th>Frequency</th>
                                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.frequency"></td>
                                        </tr>
                                        <tr>
                                            <th>Start date</th>
                                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.start_date"></td>
                                        </tr>
                                        <tr>
                                            <th>End date</th>
                                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.end_date"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Engage Widget 2-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalNewFunds" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Fund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" is="dmx-serverconnect-form" id="formNewFund" action="dmxConnect/api/Investments/MutualFunds/NewFund.php"
                    dmx-on:success="formNewFund.reset();modalNewFunds.hide();notifies1.success('Fund Created');scGetInvestedFunds.load()">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inp_scheme_id">Scheme</label>
                                <input type="number" class="form-control" name="scheme_id" placeholder="Enter Scheme">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inp_folio_number">Folio number</label>
                                <input type="number" class="form-control" id="inp_folio_number" name="folio_number" placeholder="Enter Folio number">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inp_investment_amount">Investment amount</label>
                                <input type="number" class="form-control" id="inp_investment_amount" name="investment_amount" placeholder="Enter Investment amount">

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inp_unit_alloted">Unit alloted</label>
                                <input type="number" class="form-control" id="inp_unit_alloted" name="unit_alloted" placeholder="Enter Unit alloted">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inp_nac">Nac</label>
                                <input type="number" class="form-control" id="inp_nac" name="nac" placeholder="Enter Nac">

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inp_fund_name">Fund name</label>
                                <input type="text" class="form-control" id="inp_fund_name" name="fund_name" placeholder="Enter Fund name">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" dmx-on:click="formNewFund.submit()" dmx-bind:disabled="formNewFund.state.executing">Save changes <span dmx-show="formNewFund.state.executing" class="spinner-border spinner-border-sm"
                        role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>