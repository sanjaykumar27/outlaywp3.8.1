<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "settings": {
    "options": {}
  },
  "meta": {
    "options": {},
    "$_POST": [
      {
        "type": "text",
        "name": "target_name"
      },
      {
        "type": "number",
        "name": "target_amount"
      },
      {
        "type": "text",
        "name": "target_description"
      },
      {
        "type": "number",
        "name": "userid"
      },
      {
        "type": "text",
        "name": "target_photo"
      },
      {
        "type": "number",
        "name": "IsCompleted"
      },
      {
        "type": "datetime",
        "name": "CreatedOn"
      },
      {
        "type": "array",
        "name": "record",
        "sub": [
          {
            "type": "text",
            "name": "$_POST"
          },
          {
            "type": "number",
            "name": "SecurityCS"
          },
          {
            "type": "text",
            "name": "name"
          },
          {
            "type": "datetime",
            "name": "NOW"
          }
        ]
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
        "name": "uploadPhoto",
        "module": "upload",
        "action": "upload",
        "options": {
          "fields": "{{$_POST.target_photo}}",
          "path": "/assets/uploads/target",
          "template": "{guid}{ext}",
          "replaceSpace": true,
          "overwrite": true
        },
        "meta": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "path",
            "type": "text"
          },
          {
            "name": "url",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "text"
          },
          {
            "name": "error",
            "type": "number"
          }
        ],
        "outputType": "array",
        "output": true
      },
      {
        "name": "a",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{uploadPhoto.name}}"
        },
        "output": true,
        "disabled": true
      },
      {
        "name": "insertTarget",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "ConnCS",
          "sql": {
            "type": "insert",
            "values": [
              {
                "table": "target_master",
                "column": "target_name",
                "type": "text",
                "value": "{{$_POST.target_name}}"
              },
              {
                "table": "target_master",
                "column": "target_amount",
                "type": "number",
                "value": "{{$_POST.target_amount}}"
              },
              {
                "table": "target_master",
                "column": "target_description",
                "type": "text",
                "value": "{{$_POST.target_description}}"
              },
              {
                "table": "target_master",
                "column": "userid",
                "type": "number",
                "value": "{{SecurityCS.identity}}"
              },
              {
                "table": "target_master",
                "column": "target_photo",
                "type": "text",
                "value": "{{uploadPhoto.name}}"
              },
              {
                "table": "target_master",
                "column": "IsCompleted",
                "type": "number",
                "value": "0"
              },
              {
                "table": "target_master",
                "column": "CreatedOn",
                "type": "datetime",
                "value": "{{NOW}}"
              }
            ],
            "table": "target_master",
            "query": "INSERT INTO target_master\n(target_name, target_amount, target_description, userid, target_photo, IsCompleted, CreatedOn) VALUES (:P1 /* {{$_POST.target_name}} */, :P2 /* {{$_POST.target_amount}} */, :P3 /* {{$_POST.target_description}} */, :P4 /* {{SecurityCS.identity}} */, :P5 /* {{uploadPhoto.name}} */, '0', :P6 /* {{NOW}} */)",
            "params": [
              {
                "name": ":P1",
                "type": "expression",
                "value": "{{$_POST.target_name}}"
              },
              {
                "name": ":P2",
                "type": "expression",
                "value": "{{$_POST.target_amount}}"
              },
              {
                "name": ":P3",
                "type": "expression",
                "value": "{{$_POST.target_description}}"
              },
              {
                "name": ":P4",
                "type": "expression",
                "value": "{{SecurityCS.identity}}"
              },
              {
                "name": ":P5",
                "type": "expression",
                "value": "{{uploadPhoto.name}}"
              },
              {
                "name": ":P6",
                "type": "expression",
                "value": "{{NOW}}"
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
        ],
        "output": true
      }
    ]
  }
}
JSON
);
?>