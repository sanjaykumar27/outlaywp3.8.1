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
    "name": "monthlyExpense",
    "module": "dbupdater",
    "action": "custom",
    "options": {
      "connection": "ConnCS",
      "sql": {
        "query": "SELECT SUM(amount) as amount, DATE_FORMAT(purchase_date, \"%b %Y\") as dates FROM `expense` GROUP BY MONTH(purchase_date), YEAR(purchase_date) order by purchase_date desc LIMIT 12",
        "params": []
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
    "name": "data",
    "module": "core",
    "action": "setvalue",
    "options": {
      "key": "data",
      "value": "{{monthlyExpense.reverse()}}"
    }
  },
  {
    "name": "apiMonthGraph",
    "module": "api",
    "action": "send",
    "options": {
      "url": "https://sanjaychaurasia.tech/api_generateGraph.php",
      "method": "POST",
      "data": {
        "data": "{{data}}",
        "method": "MonthlyExpenseGraph"
      },
      "schema": [],
      "dataType": "x-www-form-urlencoded",
      "passErrors": false
    },
    "meta": [
      {
        "type": "array",
        "name": "data"
      },
      {
        "type": "object",
        "name": "headers"
      }
    ],
    "outputType": "object"
  },
  {
    "name": "HTML",
    "module": "core",
    "action": "setvalue",
    "options": {
      "key": "HTML",
      "value": "{{apiMonthGraph.data}}"
    },
    "output": true
  }
]
JSON
);
?>