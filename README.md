# 🌐 My Bio Link

Aplicación web tipo **Link in Bio**, desarrollada con **Laravel 12** y **PHP 8.3**, que permite a los usuarios crear un perfil personal con su foto, nombre de usuario y una lista personalizada de enlaces hacia sus redes sociales o sitios web.

---

## 🚀 Tecnologías principales

- **Backend:** [Laravel 12]
- **Frontend:** [Vite] + [Tailwind CSS]
- **Base de datos:** MySQL
- **Autenticación:** Laravel Breeze
- **Lenguaje:** PHP 8.3.6

---

## ⚙️ Funcionalidades principales

✅ Registro e inicio de sesión de usuarios  
✅ Subida de foto de perfil (con límite de 2MB y validación de formato)  
✅ Generación de enlaces públicos tipo `/u/{username}`  
✅ Panel de usuario (Dashboard) para gestionar enlaces
✅ Sistema de almacenamiento con `storage:link`
✅ Rutas protegidas y manejo de sesiones  

---

## Instalación local (modo desarrollo)

### 1. Clonar el repositorio

```bash
git clone https://github.com/TU_USUARIO/my-bio-link.git
cd my-bio-link
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Crear archivo de entorno

```bash
cp .env.example .env
```

### 4. Generar clave de aplicación

```bash
php artisan key:generate
```

### 5. Ejecutar migraciones y seeders

```bash
php artisan migrate
```

### 6. Crear enlace simbólico para el almacenamiento

```bash
php artisan storage:link
```

### 7. Iniciar los servidores

```bash
php artisan serve
```

```bash
npm run dev
```