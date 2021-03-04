// JavaScript Document
/* checking if browser supports service worker, if yes then registor */

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    window.location = "http://localhost/exp/mobile-login";
}

function MonthlyGraph() {
    console.log('Graph Called');
    setTimeout(function () {
        var rec_data = dmx.app.data.scMonthlyReport.data.HTML;
        $('#expense_monthly').html(rec_data);
    }, 2000);
}

function CurrentMonthGraph() {
    console.log('Graph Called');
    var rec_data = dmx.app.data.routeExpenseList.scGenerateGraph.data.HTML;
    $('#expense_monthly').html(rec_data);
}

