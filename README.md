# Testing for Code

### Before you get started make sure you have the following install
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
