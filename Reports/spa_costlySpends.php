<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" bootstrap4="cdn" id="CostlySpends" components="{dmxBootstrap4TableGenerator:{},dmxFormatter:{}}" -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Category</th>
                <th>Item name</th>
                <th>Category name</th>
                <th>Total amount</th>
                <th>No times</th>
            </tr>
        </thead>
        <tbody is="dmx-repeat" dmx-generator="bs4table" dmx-bind:repeat="scGetCostlySpends.data.GetList" id="tableRepeat1">
            <tr>
                <td dmx-text="category_id"></td>
                <td dmx-text="item_name"></td>
                <td dmx-text="category_name"></td>
                <td dmx-text="total_amount"></td>
                <td dmx-text="no_times"></td>
            </tr>
        </tbody>
    </table>
</div>
<dmx-serverconnect id="scGetCostlySpends" url="dmxConnect/api/Reports/MostlyCostlyItems.php" noload></dmx-serverconnect>