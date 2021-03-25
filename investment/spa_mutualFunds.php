<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" bootstrap4="local" components="{dmxAutocomplete:{}}" id="MutualFunds" -->
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
                    <li class="list-group-item mouse-pointer text-hover-primary" dmx-on:click="varFolioID.setValue(code);scGetFundsList.reset()">{{name}}</li>
                </ul>
            </div>
            <button class="btn mt-2 btn-light-danger font-weight-bold float-right small btn-sm rounded-3" dmx-show="scGetFundsList.data.getList.hasItems()" dmx-on:click="scGetFundsList.reset()">Close</button>
        </div>
    </div>
</div>