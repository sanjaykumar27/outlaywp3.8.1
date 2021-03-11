<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
[
  {
    "name": "",
    "module": "auth",
    "action": "restrict",
    "options": {
      "provider": "SecurityCS",
      "permissions": [
        "Active"
      ]
    }
  },
  {
    "name": "getMaxInvoiceID",
    "module": "dbconnector",
    "action": "single",
    "options": {
      "connection": "ConnCS",
      "sql": {
        "type": "SELECT",
        "columns": [
          {
            "table": "quick_expense",
            "column": "invoice_id",
            "alias": "invoice_id",
            "aggregate": "MAX"
          }
        ],
        "groupBy": [],
        "table": {
          "name": "quick_expense"
        },
        "joins": [],
        "query": "SELECT MAX(invoice_id) AS invoice_id\nFROM quick_expense",
        "params": []
      }
    },
    "output": true,
    "meta": [
      {
        "name": "invoice_id",
        "type": "number"
      }
    ],
    "outputType": "object"
  }
]
JSON
);
?>