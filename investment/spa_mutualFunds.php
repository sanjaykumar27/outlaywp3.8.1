<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" bootstrap4="local" components="{dmxAutocomplete:{},dmxBootstrap4TableGenerator:{},dmxCharts:{},dmxFormatter:{}}" id="MutualFunds" -->
<dmx-array id="arrGraphData" dmx-bind:items="scFundDetails.data.apiFundDetails.data.dataset.data.reverse()"></dmx-array>
<dmx-serverconnect id="scFundDetails" url="dmxConnect/api/Investments/MutualFunds/getFundDetails.php" noload dmx-param:foliocode="varFolioID.value"></dmx-serverconnect>
<dmx-serverconnect id="scGetFundsList" url="dmxConnect/api/Investments/MutualFunds/getFundsList.php" dmx-param:query="fundQuery.value" noload></dmx-serverconnect>
<dmx-value id="varFolioID"></dmx-value>
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap me-2">
            <h3 class="text-dark fw-bold mt-2 mb-2 me-5">Mutual Funds</h3>
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
        </div>
    </div>
</div>

<div class="container-fluid">
    <p class="text-center mt-5" dmx-show="scFundDetails.state.executing"><i class="fas fa-sync-alt text-info fa-3x fa-spin"></i></p>
    <div class="row my-5" dmx-show="arrGraphData.items.count() > 0">
        <div class="col-lg-7">
            <dmx-chart id="chart1" dmx-bind:data="arrGraphData.items" dataset-1:value="$value[1]" dataset-1:label="Nav" smooth="true" legend="bottom" colors="colors6" point-style="rectRounded" point-size="1"
                labels="$value[0].formatDate('dd-MM-yyyy')" responsive="true">
            </dmx-chart>
        </div>
        <div class="col-lg-5">
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
    </div>
</div>