<!-- Wappler include head-page="../index.php" appconnect="local" is="dmx-app" fontawesome_5="local" jquery_slim_35="local" moment_2="local with locales" components="{dmxDropzone:{},dmxNotifications:{},dmxStateManagement:{}}" id="QuickExense" bootstrap5="local" -->
<dmx-notifications id="notif"></dmx-notifications>
<dmx-serverconnect id="scDeleteQuickExpense" url="dmxConnect/api/Expense/RemoveQuickExpense.php" noload dmx-on:success="notif.success('Record Deleted');scGetQuickExpense.load()"></dmx-serverconnect>
<dmx-query-manager id="qm"></dmx-query-manager>
<dmx-serverconnect id="scGetQuickExpense" url="dmxConnect/api/Expense/ExpenseList_quick.php" dmx-param:offset="query.offset" dmx-param:limit="10"></dmx-serverconnect>
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
    <form class="form" method="post" is="dmx-serverconnect-form" id="CreateExpense" action="dmxConnect/api/Expense/QuickExpense.php"
        dmx-on:success="CreateExpense.reset();modalConfirmation.show();notif.success('Expense Created');scGetQuickExpense.load()">
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
                <table class="table">
                    <thead class="bg-dark-o-20">
                        <tr>
                            <th>INVOICE</th>
                            <th>ITEM</th>
                            <th>AMOUNT</th>
                            <th>DATE</th>
                            <th>REMARK</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody is="dmx-repeat" id="repeatExpenseList" dmx-bind:repeat="scGetQuickExpense.data.queryExpenseList.data.sort(invoice_number)">
                        <tr>
                            <td>
                                <div class="symbol symbol-40 symbol-light">
                                    <span class="symbol-label">
                                        <a href="javascript:void(0)" class="mouse-pointer font-weight-bolder">{{invoice_id}}</a>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="symbol symbol-40 symbol-light">{{item_name}}
                                </div>
                            </td>
                            <td class="text-truncate">
                                <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{amount.toNumber().formatCurrency("₹ ", ".", ",", "2")}}</a>
                            </td>
                            <td class="text-truncate">
                                <span class="text-info font-weight-bolder d-block font-size-lg">{{purchase_date.formatDate("dd MMM yy")}}</span>
                            </td>
                            <td>
                                <div class="symbol symbol-40 symbol-light">{{remark}}
                                </div>
                            </td>
                            <td class="text-truncate">
                                <button class="btn btn-outline-danger" dmx-on:click="scDeleteQuickExpense.load({id: expense_id})">
                                    <i class="fas fa-check p-0"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex flex-row justify-content-md-center align-items-center my-3">
                    <ul class="pagination justify-content-center pagination-lg" dmx-populate="scGetQuickExpense.data.queryExpenseList" dmx-state="qm" dmx-offset="offset" dmx-generator="bs4paging">
                        <li class="page-item" dmx-class:disabled="scGetQuickExpense.data.queryExpenseList.page.current == 1" aria-label="First">
                            <a href="javascript:void(0)" class="page-link btn btn-icon  mr-2 my-1" dmx-on:click="qm.set('offset',scGetQuickExpense.data.queryExpenseList.page.offset.first);scGetQuickExpense.load()"><span
                                    aria-hidden="true">&lsaquo;&lsaquo;</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="scGetQuickExpense.data.queryExpenseList.page.current == 1" aria-label="Previous">
                            <a href="javascript:void(0)" class="page-link btn btn-icon  mr-2 my-1" dmx-on:click="qm.set('offset',scGetQuickExpense.data.queryExpenseList.page.offset.prev);scGetQuickExpense.load()"><span
                                    aria-hidden="true">&lsaquo;</span></a>
                        </li>
                        <li class="page-item" dmx-class:active="title == scGetQuickExpense.data.queryExpenseList.page.current" dmx-class:disabled="!active" dmx-repeat="scGetQuickExpense.data.queryExpenseList.getServerConnectPagination(2,1,'...')">
                            <a href="javascript:void(0)" class="page-link btn btn-icon  mr-2 my-1" dmx-on:click="qm.set('offset',(page-1)*scGetQuickExpense.data.queryExpenseList.limit);scGetQuickExpense.load()">{{title}}</a>
                        </li>
                        <li class="page-item" dmx-class:disabled="scGetQuickExpense.data.queryExpenseList.page.current ==  scGetQuickExpense.data.queryExpenseList.page.total" aria-label="Next">
                            <a href="javascript:void(0)" class="page-link btn btn-icon mr-2 my-1" dmx-on:click="qm.set('offset',scGetQuickExpense.data.queryExpenseList.page.offset.next);scGetQuickExpense.load()"><span
                                    aria-hidden="true">&rsaquo;</span></a>
                        </li>
                        <li class="page-item" dmx-class:disabled="scGetQuickExpense.data.queryExpenseList.page.current ==  scGetQuickExpense.data.queryExpenseList.page.total" aria-label="Last">
                            <a href="javascript:void(0)" class="page-link btn btn-icon  mr-2 my-1" dmx-on:click="qm.set('offset',scGetQuickExpense.data.queryExpenseList.page.offset.last);scGetQuickExpense.load()"><span
                                    aria-hidden="true">&rsaquo;&rsaquo;</span></a>
                        </li>
                    </ul>
                </div>
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