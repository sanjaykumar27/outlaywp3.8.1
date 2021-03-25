dmx.config({
  "TargetList": {
    "repeattargets": {
      "meta": [
        {
          "name": "$index",
          "type": "number"
        },
        {
          "name": "$key",
          "type": "text"
        },
        {
          "name": "$value",
          "type": "object"
        },
        {
          "name": "id",
          "type": "text"
        },
        {
          "name": "target_name",
          "type": "text"
        },
        {
          "name": "target_amount",
          "type": "number"
        },
        {
          "name": "target_description",
          "type": "text"
        },
        {
          "name": "target_photo",
          "type": "text"
        },
        {
          "name": "IsCompleted",
          "type": "boolean"
        },
        {
          "name": "CreatedOn",
          "type": "datetime"
        },
        {
          "name": "TotalDebit",
          "type": "number"
        },
        {
          "name": "TotalCredit",
          "type": "number"
        }
      ],
      "outputType": "array"
    }
  },
  "spa_emiList": {
    "repeatEmi": {
      "meta": [
        {
          "name": "id",
          "type": "text"
        },
        {
          "name": "userid",
          "type": "text"
        },
        {
          "name": "loan_name",
          "type": "text"
        },
        {
          "name": "starting_date",
          "type": "date"
        },
        {
          "name": "ending_date",
          "type": "date"
        },
        {
          "name": "total_amount",
          "type": "number"
        },
        {
          "name": "no_of_emi",
          "type": "number"
        },
        {
          "name": "interest_amount",
          "type": "number"
        },
        {
          "name": "paid_via",
          "type": "text"
        },
        {
          "name": "cash_paid",
          "type": "number"
        },
        {
          "name": "status",
          "type": "number"
        }
      ],
      "outputType": "array"
    }
  },
  "EMIDEtails": {
    "repeatEmis": {
      "meta": [
        {
          "name": "id",
          "type": "text"
        },
        {
          "name": "loan_id",
          "type": "number"
        },
        {
          "name": "due_date",
          "type": "date"
        },
        {
          "name": "paid_on",
          "type": "date"
        },
        {
          "name": "loan_amount",
          "type": "number"
        },
        {
          "name": "status",
          "type": "number"
        }
      ],
      "outputType": "array"
    }
  },
  "MutualFunds": {
    "repeatFunds": {
      "meta": [
        {
          "name": "fund_id",
          "type": "text"
        },
        {
          "name": "code",
          "type": "number"
        },
        {
          "name": "name",
          "type": "text"
        },
        {
          "name": "description",
          "type": "text"
        },
        {
          "name": "refreshed_at",
          "type": "datetime"
        },
        {
          "name": "from_date",
          "type": "date"
        },
        {
          "name": "to_date",
          "type": "date"
        }
      ],
      "outputType": "array"
    }
  }
});
