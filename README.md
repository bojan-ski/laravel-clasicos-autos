# 🚗 Clásicos Autos

**Clásicos Autos** is a Laravel-based web application for listing, browsing, and exploring vintage cars.  
With a Cuban-inspired theme, the platform offers a clean and responsive interface where users can showcase and interact around old-timer automobiles. 

---

## ✨ Features

### 👤 Regular User
- 🔐 Authentication: Sign up, Sign in, Forgot/Reset password  
- 📜 Scroll, search & filter car listings  
- 🚘 Create car listings with optimized image processing using **Intervention**
- ⚖️ Compare car listings  
- ⭐ Bookmark car listings  
- 💬 Message car listing owners  
- 👤 Profile update with delete own account option  

### 🛡️ Admin User
- 🔐 Authentication: Sign up  
- 📜 Scroll, search & filter car listings  
- ⚖️ Compare car listings  
- ⭐ Bookmark car listings  
- 💬 Monitor all conversations with option to delete messages  
- 👥 View list of all app users with option to delete accounts  

---

## 🛠️ Tech Stack
- **Framework**: [Laravel 12](https://laravel.com/)  
- **Database**: [MySQL](https://www.mysql.com/)  
- **Templating**: [Blade Templates](https://laravel.com/docs/blade)  
- **Image Handling**: [Intervention](https://intervention.io/) (resize & compression) 
- **Frontend Styling**: [Tailwind CSS](https://tailwindcss.com/) + [daisyUI](https://daisyui.com/)  

---

## 🚀 Getting Started

### 1. Clone the Repository
```bash
git clone https://github.com/bojan-ski/laravel-clasicos-autos.git
cd laravel-clasicos-autos
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup - .env
```env
DB_CONNECTION=mysql
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### 4. Run Migrations & Seed Database
```bash
php artisan migrate --seed
```

### 5. Start Servers
```bash
php artisan serve
npm run dev
```

---

## 👨‍💻 Author
Developed with ❤️ by BPdevelopment (bojan-ski)