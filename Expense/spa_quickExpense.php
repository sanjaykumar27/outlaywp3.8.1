<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" components="{dmxDropzone:{},dmxNotifications:{}}" id="QuickExense" bootstrap5="local" -->
<dmx-value id="varInvoiceID" dmx-bind:value="scMaxInvoiceID.data.getMaxInvoiceID.invoice_id + 1"></dmx-value>
<dmx-datetime id="varDateTime"></dmx-datetime>
<dmx-serverconnect id="scMaxInvoiceID" url="dmxConnect/api/Expense/getMaxInvoiceID_quick.php"></dmx-serverconnect>
<div class="subheader py-2 py-lg-4 subheader-solid mb-0" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-2">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Quick Expense</h5>
        </div>
        <div class="d-flex align-items-center">
            <a href="./expense/list" class="btn btn-icon btn-primary  ">
                <i class="flaticon-plus"></i>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <form class="form" method="post" is="dmx-serverconnect-form" id="CreateExpense" action="dmxConnect/api/Expense/QuickExpense.php" dmx-on:success="CreateExpense.reset();modalConfirmation.show();notif.success('Expense Created')">
        <div class="card card-custom card-stretch gutter-b mb-2 pb-0">
            <div class="card-body border-dark-75 rounded p-4">
                <div class="row mb-2 py-1 row rounded p-2">
                    <div class="col-lg-2 col-12">
                        <div class="form-group">
                            <label>New Item</label>
                            <input type="hidden" name="invoice_number" dmx-bind:value="varInvoiceID.value">
                            <input type="text" class="form-control" autocomplete="off" name="NewItem">
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="form-group">
                            <label>Amount:</label>
                            <input type="number" id="Price" name="Amount" class="form-control" placeholder="Amount" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="form-group">
                            <label>Date:</label>
                            <input type="date" name="PurchaseDate" class="form-control" placeholder="Purchase Date" dmx-bind:value="varDateTime.datetime.formatDate(&quot;yyyy-MM-dd&quot;)" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="form-group">
                            <label>Remark:</label>
                            <textarea name="Remark" rows="2" class="form-control" placeholder="Enter full name"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label>Receipt</label>
                            <input is="dmx-dropzone" id="targetFile" type="file" name="target_photo">
                        </div>
                    </div>
                </div>
                <div class="text-center border-0">
                    <button type="submit" class="btn btn-primary mr-2 btn-lg font-weight-500" dmx-bind:disabled="state.executing">SUBMIT <span class="spinner-border spinner-border-sm" role="status" dmx-show="state.executing"></span>
                    </button>
                </div>
            </div>
        </div>


    </form>
    <div class="card card-custom card-stretch gutter-b mt-5">
        <div class="card-body mt-n3">
            <div class="table-responsive">
                <table class="table ">
                    <thead class="bg-dark-o-20">
                        <tr>
                            <th>INVOICE</th>
                            <th>ITEM</th>
                            <th>AMOUNT</th>
                            <th>QUANTITY</th>
                            <th>DATE</th>
                            <th>REMARK</th>
                        </tr>
                    </thead>
                    <tbody is="dmx-repeat" id="repeatExpenseList" dmx-bind:repeat="scExpenseList.data.queryExpenseList.data.sort(invoice_number)" key="Expense_ID">
                        <tr>
                            <td>
                                <div class="symbol symbol-40 symbol-light">
                                    <span class="symbol-label">
                                        <a href="javascript:void(0)" class="mouse-pointer font-weight-bolder" dmx-on:click="scInvoiceItems.load({invoiceid: invoice_number});ModalInvoice.show()">{{invoice_number}}</a>
                                    </span>
                                </div>
                            </td>
                            <td class="text-truncate">
                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{ItemName}}</a>
                                <div>
                                    <a class="text-muted font-weight-bold text-hover-primary" href="#">{{category_name}}</a>
                                </div>
                            </td>
                            <td class="text-truncate">
                                <span class="text-info font-weight-bolder d-block font-size-lg">{{amount.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</span>
                                <span class="text-muted font-weight-bold">{{PaymentType}}</span>
                            </td>
                            <td class="text-truncate">
                                <span class="font-weight-500">{{quantity + ' ' + Unit}}</span>
                            </td>
                            <td class="text-truncate">
                                <span class="font-weight-500">{{purchase_date.formatDate("dd MMM yy")}}</span>
                            </td>
                            <td class="text-truncate">
                                <span class="font-weight-500" dmx-bs-tooltip="remark">{{remark.trunc(15, true, "...")}}</span>
                            </td>
                        </tr>
                    </tbody>
                    <tbody dmx-hide="scExpenseList.data.queryExpenseList.data.hasItems()">
                        <tr>
                            <td colspan="8">
                                <h4 class="text-center text-muted font-weight-bolder">No expense found this month!</h4>
                            </td>
                        </tr>
                    </tbody>
                    <tr class="bg-light-primary">
                        <td colspan="2">
                            <h5 class="font-weight-bolder">Total</h5>
                        </td>
                        <td class="text-truncate">
                            <h5 class="font-weight-bolder">{{scExpenseList.data.TotalAmount.TotalAmount.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</h5>
                        </td>
                        <td colspan="5"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConfirmation" is="dmx-bs5-modal" tabindex="-1" nocloseonclick="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-center my-2">
                    <button class="btn btn-outline-info w-150px" dmx-on:click="scMaxInvoiceID.load();modalConfirmation.hide()">New Entry</button>
                </div>
                <div class="d-flex justify-content-center my-2">
                    <button class="btn btn-outline-primary w-150px" dmx-on:click="modalConfirmation.hide()">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>