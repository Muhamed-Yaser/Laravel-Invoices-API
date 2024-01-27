<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postalCode' => $this->postal_code,
            'invoices' => InvoiceResource::collection($this->whenLoaded('invoices')) //to load invoices for customers when its value in the route is ture
        ];
    }
}
/*
----why resource ----

In Laravel, a resource is a way of defining a RESTful controller with a set of predefined methods for common CRUD (Create, Read, Update, Delete) operations. The resource controller simplifies the process of handling HTTP requests related to a specific resource (e.g., posts, users, comments) by providing a set of conventions and boilerplate code.

Here are some reasons why you might choose to use a resource controller in Laravel:

Consistent Naming Conventions:
Resource controllers follow a consistent naming convention for controller methods and route names. This makes it easier to understand and maintain your code. For example, the index, create, store, show, edit, update, and destroy methods correspond to standard CRUD operations.

Reduced Boilerplate Code:
By using a resource controller, you can reduce the amount of boilerplate code needed to handle common CRUD operations. Laravel automatically generates the routes and associated controller methods for you, saving development time and effort.

RESTful Routes:
Resource controllers adhere to RESTful principles, making your API or web application more organized and predictable. RESTful routes follow standard conventions for resource URIs and HTTP methods, improving the overall design and usability of your application.

Easy Route Declaration:
Declaring routes for a resource is simplified using the Route::resource or Route::apiResource methods. This makes it clear and concise to define routes for standard CRUD operations.

Controller Method Organization:
Resource controllers encourage the organization of related controller methods. For example, all methods related to displaying and managing a resource are grouped within a single controller, enhancing code readability and maintainability.

Eloquent ORM Integration:
Resource controllers often work seamlessly with Laravel's Eloquent ORM. Eloquent models can be used to interact with the database, making it easy to perform database operations within the controller methods.

we used it here to modfiy on postal_code and delete created_at and updated_at '''' they are useful with authorized users who signed up but normal users , its better to delelet becuse the are useless
*/
