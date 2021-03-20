<!-- Wappler include head-page="../index.php" id="spa_emiList" is="dmx-app" appConnect="local" fontawesome_5="local" jquery_slim_35="cdn" bootstrap4="cdn" components="{dmxBootstrap4TableGenerator:{},dmxStateManagement:{},dmxBootstrap4PagingGenerator:{},dmxBootstrap4Modal:{},dmxNotifications:{},dmxFormatter:{}}" -->
<dmx-serverconnect id="scEMIList" noload url="dmxConnect/api/Other/EMI/getEMIList.php"></dmx-serverconnect>
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">EMI's List</h5>
        </div>
        <div class="d-flex align-items-center">
            <a href="javascript:void(0)" class="btn btn-icon btn-primary mr-2">
                <i class="flaticon-plus"></i>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="card w-100 pt-3">
            <div class="card-body mt-n3 px-3 py-4">
                <div class="table-responsive">
                    <table class="table table-borderless table-vertical-center">
                        <tbody is="dmx-repeat" id="repeatEmi" dmx-bind:repeat="scEMIList.data.GetList.data">
                            <tr class="border-bottom">
                                <td class="text-truncate">
                                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{loan_name}}</a>
                                    <div>
                                        <a class="text-muted text-hover-primary small" href="#">{{starting_date.formatDate('dd-MM-yyyy')}}</a>
                                    </div>
                                </td>
                                <td class="text-truncate">
                                    <span class="symbol-label display6 text-info font-weight-bold">
                                        {{paid_emi}} / {{no_of_emi}}
                                    </span>
                                    <span class="display6 text-info font-weight-bold">Paid</span>
                                    <div>
                                        <a class="text-muted text-hover-primary small" href="#"> {{ending_date.formatDate('dd-MM-yyyy')}}</a>
                                    </div>
                                </td>
                                <td class="text-truncate">
                                    <span class="text-danger font-weight-bolder d-block font-size-lg ">{{total_amount.formatCurrency("₹ ", ".", ",", "2")}}</span>
                                    <span class="text-muted small">Interest: {{interest_amount.formatCurrency("₹ ", ".", ",", "2")}}</span>
                                </td>
                                <td class="text-truncate">
                                    <dmx-value id="varPercentage" dmx-bind:value="((paid_emi/no_of_emi) * 100).round()"></dmx-value>
                                    <div class="d-flex flex-column w-100 mr-2">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="text-muted mr-2 font-size-sm font-weight-bold">{{varPercentage.value}}%</span>
                                            <span class="label label-lg label-inline" dmx-class:label-light-success="status" dmx-class:label-light-danger="!status">{{status ? 'Completed' : 'Pending'}}</span>
                                        </div>
                                        <div class="progress progress-xs w-100">
                                            <div class="progress-bar" role="progressbar" dmx-class:bg-danger="varPercentage.value < 100" dmx-class:bg-success="varPercentage.value == 100" dmx-bind:style="width: {{varPercentage.value}}%;"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-truncate">
                                    <a dmx-bind:href="./emi/details/{{id}}" class="btn btn-light btn-hover-primary btn-sm" dmx-bind:title="'Show Details'">
                                        <i class="flaticon-list"></i> Details
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>