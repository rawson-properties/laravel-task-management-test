# laravel-tast-management-test

## Introduction:

Welcome to the practical test for the Junior Laravel Engineer position. This test is designed to assess your skills and understanding of Laravel concepts, including PHPUnit tests, database migrations, one-to-one and one-to-many relationships, working with queues, creating api's and caching. Additionally, there is a bonus section for optimizing queues. Please read the problem statement carefully and follow the instructions provided.

## Problem Statement:

You are tasked with creating a basic web application for managing tasks. The application should have the following features:

1. Task Management:
   - Users can create, view, update, and delete tasks.
   - Each task has a title, description, and due date.

2. One-to-One Relationship:
   - Each task can have one assigned user.
   - Each user can have only one assigned task.

3. One-to-Many Relationship:
   - Each user can have multiple tasks in their task list.
   - Each task belongs to only one user.

4. Create an API for creating, Upating and Deleting tasks. **API authentication in NOT required, but if time permits, choose between Passport and Sanctum**.

5. Queues (Bonus):
   - Implement a background queue to send email notifications to users when their task's due date is approaching (e.g., one day before the due date).
   - The email notification should contain the task details and the user's information.

6. Caching (Bonus):
   - Implement caching for the task listing page to improve application performance.
   - Cache the task list for 1 hour, and it should automatically refresh after the cache expires.

## Instructions:

1. Fork this repository and create a new branch with your name for making changes.
2. Implement the Laravel application according to the problem statement.
3. Write PHPUnit tests to cover the implemented features. You don't have to cover all edge cases, just test whatever you believe is important to.
4. Create necessary migrations to set up the database schema for tasks and users.
5. Use Laravel's built-in relationships to establish the one-to-one and one-to-many relationships between tasks and users.
6. Configure and implement the background queue for sending email notifications.
7. For the bonus section, implement caching for the task listing page.
8. Once you have completed the tasks, create a pull request with your changes.

## Submission:

Submit your pull request with the completed practical test. Include any necessary instructions on running the application and tests. Be prepared to explain your code and discuss your approach during the evaluation.

## Note:
- No GUI is required.
- You can use any additional packages or libraries that you find helpful.
- Focus on writing clean, maintainable code.
- Good luck! We look forward to reviewing your work!
