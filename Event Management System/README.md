# Event Management System

## Project Overview
The Event Management System is a dynamic web application developed using **PHP** and **MySQL**.  
It allows users to create, view, update, delete, search, and register for events.  
The system demonstrates full CRUD functionality, secure coding practices, and Ajax integration as required by the **5CS045 – Full Stack Development** module.

This project is designed to resemble a real-world event management platform and follows the recommended project structure provided in the assignment guidelines.

---

## Technologies Used
- PHP (Backend)
- MySQL (Database)
- HTML5 & CSS3
- JavaScript (Fetch API for Ajax)
- phpMyAdmin
- XAMPP (Local development)

---

## Features Implemented

### Core Features
- Create new events
- View all events in a table
- Edit existing events
- Delete events with confirmation
- Register attendees for events

### Search Features
- Simple keyword search
- Advanced search (keyword, location, date)
- Ajax live search with autocomplete
- Clickable search suggestions to display related event data

### Security Features
- SQL Injection prevention using PDO prepared statements
- XSS prevention using `htmlspecialchars()`
- Server-side and client-side form validation
- CSRF protection implemented (optional feature)

### User Interface
- Custom CSS (no frameworks)
- Styled navigation, buttons, forms, and tables
- Responsive layout for smaller screens

---

## Project Structure

project_root/
│── config/
│ └── db.php
│── public/
│ ├── index.php
│ ├── add.php
│ ├── edit.php
│ ├── delete.php
│ ├── search.php
│ └── register.php
│── ajax/
│ └── search_autocomplete.php
│── assets/
│ ├── css/
│ │ └── style.css
│ └── js/
│ └── ajax.js
│── includes/
│ ├── header.php
│ ├── footer.php
│ └── functions.php
│── sql/
│ └── database.sql
└── README.md

---

## Database Setup

1. Open **phpMyAdmin**
2. Create a new database named:
## event_management
3. Import the file:

## sql/database.sql
4. The database includes:
- `events` table
- `attendees` table
- Sample data for testing

---

## Configuration

Update database credentials in:

## config/db.php

Example:
```php
$host = "localhost";
$db   = "event_management";
$user = "root";
$pass = "";

How to Run the Project (Localhost)

1. Start Apache and MySQL using XAMPP

2. Place the project folder inside:
C:\xampp\htdocs\

3. Open a browser and navigate to:
http://localhost/event_management/public/index.php

Hosting on Student Server

1. Upload the full project folder to the student server using FTP
2. Import database.sql using the server’s phpMyAdmin
3. Update database credentials in db.php
4 .Access the site via the provided student server URL

Known Issues

*   No file upload feature is included (not required for this project)

*    Authentication/login system is not implemented as it is optional

Conclusion

This project fulfills all the requirements of the Full Site Implementation task, including CRUD operations, secure coding practices, search functionality, and Ajax integration. The system is fully functional, well-structured, and ready for demonstration and submission.

Author

Student Name: Bhawanath Sapkota
Module: 5CS045 – Full Stack Development
Academic Year: 2025–2026



---

## ✅ FINAL STATUS
- ✔ README meets submission requirements  
- ✔ Matches assignment wording  
- ✔ Clear, professional, examiner-friendly  
- ✔ No unnecessary content  

If you want, I can:
- ✍️ Personalize it with **your name & ID**
- 📋 Create a **final submission checklist**
- 🎤 Prepare **demo explanation answers**

Just tell me 👍
