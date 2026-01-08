# 🌐 My Bio Link

Aplicación web tipo **Link in Bio** desarrollada con **Laravel 12 y PHP 8.3**, enfocada en practicar y demostrar fundamentos sólidos de desarrollo backend moderno con Laravel.

El proyecto permite a los usuarios crear un perfil público con una foto, nombre de usuario único y una lista personalizada de enlaces, gestionados desde un panel privado con autenticación.

Más allá de la funcionalidad, el objetivo principal del proyecto es aplicar **buenas prácticas de Laravel**, validaciones, manejo de archivos, autenticación y organización del código.

---

## 🎯 Objetivo del proyecto

Este proyecto fue desarrollado con el objetivo de practicar y consolidar fundamentos clave de desarrollo backend con Laravel, enfocándose en reglas de negocio, control de acceso y relaciones entre entidades.

Se priorizó la correcta implementación de autenticación, autorización y validaciones antes que la complejidad visual o funcional.


---

## ⚙️ Funcionalidades principales

- Registro e inicio de sesión de usuarios
- Username único por usuario
- Perfil público accesible vía `/u/{username}`
- Gestión de múltiples enlaces por usuario (relación 1:N)
- Dashboard privado para administrar enlaces
- Subida de foto de perfil con validación de formato y tamaño
- Control de acceso para que cada usuario solo pueda editar su propio perfil
- Posibilidad de marcar enlaces como **contenido para mayores de edad**
- Rutas protegidas mediante middleware
- Manejo de almacenamiento con `storage:link`

---

## 🧠 Reglas de negocio implementadas

- Cada usuario debe tener un **username único**
- Un usuario puede gestionar **múltiples enlaces**
- Los enlaces deben ser únicos dentro del perfil del usuario
- Solo el propietario del perfil puede editar su información y enlaces
- Los enlaces pueden marcarse como contenido para mayores de edad
- El acceso al dashboard requiere autenticación

---

## 🚀 Tecnologías principales

- **Backend:** Laravel
- **Frontend:** Blade + Tailwind CSS
- **Base de datos:** MySQL
- **Autenticación:** Laravel Breeze

---

## 🧩 Conceptos y prácticas aplicadas

- Arquitectura MVC de Laravel
- Validaciones de formularios
- Relaciones Eloquent (1:N)
- Autenticación y autorización con Policies
- Protección de rutas y recursos
- Manejo seguro de subida de archivos
- Control de acceso basado en el usuario autenticado
- Uso de migraciones para versionado de base de datos

---

## 🛠️ Instalación local (modo desarrollo)

### 1. Clonar el repositorio

```bash
git clone https://github.com/GustavoAzabache/my-bio-link.git
cd my-bio-link
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

### 4. Crear enlace simbólico para el almacenamiento

```bash
php artisan storage:link
```

### 5. Iniciar los servidores

```bash
php artisan serve
```

```bash
npm run dev
```
