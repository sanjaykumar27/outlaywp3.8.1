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
        "name": "a",
        "module": "core",
        "action": "setvalue",
        "options": {
          "value": "{{SecurityCS.identity}}"
        },
        "output": true
      },
      {
        "name": "",
        "module": "core",
        "action": "condition",
        "options": {
          "if": "{{SecurityCS.identity}}",
          "then": {
            "steps": {
              "name": "a",
              "module": "core",
              "action": "setvalue",
              "options": {
                "value": "a"
              }
            }
          },
          "else": {
            "steps": {
              "name": "Response",
              "module": "core",
              "action": "response",
              "options": {
                "status": 401,
                "data": "Unauthorized"
              }
            }
          }
        },
        "outputType": "boolean"
      }
    ]
  }
}
JSON
);
?>