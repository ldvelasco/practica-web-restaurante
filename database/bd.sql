-- Tabla Restaurantes
CREATE TABLE IF NOT EXISTS Restaurantes (
    CodRes VARCHAR(10) PRIMARY KEY,
    Correo VARCHAR(100) NOT NULL,
    Clave VARCHAR(100) NOT NULL,
    Pais VARCHAR(50),
    CP VARCHAR(10),
    Ciudad VARCHAR(50),
    Direccion VARCHAR(150)
);

-- Tabla Pedidos
CREATE TABLE IF NOT EXISTS Pedidos (
    CodPed VARCHAR(10) PRIMARY KEY,
    Fecha DATE NOT NULL,
    Enviado BOOLEAN DEFAULT FALSE,
    Peso DECIMAL(10,2),
    Restaurante VARCHAR(10),
    FOREIGN KEY (Restaurante) REFERENCES Restaurantes(CodRes)
);

-- Tabla Categorias
CREATE TABLE IF NOT EXISTS Categorias (
    CodCat VARCHAR(10) PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Descripcion TEXT
);

-- Tabla Productos
CREATE TABLE IF NOT EXISTS Productos (
    CodProd VARCHAR(10) PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    Peso DECIMAL(10,2),
    Stock INT,
    Categoria VARCHAR(10),
    FOREIGN KEY (Categoria) REFERENCES Categorias(CodCat)
);

-- Tabla PedidosProductos
CREATE TABLE IF NOT EXISTS PedidosProductos (
    CodPedProd VARCHAR(10) PRIMARY KEY,
    Pedido VARCHAR(10),
    Producto VARCHAR(10),
    Unidades INT NOT NULL,
    FOREIGN KEY (Pedido) REFERENCES Pedidos(CodPed),
    FOREIGN KEY (Producto) REFERENCES Productos(CodProd)
);

-- Insertat Restaurante
INSERT INTO restaurantes (CodRes, Ciudad, Correo) VALUES (1, 'Madrid Centro', 'madrid1@empresa.com');

-- Insertar las 3 categorías
INSERT IGNORE INTO categorias (CodCat, Nombre) VALUES
(1, 'Bebidas con alcohol'),
(2, 'Bebidas sin alcohol'),
(3, 'Comida');

-- Insertar Productos
INSERT INTO productos (CodProd, Nombre, Descripcion, Peso, Categoria) VALUES
(1, 'Cerveza Alhambra', '24 Botellas 33cl', 10.0, 1),
(2, 'Cerveza Mahou', '24 Botellas 33cl', 10.0, 1),
(3, 'Vino Tinto', '6 botellas 0.75l', 5.5, 1),
(4, 'Agua Mineral', '24 Botellas', 6.0, 2),
(5, 'Coca-Cola', '24 Botellas', 12.0, 2),
(6, 'Zumo Naranja', '6 bricks', 5.0, 2),
(7, 'Paella', 'Paella mixta', 1.2, 3),
(8, 'Hamburguesa', 'Con queso', 0.25, 3),
(9, 'Pizza', 'Margarita', 0.8, 3);