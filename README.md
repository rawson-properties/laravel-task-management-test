##### Frontend API Integration Guide

This guide demonstrates how to use the API provided the task management backend. 
You can use this guide to understand how to register a user, authenticate, perform CRUD operations on tasks, and log out.

##### Prerequisites

Before you start, ensure that you have the following prerequisites:

- A web frontend application or tool for making API requests (e.g. Postman).
- Access to the backend API endpoints.

##### User Registration

To register a new user, send a POST request to the registration endpoint:
Please note that registering does not require Bearer token header

```
POST /api/users/register
```

Include the following JSON payload in the request body:

```json
{
    "name": "Your Name",
    "email": "your@email.com",
    "password": "your_password",
    "confirm_password": "your_password"
}
```

Upon successful registration, you will receive a response with a user object, 
including an access token for authentication.

##### Authentication

To authenticate a user, send a POST request to the login endpoint:

```
POST /api/users/login
```

Include the following JSON payload in the request body:

```json
{
    "email": "your@email.com",
    "password": "your_password"
}
```

Upon successful authentication, you will receive a response with a user object and an access token.

##### CRUD Operations on Tasks

You can perform CRUD (Create, Read, Update, Delete) operations on tasks for the authenticated user.

##### Create a Task

To create a new task, send a POST request to the task creation endpoint:

```
POST /api/users/{user_id}/tasks
```

Include the following JSON payload in the request body:

```json
{
    "title": "Task Title",
    "description": "Task Description",
    "due_date": "YYYY-MM-DD"
}
```

Replace `{user_id}` with the authenticated user's ID.

##### Retrieve Tasks

To retrieve all tasks for the authenticated user, send a GET request to the task retrieval endpoint:

```
GET /api/users/{user_id}/tasks
```

Replace `{user_id}` with the authenticated user's ID.

##### Update a Task

To update an existing task, send a PUT request to the task update endpoint:

```
PUT /api/users/{user_id}/tasks/{task_id}
```

Include the following JSON payload in the request body:

```json
{
    "title": "Updated Task Title",
    "description": "Updated Task Description"
}
```

Replace `{user_id}` with the authenticated user's ID and `{task_id}` with the ID of the task to update.

##### Delete a Task

To delete an existing task, send a DELETE request to the task deletion endpoint:

```
DELETE /api/users/{user_id}/tasks/{task_id}
```

Replace `{user_id}` with the authenticated user's ID and `{task_id}` with the ID of the task to delete.

##### Logging Out

To log out and invalidate the access token, send a DELETE request to the logout endpoint:

```
DELETE /api/users/logout
```
