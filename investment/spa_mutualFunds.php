<!-- Wappler include head-page="../index.php" appConnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" bootstrap4="local" components="{dmxAutocomplete:{}}" -->
<dmx-serverconnect id="scGetFundsList" url="dmxConnect/api/Investments/MutualFunds/getFundsList.php" dmx-param:query="fundQuery.value"></dmx-serverconnect>

<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap me-2">
            <h3 class="text-dark fw-bold mt-2 mb-2 me-5">Mutual Funds</h3>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="d-flex">
        <div class="form-group">
            <input id="fundQuery" name="fundQuery" type="text" class="form-control" dmx-bind:data="scGetFundsList.data.getList" is="dmx-autocomplete" optiontext="name" optionvalue="code">
        </div>
    </div>
</div>