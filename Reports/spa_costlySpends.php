<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" bootstrap4="cdn" id="CostlySpends" components="{dmxBootstrap4TableGenerator:{},dmxFormatter:{}}" -->
<dmx-serverconnect id="scGetCostlySpends" url="dmxConnect/api/Reports/MostlyCostlyItems.php" noload></dmx-serverconnect>
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Most Costly Items</h5>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 px-2" dmx-repeat:repeatcards="scGetCostlySpends.data.GetList">
            <div class="card rounded-lg shadow card-custom gutter-b position-relative" style="height: 130px">
                <div class="font-weight-bolder ml-1 mt-1 position-absolute px-2 start-0 top-0">{{$index + 1}}</div>
                <div class="card-body d-flex flex-column ">
                    <div class="flex-grow-1">
                        <div class="text-dark-50 font-weight-bold">{{category_name}} - {{item_name}}</div>
                        <div class="font-weight-bolder font-size-h3 text-info">{{total_amount.toNumber().formatCurrency("₹ ", ".", ",", "2")}} </div>
                        <div class="small">({{no_times}}) times</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>