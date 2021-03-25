<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" bootstrap4="local" components="{dmxAutocomplete:{},dmxBootstrap4TableGenerator:{},dmxCharts:{}}" id="MutualFunds" -->
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
<div class="container-fluid px-3">
    <div class="d-flex">
        <div class="col-12">
            <div class="form-group mb-1">
                <input id="fundQuery" name="fundQuery" type="text" class="form-control" placeholder="Search Mutual Funds..." dmx-on:input.debounce:500="scGetFundsList.load({})">
            </div>
            <div class="d-flex" dmx-show="scGetFundsList.data.getList.hasItems()">
                <ul class="list-group w-100 mutual-fund-list" is="dmx-repeat" id="repeatFunds" dmx-bind:repeat="scGetFundsList.data.getList" key="fund_id">
                    <li class="list-group-item mouse-pointer text-hover-primary" dmx-on:click="varFolioID.setValue(code);scGetFundsList.reset();scFundDetails.load({})">{{name}}</li>
                </ul>
            </div>
            <button class="btn mt-2 btn-light-danger font-weight-bold float-right small btn-sm rounded-3" dmx-show="scGetFundsList.data.getList.hasItems()" dmx-on:click="scGetFundsList.reset()">Close</button>
        </div>

    </div>
    <div class="d-flex">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <tbody dmx-generator="bs4table" dmx-populate="scFundDetails.data.apiFundDetails.data.dataset">
                        <tr>
                            <th>Id</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.id"></td>
                        </tr>
                        <tr>
                            <th>Dataset code</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.dataset_code"></td>
                        </tr>
                        <tr>
                            <th>Database code</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.database_code"></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.name"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.description"></td>
                        </tr>
                        <tr>
                            <th>Refreshed at</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.refreshed_at"></td>
                        </tr>
                        <tr>
                            <th>Newest available date</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.newest_available_date"></td>
                        </tr>
                        <tr>
                            <th>Oldest available date</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.oldest_available_date"></td>
                        </tr>
                        <tr>
                            <th>Column names</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.column_names"></td>
                        </tr>
                        <tr>
                            <th>Frequency</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.frequency"></td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.type"></td>
                        </tr>
                        <tr>
                            <th>Premium</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.premium"></td>
                        </tr>
                        <tr>
                            <th>Limit</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.limit"></td>
                        </tr>
                        <tr>
                            <th>Transform</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.transform"></td>
                        </tr>
                        <tr>
                            <th>Column index</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.column_index"></td>
                        </tr>
                        <tr>
                            <th>Start date</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.start_date"></td>
                        </tr>
                        <tr>
                            <th>End date</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.end_date"></td>
                        </tr>

                        <tr>
                            <th>Collapse</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.collapse"></td>
                        </tr>
                        <tr>
                            <th>Order</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.order"></td>
                        </tr>
                        <tr>
                            <th>Database</th>
                            <td dmx-text="scFundDetails.data.apiFundDetails.data.dataset.database_id"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="d-flex">
        <div class="col">
            <dmx-chart id="chart1" dmx-bind:data="scFundDetails.data.apiFundDetails" dataset-1:value="dataset.data"></dmx-chart>
        </div>
    </div>
</div>