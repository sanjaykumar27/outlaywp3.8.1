<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" id="StocksList" bootstrap4="local" components="{dmxBootstrap4TableGenerator:{}}" -->
<dmx-serverconnect id="scStockLists" url="dmxConnect/api/Investments/StockMarket/GetStocks.php" noload></dmx-serverconnect>
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Stocks List</h5>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:void(0)" class="btn btn-icon btn-primary   mr-2">
                <i class="flaticon-plus"></i>
            </a>
            <a href="javascript:void(0)" class="btn btn-icon btn-primary mr-2" dmx-on:click="collapse1.toggle()">
                <i class="flaticon-interface-6"></i>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-custom collapse p-3 show mb-3" id="collapse1" is="dmx-bs4-collapse">
        <div class="row">

        </div>
        <div class="row justify-content-center mb-2">
            <button class="btn  btn-primary   mr-2 mr-2" dmx-on:click="FilterCategory.setValue('');FilterItem.setValue('');date.setValue('');scStockLists.load({offset: 0});" data-toggle="collapse" data-target="#collapse1">Clear</button>
            <button class="btn  btn-primary   mr-2" dmx-on:click="scStockLists.load({offset: 0})" data-toggle="collapse" data-target="#collapse1">Search</button>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-custom card-stretch gutter-b">
        <div class="card-body mt-n3">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Company name</th>
                            <th>Purchase date</th>
                            <th>Share price</th>
                            <th>Unit</th>
                            <th>Invested amount</th>
                            <th>Transaction completed</th>
                        </tr>
                    </thead>
                    <tbody is="dmx-repeat" dmx-generator="bs4table" dmx-bind:repeat="scStockLists.data.GetList.data" id="tableRepeat1">
                        <tr>
                            <td dmx-text="company_name"></td>
                            <td dmx-text="purchase_date"></td>
                            <td dmx-text="share_price"></td>
                            <td dmx-text="unit"></td>
                            <td dmx-text="invested_amount"></td>
                            <td dmx-text="transaction_completed"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>