# 📌 Laravel Task Management System

## 🎯 Objective  
Develop a **Task Management System** using **Laravel, SQLite, Blade, and Tailwind CSS**. This project will help you understand Laravel's MVC structure, database interactions, and styling with Tailwind CSS.

---

## ✅ Features  

### 1️⃣ User Authentication  
- **Register, login, logout** (using Laravel Breeze).  
- **Middleware protection** for authenticated users.  

### 2️⃣ Task Management (CRUD)  
- **Create**: Add a new task (Title, Description, Due Date, Priority).  
- **Read**: List tasks in a **dashboard**.  
- **Update**: Edit task details.  
- **Delete**: Remove a task.  
- **Mark as Completed**: Change task status.  

### 3️⃣ Database: SQLite  
- Uses SQLite for local database storage (`database/database.sqlite`).  

#### `users` Table  
| Column    | Type    | Description            |  
|-----------|--------|------------------------|  
| id        | int    | Primary Key            |  
| name      | string | User's full name       |  
| email     | string | Unique email           |  
| password  | string | Hashed password        |  
| timestamps |        | Created & updated at   |  

#### `tasks` Table  
| Column    | Type    | Description                      |  
|-----------|--------|----------------------------------|  
| id        | int    | Primary Key                      |  
| user_id   | int    | Foreign key (linked to users)   |  
| title     | string | Task title                      |  
| description | text | Task details                    |  
| due_date  | date   | Deadline for the task           |  
| priority  | enum   | low, medium, high               |  
| status    | enum   | to-do, in progress, completed   |  
| timestamps |        | Created & updated at            |  

---

## 🎨 UI & UX (Blade + Tailwind CSS)  
- **Blade templates** for frontend.  
- **Tailwind CSS** for styling.  
- **Task filters** (to-do, in-progress, completed).  

---

## 🌟 Bonus Features (Optional)  
✅ **Dark mode toggle** (Tailwind dark mode).  
✅ **Drag & drop tasks** using Alpine.js.  
✅ **Email notifications** for due tasks (Laravel Mail).  
✅ **Search feature** for tasks.  

---

## 🚀 Getting Started  

### 1️⃣ Clone the Repository  
```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager
