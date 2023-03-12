CREATE TABLE utente (
    idutente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    cognome VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    telefono VARCHAR(255),
    tipologia VARCHAR(255)
);

CREATE TABLE agenzie (
    idagenzia INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    indirizzo VARCHAR(255),
    iso VARCHAR(255),
    esperienza VARCHAR(255),
    rc tinyint(1),
    annullamento tinyint(1)
);

CREATE TABLE commenti (
    idcommento INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    testo VARCHAR(255),
    timestamp TIMESTAMP,
    idagenzia INT NOT NULL,
    FOREIGN KEY (idagenzia) REFERENCES agenzie(idagenzia) ON DELETE CASCADE
);

CREATE TABLE viaggio (
    cig INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nLotto VARCHAR(255),
    meta VARCHAR(255),
    giorn VARCHAR(255),
    nstudenti INT,
    ndocenti INT,
    invalido tinyint(1)
);

CREATE TABLE organizza (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idutente INT NOT NULL,
    cig INT NOT NULL,
    FOREIGN KEY (idutente) REFERENCES utente(idutente) ON DELETE CASCADE,
    FOREIGN KEY (cig) REFERENCES viaggio(cig) ON DELETE CASCADE
);

CREATE TABLE Offerta (
    idofferta INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nBusta VARCHAR(255),
    nome VARCHAR(255),
    tourOperator VARCHAR(255),
    prezzo DECIMAL,
    stelle INT,
    nAlunni INT,
    posizione VARCHAR(255),
    mezzi VARCHAR(255),
    ristorante VARCHAR(255),
    servizioRistorante VARCHAR(255),
    treno VARCHAR(255),
    bus VARCHAR(255),
    punti VARCHAR(255),
    cig INT NOT NULL,
    FOREIGN KEY (cig) REFERENCES viaggio(cig) ON DELETE CASCADE
);

CREATE TABLE servizio (
    idServizio INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    descrizione VARCHAR(255),
    idofferta INT NOT NULL,
    FOREIGN KEY (idofferta) REFERENCES Offerta(idofferta) ON DELETE CASCADE
);
