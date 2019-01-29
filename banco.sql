#PARA LIB DE FORMULÁRIOS DO SITE
CREATE TABLE campos(
    idCampo INTEGER AUTO_INCREMENT,
    label VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    tipo VARCHAR(25) NOT NULL,
    opt TEXT,
    descricao TEXT NOT NULL,
    ordem TINYINT NOT NULL,
    size TINYINT NOT NULL,
    component VARCHAR(30),
    PRIMARY KEY(idCampo)
);
CREATE TABLE formularioModulo(
	idForm INTEGER NOT NULL,
    idModulo INTEGER NOT NULL,
    CONSTRAINT c_form FOREIGN KEY(idForm) REFERENCES formulario(idFormulario),
    CONSTRAINT ct_mod FOREIGN KEY(idModulo) REFERENCES modulo(id),
    descricao TEXT
);
CREATE TABLE formulario(
	idFormulario INTEGER AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NULL,
    descricao TEXT NOT NULL,
    method VARCHAR(50) NOT NULL,
    process VARCHAR(50) NOT NULL,
    processValidateFailure VARCHAR(50),
    PRIMARY KEY(idFormulario)
);
CREATE TABLE camposFormulario(
	idFormulario INTEGER NOT NULL,
    idCampo INTEGER NOT NULL,
    CONSTRAINT ct_form FOREIGN KEY(idFormulario) REFERENCES formulario(idFormulario),
    CONSTRAINT c_campo FOREIGN KEY(idCampo) REFERENCES campos(idCampo),
    PRIMARY KEY(idFormulario, idCampo)
);
CREATE TABLE rolesEntry(
    idRoleEntry INTEGER AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    idCampo INTEGER,
    PRIMARY KEY(idRoleEntry),
    CONSTRAINT fk_rolesEntry_camposFormulario FOREIGN KEY(idCampo) REFERENCES campos(idCampo)
);