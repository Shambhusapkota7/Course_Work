# Event Management System

## Project Overview
The **Event Management System** is a dynamic web-based application developed using **PHP, MySQL, and Twig template engine**.  
It allows authenticated users to create, view, update, delete, search, and register for events.  

This project demonstrates **full CRUD functionality**, **Ajax integration**, **secure coding practices**, and **MVC-style separation using Twig**, as required by the **5CS045 – Full Stack Development** module.

The system has been deployed on the **student college server** and follows the recommended project structure provided in the coursework guidelines.

---

## Technologies Used
- PHP (Backend)
- MySQL (Database)
- Twig Template Engine
- HTML5 & CSS3
- JavaScript (Fetch API for Ajax)
- phpMyAdmin
- XAMPP (Local development)
- SSH / SCP / FTP (Server deployment)

---

## Features Implemented

### Authentication
- User registration (Sign up)
- User login
- Session-based authentication
- Logout functionality
- Protected pages (login required)

### Event Management (CRUD)
- Add new events
- View all events
- Edit existing events
- Delete events with confirmation
- Register users for events

### Search & Ajax Features
- Simple search by event name
- Advanced search (name, location, date)
- Ajax live search (autocomplete)
- Ajax validation for duplicate event names
- Dynamic results without page reload

### Security Features
- PDO prepared statements (SQL injection prevention)
- Output escaping using `htmlspecialchars()` (XSS prevention)
- CSRF token protection on forms
- Server-side and client-side validation
- Session-based access control

### User Interface
- Twig templates for clean separation of logic and UI
- Custom CSS (no frameworks)
- Responsive layout
- Styled buttons, tables, and forms

## 📁 Project Structure

Event Management System/
├── ajax/
│   ├── search_autocomplete.php   # Ajax live search (autocomplete)
│   └── validate.php              # Ajax validation (event name check)
│
├── assets/
│   ├── css/
│   │   └── style.css             # Global site styling
│   └── js/
│       ├── ajax.js               # Live search Ajax logic
│       └── validation.js         # Real-time form validation
│
├── config/
│   └── db.php                    # Database connection (PDO)
│
├── includes/
│   ├── csrf.php                  # CSRF token generation & validation
│   ├── functions.php             # Helper functions (escape, etc.)
│   ├── header.php                # Shared header
│   └── footer.php                # Shared footer
│
├── public/
│   ├── index.php                 # List events (READ)
│   ├── add.php                   # Add new event (CREATE)
│   ├── edit.php                  # Edit event (UPDATE)
│   ├── delete.php                # Delete event (DELETE)
│   ├── search.php                # Advanced search
│   ├── login.php                 # User login
│   ├── signup.php                # User registration
│   └── logout.php                # User logout
│
├── sql/
│   └── database.sql              # Database schema & sample data
│
├── templates/                    # Twig templates
│   ├── layout.twig               # Base layout (header, footer)
│   ├── event_list.twig           # Event listing page
│   ├── event_form.twig           # Add/Edit event form
│   ├── search_results.twig       # Search results page
│   ├── login.twig                # Login UI
│   └── signup.twig               # Signup UI
│
├── vendor/                       # Composer dependencies (Twig)
├── composer.json                 # Composer configuration
├── composer.lock                 # Composer lock file
└── README.md                     # Project documentation


## Database Setup

1. Open **phpMyAdmin**
2. Create a database named:
3. Import:

### Tables Included
- `users`
- `events`
- `event_registrations`

---

## Configuration

Update database credentials in:

Example:
```php
$host = "localhost";
$db   = "np02cs4a240060";
$user = "np02cs4a240060";
$pass = "YOUR_PASSWORD";
How to Run (Localhost)

1. Start Apache and MySQL using XAMPP

2 .Place the project inside:
C:\xampp\htdocs\Course_Work\

3. Access via browser:

http://localhost/Course_Work/Event%20Management%20System/public/index.php
H
## Hosting on Student Server

1 . Upload the entire project root folder (not zipped) to:
~/public_html/
2. Import sql/database.sql using server phpMyAdmin
3. Update database credentials in config/db.php
4. Access the system via:
https://student.bicnepal.edu.np/~np02cs4a240060/Event%20Management%20System/public/index.php

Known Issues

*  No file or image upload feature (not required)

*  Ajax paths depend on correct folder placement

*  Spaces in folder name require %20 encoding
Conclusion

This project fulfills all requirements of the Full Site Implementation task, including:

*  CRUD operations

*  Authentication system

*  Secure coding practices

*  Ajax-based interactivity

*  MVC-style separation using Twig

*  The system is fully functional, well-structured, and ready for assessment submission.

##Author
Student Name: Bhawanath Sapkota
Module: 5CS045 – Full Stack Development
Academic Year: 2025–2026