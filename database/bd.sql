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