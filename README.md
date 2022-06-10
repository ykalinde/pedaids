# Documentation

Before you get started, make sure you have the following install
* PHP 8.0 or higher
* Curl
* Composer (The PHP package manager)


Navigate to the project directory
* Install the project dependencies by running the following command

```
composer install
```
* Create a database on your local MySQL installation by running the following query
  
```mariadb
CREATE DATABASE egpaf;
```

* Configure your MySQL connection properties by editing the ``` .env ``` file in the project root. Modify the following fields to match your MySQL setup
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=egpaf
DB_USERNAME=root
DB_PASSWORD=S3cret
```


* Run (serve) the API by running the following command

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

Generate a new key by running the following cURL command

```
curl -X POST "http://localhost:8000/api/keys/generate"
```

To disable a particular key, running the following cURL command
```
curl -X POST "http://localhost:8000/api/keys/disable" -H "Accept: application/json" -H "Content-Type: application/json" --data '{"key": "UREDNGLWB"}'
```
