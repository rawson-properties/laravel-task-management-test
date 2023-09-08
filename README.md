# laravel-task-management-test

## Introduction:

Welcome to the practical test for the Senior Engineering position. This test is designed to assess your skills and understanding of Laravel concepts, including writing tests, working with database migrations, creating one-to-one/one-to-many relationships, creating api's and working with queues. Additionally, there is a bonus section for optimizing queues. Please read the problem statement carefully and follow the instructions provided.

## Problem Statement:

You are tasked with creating a basic web application for managing tasks. **The application should have the following features**:
 
   - Users can Create an Account.
   - Upon account creation, users will be sent an Thank You email. 
   - Users can log in and log out of their accounts.
   - Users can create, view, update, and delete tasks (CRUD).
   - Each task has a title, description, and due date (DB Fields).
   - Each task must have an owner (One-to-One Relationship).
   - Each user can have multiple tasks in their task list (Tasks that the user owns/or asigned to) (One-to-Many Relationship).

**Requirements**

Create an REST API for the above features. You are free to decide how you do this, but consider the following endpoint ideas:

   - A user can create an account
   - A user can log in the application
   - A user can log out of the application
   - A user can create a task (Secured Endpoint)
   - A user can update a task (Secured Endpoint)
   - A user can delete a task (Secured Endpoint)
   - A user can list their tasks (Secured Endpoint)

**Considerations**

   - Your API will be consumed by an SPA. It may make sense to secure the API with JWT/Oauth-like service? You are free to decide. Personally I like to use Sanctum or Passport for this.
   - Detatching the Thank You email from the account creating flow for performance and better user experience (Hint: Use a queued Job).
   - Cache the task list for 1 hour, and it should refresh after the cache expires (Bonus).

## Instructions:

1. Fork this repository and create a new branch with your name for making changes.
2. Implement changes to the application according to the problem statement.
3. Write PHPUnit tests to cover the implemented features. You don't have to cover all edge cases, just test whatever you believe is important to.
4. Create necessary migrations to set up the database schema for tasks and users.
5. Use Laravel's built-in relationships to establish the one-to-one and one-to-many relationships between tasks and users.
6. Configure and implement the background queue for sending email notifications.
7. For the bonus section, implement caching for the task listing page.

## Submission:

Submit your pull request with the completed practical test. Include any necessary instructions on running the application and tests. Be prepared to explain your code and discuss your approach if necessary.

## Note:
- No GUI is required.
- You can use any additional packages or libraries that you find helpful.
- Focus on writing clean, maintainable code (SOLID).
- Good luck! We look forward to reviewing your work!
