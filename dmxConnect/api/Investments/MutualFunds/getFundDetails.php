<?php
require('../../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "options": {
          "rules": {
            "core:required": {}
          }
        },
        "name": "foliocode"
      }
    ]
  },
  "exec": {
    "steps": [
      {
        "name": "apiFundDetails",
        "module": "api",
        "action": "send",
        "options": {
          "url": "{{'https://www.quandl.com/api/v3/datasets/AMFI/'+$_GET.foliocode+'.json?api_key=uuN2KGBSriTRXRkcgmwe'}}",
          "passErrors": false,
          "schema": []
        },
        "output": true,
        "meta": [
          {
            "type": "object",
            "name": "data",
            "sub": [
              {
                "type": "object",
                "name": "dataset",
                "sub": [
                  {
                    "type": "number",
                    "name": "id"
                  },
                  {
                    "type": "text",
                    "name": "dataset_code"
                  },
                  {
                    "type": "text",
                    "name": "database_code"
                  },
                  {
                    "type": "text",
                    "name": "name"
                  },
                  {
                    "type": "text",
                    "name": "description"
                  },
                  {
                    "type": "text",
                    "name": "refreshed_at"
                  },
                  {
                    "type": "text",
                    "name": "newest_available_date"
                  },
                  {
                    "type": "text",
                    "name": "oldest_available_date"
                  },
                  {
                    "type": "array",
                    "name": "column_names",
                    "sub": [
                      {
                        "type": "text",
                        "name": "$value"
                      }
                    ]
                  },
                  {
                    "type": "text",
                    "name": "frequency"
                  },
                  {
                    "type": "text",
                    "name": "type"
                  },
                  {
                    "type": "boolean",
                    "name": "premium"
                  },
                  {
                    "type": "text",
                    "name": "limit"
                  },
                  {
                    "type": "text",
                    "name": "transform"
                  },
                  {
                    "type": "text",
                    "name": "column_index"
                  },
                  {
                    "type": "text",
                    "name": "start_date"
                  },
                  {
                    "type": "text",
                    "name": "end_date"
                  },
                  {
                    "type": "array",
                    "name": "data",
                    "sub": [
                      {
                        "type": "array",
                        "name": "$value",
                        "sub": [
                          {
                            "type": "text",
                            "name": "$value"
                          }
                        ]
                      }
                    ]
                  },
                  {
                    "type": "text",
                    "name": "collapse"
                  },
                  {
                    "type": "text",
                    "name": "order"
                  },
                  {
                    "type": "number",
                    "name": "database_id"
                  }
                ]
              }
            ]
          },
          {
            "type": "object",
            "name": "headers",
            "sub": [
              {
                "type": "text",
                "name": "allow"
              },
              {
                "type": "text",
                "name": "cache-control"
              },
              {
                "type": "text",
                "name": "content-encoding"
              },
              {
                "type": "text",
                "name": "content-length"
              },
              {
                "type": "text",
                "name": "content-security-policy"
              },
              {
                "type": "text",
                "name": "content-type"
              },
              {
                "type": "text",
                "name": "date"
              },
              {
                "type": "text",
                "name": "etag"
              },
              {
                "type": "text",
                "name": "pragma"
              },
              {
                "type": "text",
                "name": "referrer-policy"
              },
              {
                "type": "text",
                "name": "server"
              },
              {
                "type": "text",
                "name": "status"
              },
              {
                "type": "text",
                "name": "strict-transport-security"
              },
              {
                "type": "text",
                "name": "vary"
              },
              {
                "type": "text",
                "name": "x-cdn"
              },
              {
                "type": "text",
                "name": "x-content-type-options"
              },
              {
                "type": "text",
                "name": "x-frame-options"
              },
              {
                "type": "text",
                "name": "x-iinfo"
              },
              {
                "type": "text",
                "name": "x-rack-cors"
              },
              {
                "type": "text",
                "name": "x-ratelimit-limit"
              },
              {
                "type": "text",
                "name": "x-ratelimit-remaining"
              },
              {
                "type": "text",
                "name": "x-request-id"
              },
              {
                "type": "text",
                "name": "x-runtime"
              },
              {
                "type": "text",
                "name": "x-xss-protection"
              }
            ]
          }
        ],
        "outputType": "object"
      },
      {
        "name": "apiGraph",
        "module": "api",
        "action": "send",
        "options": {
          "url": "https://sanjaychaurasia.tech/api_generateGraph.php",
          "data": {
            "data": "{{apiFundDetails.data.dataset.data}}",
            "method": "GenerateMutualFundGraph"
          },
          "method": "POST",
          "dataType": "x-www-form-urlencoded",
          "schema": []
        },
        "output": true,
        "meta": [
          {
            "type": "text",
            "name": "data"
          },
          {
            "type": "object",
            "name": "headers",
            "sub": [
              {
                "type": "text",
                "name": "content-encoding"
              },
              {
                "type": "text",
                "name": "content-length"
              },
              {
                "type": "text",
                "name": "content-type"
              },
              {
                "type": "text",
                "name": "date"
              },
              {
                "type": "text",
                "name": "server"
              },
              {
                "type": "text",
                "name": "status"
              },
              {
                "type": "text",
                "name": "vary"
              },
              {
                "type": "text",
                "name": "x-powered-by"
              }
            ]
          }
        ],
        "outputType": "object",
        "disabled": true
      },
      {
        "name": "HTML",
        "module": "core",
        "action": "setvalue",
        "options": {
          "key": "HTML",
          "value": "{{apiGraph.data}}"
        },
        "output": true
      }
    ]
  }
}
JSON
);
?>