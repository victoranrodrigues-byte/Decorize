CREATE DATABASE mobiliaria;
USE mobiliaria;
SET default_storage_engine = InnoDB;

-- =========================
-- TABELA USER
-- =========================
CREATE TABLE User (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Email VARCHAR(150) NOT NULL UNIQUE,
    Senha VARCHAR(255) NOT NULL,
    DataDeCriacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABELA PROJETO
-- =========================
CREATE TABLE Projeto (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    DataDeCriacao DATETIME DEFAULT CURRENT_TIMESTAMP,

    FK_IDusuario INT NOT NULL,

    CONSTRAINT fk_projeto_usuario
        FOREIGN KEY (FK_IDusuario)
        REFERENCES User(ID)
        ON DELETE CASCADE
);

-- =========================
-- TABELA IMAGEM
-- =========================
CREATE TABLE Imagem (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    URL VARCHAR(500) NOT NULL,
    DataUpload DATETIME DEFAULT CURRENT_TIMESTAMP,

    FK_IDProjeto INT NOT NULL,

    CONSTRAINT fk_imagem_projeto
        FOREIGN KEY (FK_IDProjeto)
        REFERENCES Projeto(ID)
        ON DELETE CASCADE
);

-- =========================
-- TABELA MOBILIA
-- =========================
CREATE TABLE Mobilia (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Dimensoes VARCHAR(100),
    Cor VARCHAR(50),
    Tipo VARCHAR(50)
);

-- =========================
-- TABELA MODELO_2D
-- =========================
CREATE TABLE Modelo_2D (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    DadosModelo TEXT,
    DataDeCriacao DATETIME DEFAULT CURRENT_TIMESTAMP,

    FK_IDimagem INT UNIQUE,

    CONSTRAINT fk_modelo_imagem
        FOREIGN KEY (FK_IDimagem)
        REFERENCES Imagem(ID)
        ON DELETE CASCADE
);

-- =========================
-- TABELA ITEM_MODELO
-- =========================
CREATE TABLE Item_Modelo (
    ID INT AUTO_INCREMENT PRIMARY KEY,

    PosicaoX DECIMAL(10,2),
    PosicaoY DECIMAL(10,2),

    Escala DECIMAL(10,2),
    Rotacao DECIMAL(10,2),

    FK_IDmobilia INT NOT NULL,
    FK_IDmodelo INT NOT NULL,

    CONSTRAINT fk_item_mobilia
        FOREIGN KEY (FK_IDmobilia)
        REFERENCES Mobilia(ID),

    CONSTRAINT fk_item_modelo
        FOREIGN KEY (FK_IDmodelo)
        REFERENCES Modelo_2D(ID)
        ON DELETE CASCADE
);

SHOW TABLE STATUS;
