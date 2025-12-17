# WEB - RESTAURANTE - SISTEMA DE PEDIDOS

Sistema web de restaurante con carrito de compras, categorías, productos, gestión de pedidos y envío de correo de confirmación. Desarrollado en PHP puro con MySQL.

Proyecto realizado como trabajo de clase, ejecutado en entorno local con XAMPP.

## 📦 Tech Stack

- **Lenguaje: PHP (versión 8.x recomendada)**
- **Base de datos: MySQL**
- **Servidor local: XAMPP (Apache + MySQL)**
- **Envío de correos: PHPMailer**
- **Gestión de sesiones: PHP nativo**
- **Frontend: HTML + CSS básico + PHP (sin framework)**

# 🛠️ Setup & Installation
### Requisitos
   XAMPP instalado y funcionando (Apache + MySQL).
   Descarga: https://www.apachefriends.org/es/index.html

### Instalación

1. Clona el repositorio en tu máquina local.
2. Abre el archivo `.env.example` y renombra a `.env`
3. Rellena tus credenciales de Gmail (usa una App Password) en el archivo `.env`
4. Ejecuta el proyecto

# 📝 Notas

El carrito se guarda en $_SESSION, por lo que se pierde al cerrar el navegador si no hay login persistente.
El envío de correo requiere una cuenta real con SMTP configurado (recomendado usar una app password de Gmail).
Proyecto educativo, sin encriptación avanzada ni medidas de seguridad para producción.
