<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About App

The application contains two pages: Issues and Platforms. On the Platform page, there is the possibility to create, edit and delete the API routes of the respective services. All types of validation are included. On the Issues page, there is a Check Issue button that opens a modal with a form where you enter the term for which issues are being checked. All types of validation are included. If the term does not exist in the database, the Service is called, which via the GitHub API routes https://api.github.com/search/issues?q={word}+rocks and https://api.github.com/search/issues? q={word}+sucks where the first URL examines positive issues for the search term {word} and the second one for negative ones. If the term exists in the database, it is printed on the page. In case the given term is not found on GitHub (or other service), the message "No data!" is displayed.

The following were used to create the Application:
- Laravel 9.19,
- Bootstrap 5.2.3,
- jQuery 3.3.1,
- Guzzle 7.2,
- Axios 1.1.2

## JSON API

The JSON API is a specification for building APIs that provide resources in a consistent and standardized way using JSON as the data format.
Some key aspects and examples of using the JSON API:


1. Resource Objects:
The JSON API represents resources as objects. Each resource has a unique identifier (id), a type (type), and attributes (attributes). For example:

{
  "data": {
    "id": "1",
    "type": "users",
    "attributes": {
      "name": "Boban Petkovic",
      "email": "petkovic.boban@gmail.com"
    }
  }
}

e.g
PopularityController lines 87-92



2. Relationships:
The JSON API allows defining relationships between resources. Relationships can be represented as links or included in the response. For example, a user resource with a relationship to posts:

{
  "data": {
    "id": "1",
    "type": "users",
    "attributes": {
      "name": "Boban Petkovic",
      "email": "petkovic.boban@gmail.com"
    },
    "relationships": {
      "posts": {
        "links": {
          "self": "/users/1/relationships/posts",
          "related": "/users/1/posts"
        }
      }
    }
  }
}

e.g
Passing properties to the blade file in PopularityController lines 32 (31-35)



3. Pagination:
JSON API provides standardized pagination using the page query parameter. It allows specifying the page number and size to retrieve a subset of resources. For example:

GET /api/posts?page[number]=2&page[size]=10

e.g
Laravel pagination used in app



4. Filtering:
JSON API supports filtering resources based on specific criteria. Filters can be applied using query parameters. For example, filtering posts by the author's name:

GET /api/posts?filter[author]=Boban%20Petkovic



5. Sorting:
JSON API allows sorting resources by one or more fields. Sorting can be specified using query parameters. For example, sorting posts by creation date in descending order:

GET /api/posts?sort=-created_at



6. Error Handling:
JSON API provides a standardized format for error responses. It includes an array of error objects with details about each error. For example:

{
  "errors": [
    {
      "status": "404",
      "title": "Resource Not Found",
      "detail": "The requested resource could not be found."
    }
  ]
}

e.g
function showErrors(error), app.js line 138-147


## Further development

After cloning repo the sequence of actions is as follows:

- composer install
- npm install
- php artisan migrate
- npm run dev
- php artisan serve

If there are no API routes entered that are manipulated in the services, the application issues a warning that it is necessary to create routes for at least one service. This is done on the Platforms page. After creating the routes from the Issues page, a search is made for the popularity of the given term.
In PopularityController, the request is first validated, and after success, the given term is checked if it exists in the database. If it exists, data read from the database are sent to the view. If it does not exist, Dependency Injection CalculateScoreService is performed, where the Guzzle package was used, requests are sent to specific endpoints (previously defined on the Platforms page).
From the response, the total_count properties are used according to the given conditions in the task and in this way the required score is obtained and it is entered into the database together with the term and the id of the platform to which the requests were sent.
Finally, the obtained data is displayed in the popularity.index file. All previous term searches are also displayed in tabular form.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
