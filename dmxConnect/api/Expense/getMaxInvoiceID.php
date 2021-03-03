<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {}
  },
  "exec": {
    "steps": [
      "Connections/ConnCS",
      "SecurityProviders/SecurityCS",
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
                "table": "expense",
                "column": "invoice_number",
                "alias": "InvoiceID",
                "aggregate": "MAX"
              }
            ],
            "groupBy": [],
            "table": {
              "name": "expense"
            },
            "joins": [],
            "query": "SELECT MAX(invoice_number) AS InvoiceID\nFROM expense",
            "params": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "InvoiceID",
            "type": "number"
          }
        ],
        "outputType": "object"
      }
    ]
  }
}
JSON
);
?>