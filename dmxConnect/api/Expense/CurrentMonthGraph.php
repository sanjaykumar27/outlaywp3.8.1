<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "date"
      }
    ]
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
        "name": "startdate",
        "module": "core",
        "action": "setvalue",
        "options": {
          "key": "startdate",
          "value": "{{$_GET.date +'%'}}"
        },
        "output": true
      },
      {
        "name": "GetData",
        "module": "dbupdater",
        "action": "custom",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "query": "Select SUM(expense.amount) as amount, expense.purchase_date as dates from expense where expense.deleted = 0 AND expense.purchase_date LIKE :P1 GROUP by expense.purchase_date order by expense.purchase_date asc",
            "params": [
              {
                "name": ":P1",
                "value": "{{startdate}}",
                "test": "2020-08%"
              }
            ]
          }
        },
        "output": true,
        "meta": [
          {
            "name": "amount",
            "type": "text"
          },
          {
            "name": "dates",
            "type": "text"
          }
        ],
        "outputType": "array"
      },
      {
        "name": "api1",
        "module": "api",
        "action": "send",
        "options": {
          "url": "http://localhost/OutlayCopy/api_generateGraph.php",
          "method": "POST",
          "dataType": "x-www-form-urlencoded",
          "data": {
            "expense_data": "{{GetData}}"
          }
        },
        "output": true
      },
      {
        "name": "HTML",
        "module": "core",
        "action": "setvalue",
        "options": {
          "key": "HTML",
          "value": "{{api1.data}}"
        },
        "output": true
      }
    ]
  }
}
JSON
);
?>