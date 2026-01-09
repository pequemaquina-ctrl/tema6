# 🔐 Sistema de Autenticación en PHP

Proyecto sencillo de **autenticación de usuarios** desarrollado en PHP. Incluye funcionalidades básicas como **registro**, **inicio de sesión**, **cierre de sesión** y **perfil de usuario**, ideal para practicar fundamentos de backend y manejo de sesiones.

---

## 🚀 Funcionalidades

* ✅ Registro de usuarios
* 🔑 Inicio de sesión
* 👤 Perfil de usuario
* 🚪 Cierre de sesión
* 🔐 Manejo de sesiones con PHP

---

## 📁 Estructura del proyecto

```bash
/
├── index.php        # Página principal
├── login.php        # Inicio de sesión
├── registro.php     # Registro de usuarios
├── perfil.php       # Perfil del usuario (requiere sesión)
├── logout.php       # Cierre de sesión
└── README.md        # Documentación del proyecto
```

---

## 🧠 Descripción de archivos

### 🏠 `index.php`

Página principal del sistema. Puede mostrar contenido público o redirigir según el estado de la sesión.

---

### 🔑 `login.php`

Formulario y lógica para **iniciar sesión**. Valida credenciales y crea la sesión del usuario.

---

### 📝 `registro.php`

Permite a nuevos usuarios **registrarse** en el sistema.

---

### 👤 `perfil.php`

Zona protegida que muestra información del usuario autenticado.

> ⚠️ Requiere que la sesión esté iniciada.

---

### 🚪 `logout.php`

Cierra la sesión activa y redirige al usuario.

---

## ▶️ Cómo ejecutar el proyecto

1. Tener PHP instalado (8.x recomendado)
2. Colocar el proyecto en un servidor local (XAMPP, WAMP, Laragon, etc.)
3. Acceder desde el navegador:

```text
http://localhost/nombre-del-proyecto
```

---

## 🎯 Objetivo del proyecto

Este proyecto tiene fines **educativos** y está pensado para:

* Practicar PHP puro
* Entender el flujo de autenticación
* Aprender manejo de sesiones
* Servir como base para proyectos más grandes

---

## ✨ Posibles mejoras

* Hash de contraseñas (`password_hash`)
* Validaciones más robustas
* Conexión a base de datos
* Roles de usuario
* Protección contra ataques comunes (CSRF, XSS)

---

## 🧑‍💻 Autor

Desarrollado por **Ismael Amador Serrano** como proyecto de práctica.

---

⭐ Si te resulta útil, no olvides dejar una estrella en el repositorio
