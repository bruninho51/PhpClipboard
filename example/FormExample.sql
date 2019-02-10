#Form Example

INSERT INTO formulario VALUES(1,'example','form example.','POST','myProcessSuccessExample','myProcessFailureExample');
INSERT INTO campos VALUES(1,'Title','title','text',null, 'title', 1, 1, 'TextComponent', 'title');
INSERT INTO campos VALUES(2,'Description','description','text',null, 'description', 1, 1, 'TextAreaComponent', 'description');
INSERT INTO campos VALUES(6, 'Date', 'date', 'text',null, 'date',1,1,'DateComponent', 'date');
INSERT INTO campos VALUES(3,'Username','username','text',null, 'username', 1, 1, 'TextComponent', 'username');
INSERT INTO campos VALUES(4,'E-mail','email','text',null, 'email', 1, 1, 'EmailComponent', 'email');
INSERT INTO campos VALUES(5,'Phone','phone','text',null, 'phone', 1, 1, 'TextComponent', 'phone');
INSERT INTO rolesEntry VALUES(1, 'RoleExample', 1);
INSERT INTO camposFormulario VALUES(1, 1);
INSERT INTO camposFormulario VALUES(1, 2);
INSERT INTO camposFormulario VALUES(1, 3);
INSERT INTO camposFormulario VALUES(1, 4);
INSERT INTO camposFormulario VALUES(1, 5);
INSERT INTO camposFormulario VALUES(1, 6);
