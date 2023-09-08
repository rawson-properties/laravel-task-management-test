# laravel-task-management-test

## Introduction:

Welcome to the practical test for the Senior Engineering position. This test aims to evaluate your proficiency in Laravel, covering aspects such as writing tests, working with database migrations, creating relationships, building APIs, and utilising queues. Additionally, there's a bonus section focused on optimisation (Caching). Please carefully read the problem statement and adhere to the provided instructions.

## Problem Statement:

You have been assigned the task of developing a basic web application for task management. The application should encompass the following functionalities:

   - User Registration
   - Sending a Thank You email upon registration
   - User Login and Logout
   - CRUD operations for tasks
   - Tasks should have a title, description, and due date (database fields)
   - Each task should be associated with an owner (One-to-One Relationship)
   - Each user can have multiple tasks in their task list (One-to-Many Relationship)

**Requirements**

Establish a REST API to facilitate the above functionalities. You have the flexibility to decide on the specific endpoints, but consider the following suggestions:

   - User account creation
   - User login
   - User logout
   - Task creation (Secured Endpoint)
   - Task update (Secured Endpoint)
   - Task deletion (Secured Endpoint)
   - Task listing for a user (Secured Endpoint)

**Considerations**

   - The API will be consumed by an SPA. Consider implementing JWT/OAuth-like services for security. You are free to choose, as long as you can justify your decision. I personally recommend using Sanctum or Passport due to their robust maintenance as core Laravel packages.
   - Separate the Thank You email from the account creation flow for enhanced performance and user experience. (Hint: Utilise a queued Job).
   - Implement caching for the task list, with a cache duration of 1 hour. The cache should be cleared after expiration (Bonus).

## Instructions:

1. Fork this repository and create a new branch with your name for making changes.
2. Implement changes to the application according to the problem statement.
3. Write PHPUnit tests to cover the implemented features. Focus on testing critical functionalities.
4. Create necessary migrations to set up the database schema for tasks and users.
5. Use Laravel's built-in relationships to establish the one-to-one and one-to-many relationships between tasks and users.
6. Configure and implement the background queue for sending email notifications.
7. For the bonus section, implement caching for the task listing page.
8. For exceptional distinction, provide documentation on how a frontend developer can authenticate with the API.

## Submission:

Submit your pull request with the completed practical test. Include any necessary instructions on running the application and tests. Be prepared to explain your code and discuss your approach if necessary.

## Note:
- No graphical user interface (GUI) is required.
- You may utilise any additional packages or libraries that you find beneficial.
- Prioritise writing clean, maintainable code (SOLID principles).
- Best of luck! We eagerly anticipate reviewing your work!
