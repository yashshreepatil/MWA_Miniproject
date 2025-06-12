# Prachiti International School – Student Management System

This is a web-based student information system created for **Prachiti International School** as part of the Modern Web Applications (MWA) mini-project.

It includes admin and student modules, login authentication, a connected MySQL database, and features such as student info management, fee tracking, timetable updates, and marksheet generation.

---

## 🔧 Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL (via XAMPP)

---

## ✅ Features

- 🔐 **Login System**
  - Admin login (username & password)
  - Student login (Roll number & DOB)

- 👨‍🎓 **Student Record Management**
  - Add/view student data
  - Fee status tracking

- 🗓 **Timetable Upload**
  - Admin can update class timetables

- 🧾 **Marksheet Display**
  - Admin can enter exam marks
  - Students can view their individual marksheet

- 🎯 **Role-Based Dashboards**
  - Separate views for admin and student users

---

## 📂 Project Structure

```bash
MWA_Miniproject/
├── admin/
│   ├── dashboard.php
│   ├── login.php
│   ├── add_student.php
│   ├── enter_marks.php
│   ├── timetable_upload.php
│   └── ...other admin pages
├── student/
│   ├── dashboard.php
│   ├── login.php
│   ├── view_marksheet.php
│   ├── view_timetable.php
│   └── ...other student pages
├── css/
│   └── styles.css
├── js/
│   └── script.js
├── images/ (if used)
├── database.sql (if exported)
└── index.html (or index.php )
