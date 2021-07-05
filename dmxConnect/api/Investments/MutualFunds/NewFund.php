<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_POST": [
      {
        "type": "number",
        "name": "scheme_id"
      },
      {
        "type": "number",
        "name": "folio_number"
      },
      {
        "type": "number",
        "name": "investment_amount"
      },
      {
        "type": "number",
        "name": "unit_alloted"
      },
      {
        "type": "number",
        "name": "nav"
      },
      {
        "type": "text",
        "name": "fund_name"
      },
      {
        "type": "number",
        "name": "nav"
      },
      {
        "type": "number",
        "name": "trading_platform"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "",
        "module": "auth",
        "action": "restrict",
        "options": {
          "provider": "SecurityCS"
        }
      },
      {
        "name": "insert",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "invested_mutual_funds",
                "column": "scheme_id",
                "type": "number",
                "value": "{{$_POST.scheme_id}}"
              },
              {
                "table": "invested_mutual_funds",
                "column": "folio_number",
                "type": "number",
                "value": "{{$_POST.folio_number}}"
              },
              {
                "table": "invested_mutual_funds",
                "column": "fund_name",
                "type": "text",
                "value": "{{$_POST.fund_name}}"
              },
              {
                "table": "invested_mutual_funds",
                "column": "fund_platform",
                "type": "number",
                "value": "{{$_POST.trading_platform}}"
              }
            ],
            "table": "invested_mutual_funds",
            "returning": "investment_id",
            "query": "INSERT INTO invested_mutual_funds\n(scheme_id, folio_number, fund_name, fund_platform) VALUES (:P1 /* {{$_POST.scheme_id}} */, :P2 /* {{$_POST.folio_number}} */, :P3 /* {{$_POST.fund_name}} */, :P4 /* {{$_POST.trading_platform}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.scheme_id}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.folio_number}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.fund_name}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.trading_platform}}"
              }
            ]
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
          {
            "name": "affected",
            "type": "number"
          }
        ]
      }
    ]
  }
}
JSON
);
?>