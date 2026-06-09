# ApexPlanet Internship - Task 02

## CRUD Blog Application with User Authentication

### Project Overview

This project is a PHP and MySQL-based CRUD (Create, Read, Update, Delete) Blog Application developed as part of ApexPlanet Internship Task 02.

The application allows users to register, log in securely, create blog posts, view their posts, update existing posts, and delete posts. User authentication is implemented using PHP sessions and password hashing.

---

## Features

### User Authentication

* User Registration
* User Login
* User Logout
* Session Management
* Password Hashing using `password_hash()`
* Password Verification using `password_verify()`

### CRUD Operations

* Create New Blog Posts
* View Personal Blog Posts
* Edit Existing Posts
* Delete Posts

### User Interface

* Responsive Design using Bootstrap 5
* Navigation Bar
* Dashboard Page
* Success and Error Alerts

---

## Technologies Used

* PHP
* MySQL
* HTML5
* CSS3
* Bootstrap 5
* XAMPP
* Git & GitHub

---

## Project Structure

```text
crud_blog/
│
├── assets/
│   ├── css/
│   └── images/
│
├── auth/
│   ├── login.php
│   ├── logout.php
│   └── register.php
│
├── config/
│   └── database.php
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── navbar.php
│
├── posts/
│   ├── create.php
│   ├── view.php
│   ├── edit.php
│   └── delete.php
│
├── database/
│   └── blog.sql
│
├── README.md
│
└── index.php
```

---

## Database Setup

### Create Database

```sql
CREATE DATABASE blog;
```

### Import Database

1. Open phpMyAdmin
2. Create a database named `blog`
3. Click on the database
4. Select **Import**
5. Choose `blog.sql`
6. Click **Go**

---

## Installation Steps

1. Install XAMPP
2. Start Apache and MySQL
3. Clone this repository

```bash
git clone https://github.com/24A31A4417/apexplanet-task2.git
```

4. Move the project folder to:

```text
C:\xampp\htdocs\
```

5. Import the database file (`blog.sql`)
6. Configure database credentials in:

```text
config/database.php
```

7. Open the application:

```text
http://localhost/crud_blog/
```

---

## Application Workflow

1. Register a new account
2. Login using registered credentials
3. Create a blog post
4. View your posts
5. Edit existing posts
6. Delete unwanted posts
7. Logout securely

---

## Screenshots

Add screenshots of:

* Registration Page
* Login Page
* Dashboard
* Create Post Page
* View Posts Page

---

## Future Enhancements

* Prepared Statements for enhanced security
* Search Functionality
* User Profile Management
* Pagination
* Rich Text Editor
* AJAX Integration

---

## Author

**Name:** Bhavyasri

Developed as part of the **ApexPlanet Internship - Task 02**

---
