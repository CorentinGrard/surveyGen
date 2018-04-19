ALTER TABLE Project DROP CONSTRAINT FKProject539674;
ALTER TABLE "User" DROP CONSTRAINT FKUser637946;
ALTER TABLE Survey DROP CONSTRAINT FKSurvey300467;
ALTER TABLE Question DROP CONSTRAINT FKQuestion216667;
ALTER TABLE QuestionOption DROP CONSTRAINT FKQuestionOp817468;
ALTER TABLE QuestionOption DROP CONSTRAINT FKQuestionOp151051;
ALTER TABLE Question DROP CONSTRAINT FKQuestion893077;
ALTER TABLE "Constraint" DROP CONSTRAINT FKConstraint601547;
DROP TABLE IF EXISTS Survey CASCADE;
DROP TABLE IF EXISTS Project CASCADE;
DROP TABLE IF EXISTS "User" CASCADE;
DROP TABLE IF EXISTS Profession CASCADE;
DROP TABLE IF EXISTS "Option" CASCADE;
DROP TABLE IF EXISTS TypeOfQuestion CASCADE;
DROP TABLE IF EXISTS Question CASCADE;
DROP TABLE IF EXISTS QuestionOption CASCADE;
DROP TABLE IF EXISTS "Constraint" CASCADE;
CREATE TABLE Survey (id SERIAL NOT NULL, Projectid int4 NOT NULL, name varchar(255) NOT NULL, description text, objective varchar(255), startDate date NOT NULL, finalDate date NOT NULL, DBname varchar(30) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Project (id SERIAL NOT NULL, description text NOT NULL, Useremail varchar(50), PRIMARY KEY (id));
CREATE TABLE "User" (email varchar(50) NOT NULL, idProfession int4 NOT NULL, name varchar(30) NOT NULL, lastName varchar(30) NOT NULL, password varchar(64) NOT NULL, birthDate date NOT NULL, nonce int4, PRIMARY KEY (email));
CREATE TABLE Profession (id SERIAL NOT NULL, description varchar(100) NOT NULL, PRIMARY KEY (id));
CREATE TABLE "Option" (id SERIAL NOT NULL, description varchar(255) NOT NULL, PRIMARY KEY (id));
CREATE TABLE TypeOfQuestion (id SERIAL NOT NULL, description varchar(20) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Question (id int4 NOT NULL, idSurvey int4 NOT NULL, idType int4 NOT NULL, title varchar(255) NOT NULL, description text, PRIMARY KEY (id, idSurvey));
CREATE TABLE QuestionOption (idOption int4 NOT NULL, idQuestion int4 NOT NULL, idSurvey int4 NOT NULL);
CREATE TABLE "Constraint" (idQuestion int4 NOT NULL, idSurvey int4 NOT NULL, "constraint" varchar(50) NOT NULL, "column" int4 NOT NULL);
ALTER TABLE Project ADD CONSTRAINT FKProject539674 FOREIGN KEY (Useremail) REFERENCES "User" (email);
ALTER TABLE "User" ADD CONSTRAINT FKUser637946 FOREIGN KEY (idProfession) REFERENCES Profession (id);
ALTER TABLE Survey ADD CONSTRAINT FKSurvey300467 FOREIGN KEY (Projectid) REFERENCES Project (id);
ALTER TABLE Question ADD CONSTRAINT FKQuestion216667 FOREIGN KEY (idType) REFERENCES TypeOfQuestion (id);
ALTER TABLE QuestionOption ADD CONSTRAINT FKQuestionOp817468 FOREIGN KEY (idQuestion, idSurvey) REFERENCES Question (id, idSurvey);
ALTER TABLE QuestionOption ADD CONSTRAINT FKQuestionOp151051 FOREIGN KEY (idOption) REFERENCES "Option" (id);
ALTER TABLE Question ADD CONSTRAINT FKQuestion893077 FOREIGN KEY (idSurvey) REFERENCES Survey (id);
ALTER TABLE "Constraint" ADD CONSTRAINT FKConstraint601547 FOREIGN KEY (idQuestion, idSurvey) REFERENCES Question (id, idSurvey);



INSERT INTO Profession(description) VALUES ('teacher');
