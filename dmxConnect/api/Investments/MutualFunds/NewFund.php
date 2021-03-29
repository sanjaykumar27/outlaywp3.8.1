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
        "name": "Insert",
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
                "column": "investment_amount",
                "type": "number",
                "value": "{{$_POST.investment_amount}}"
              },
              {
                "table": "invested_mutual_funds",
                "column": "unit_alloted",
                "type": "number",
                "value": "{{$_POST.unit_alloted}}"
              },
              {
                "table": "invested_mutual_funds",
                "column": "nac",
                "type": "number",
                "value": "{{$_POST.nav}}"
              },
              {
                "table": "invested_mutual_funds",
                "column": "fund_name",
                "type": "text",
                "value": "{{$_POST.fund_name}}"
              },
              {
                "table": "invested_mutual_funds",
                "column": "redeemed",
                "type": "number",
                "value": "0"
              }
            ],
            "table": "invested_mutual_funds",
            "returning": "investment_id",
            "query": "INSERT INTO invested_mutual_funds\n(scheme_id, folio_number, investment_amount, unit_alloted, nac, fund_name, redeemed) VALUES (:P1 /* {{$_POST.scheme_id}} */, :P2 /* {{$_POST.folio_number}} */, :P3 /* {{$_POST.investment_amount}} */, :P4 /* {{$_POST.unit_alloted}} */, :P5 /* {{$_POST.nav}} */, :P6 /* {{$_POST.fund_name}} */, '0')",
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
                "value": "{{$_POST.investment_amount}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{$_POST.unit_alloted}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{$_POST.nav}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{$_POST.fund_name}}"
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