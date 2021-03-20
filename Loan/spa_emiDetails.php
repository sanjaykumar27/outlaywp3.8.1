<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" bootstrap4="local" id="EMIDEtails" components="{dmxBootstrap4Modal:{},dmxNotifications:{}}" -->

<dmx-value id="varEmiID"></dmx-value>
<dmx-serverconnect id="scEMIDetails" url="dmxConnect/api/Other/EMI/getEMIDetails.php" noload dmx-param:emi_id="params.emi_id"></dmx-serverconnect>
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
<div class="row ml-0">
    <div class="col">
        <div class="card card-custom gutter-b">
            <div class="card-body py-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                        <thead>
                            <tr class="text-uppercase">
                                <th>#</th>
                                <th>Due Date</th>
                                <th>Paid On</th>
                                <th>Amount</th>
                                <th class="text-center">action</th>
                            </tr>
                        </thead>
                        <tbody is="dmx-repeat" id="repeatEmis" dmx-bind:repeat="scEMIDetails.data.EmiList">
                            <tr>
                                <td class="pl-0">
                                    <a href="#" class="text-dark-75 text-hover-primary font-size-lg">{{$index+1}}</a>
                                </td>
                                <td class="text-truncate">
                                    <span class="text-dark-75  d-block font-size-lg">{{due_date.formatDate('dd-MM-yyyy')}}</span>
                                </td>
                                <td class="text-truncate">
                                    <span class="text-dark-75  d-block font-size-lg">{{paid_on.formatDate('dd-MM-yyyy')}}</span>
                                </td>
                                <td class="text-truncate">
                                    <span class="text-dark-75  d-block font-size-lg">{{loan_amount.formatCurrency("₹ ", ".", ",", "2")}}</span>
                                </td>
                                <td class="text-center text-truncate">
                                    <span class="label label-lg label-inline label-light-success" dmx-show="status">Paid</span>
                                    <a href="#" class="btn btn-outline-danger btn-sm" dmx-hide="status" dmx-on:click="varEmiID.setValue(id);modalPayEMI.show()">
                                        <i class="fas fa-check p-0"></i> Pay
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
<div class="modal fade" id="modalPayEMI" is="dmx-bs4-modal" tabindex="-1" role="dialog" nocloseonclick="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pay EMI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form is="dmx-serverconnect-form" method="post" id="FormPayEMI" dmx-on:success="notif.success('EMI Paid');FormPayEMI.reset();scEMIDetails.load();modalPayEMI.hide()" action="dmxConnect/api/Other/EMI/PayEMI.php">
                    <div class="form-group">
                        <input type="hidden" name="emi_id" required dmx-bind:value="varEmiID.value">
                        <input type="date" name="payment_date" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" dmx-on:click="FormPayEMI.submit()" dmx-bind:disabled="modalPayEMI.state.executing">Pay <span dmx-show="modalPayEMI.state.executing" class="spinner-border spinner-border-sm"
                        role="status"></span>
                </button>
            </div>
        </div>
    </div>
</div>