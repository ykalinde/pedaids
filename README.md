# Testing for Code

Before you get started, make sure you have the following install
* PHP 8.0 or higher
* Curl

Navigate to the setup directory and run the following command to serve the api

```
php artisan serve
```

Note: Keep the terminal open

## Maximini
Open a new terminal or command line window and run the following command to test. 
```
curl -X GET "http://localhost:8000/api/minmax?number=357758017083851"
```

## Query Tables
You can specify the table, fields to select and conditions to filter the results. 
The parameters can be specified using the following format

```
{
    "table": "patients",
    "fields": [
        "first_name", "last_name","sex","dob"
    ],
    "conditions": [
        {
            "field": "last_name",
            "condition": "like",
            "value": "kalinde"
        },
        {
            "field": "sex",
            "condition": "=",
            "value": "male"
        }
    ]
}
```
To test the functionality, use the following cURL command which tests the example above

```
curl -X POST "http://localhost:8000/api/tables/query" -H "Accept: application/json" -H "Content-Type: application/json" --data '{"table":"patients","fields":["first_name","last_name"
,"sex","dob"],"conditions":[{"field":"last_name","condition":"like","value":"kalinde"},{"field":"sex","condition":"=","value":"male"}]}'
```
To query aggregates, instead of passing the fields property, pass the aggregate property in the format below:

```
{
    "table": "patients",
    "conditions": [
        {
            "field": "district",
            "condition": "=",
            "value": "Blantyre"
        }
    ],
    "aggregate": {
        "function": "COUNT",
        "field": "sex"
    }
}
```

Run the following cURL command to test the functionality
```
curl -X POST "http://localhost:8000/api/tables/query" -H "Accept: application/json" -H "Content-Type: application/json" --data '{"table":"patients","conditions":[{"field":"district",
"condition":"=","value":"Blantyre"}],"aggregate":{"function":"COUNT","field":"sex"}}'
```

## Generate Keys
