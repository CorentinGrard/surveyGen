ALTER TABLE Project DROP CONSTRAINT FKProject159630;
ALTER TABLE Users DROP CONSTRAINT FKUsers257902;
ALTER TABLE Survey DROP CONSTRAINT FKSurvey300467;
ALTER TABLE Question DROP CONSTRAINT FKQuestion216667;
ALTER TABLE QuestionOption DROP CONSTRAINT FKQuestionOp817468;
ALTER TABLE QuestionOption DROP CONSTRAINT FKQuestionOp299459;
ALTER TABLE Question DROP CONSTRAINT FKQuestion893077;
ALTER TABLE Constraints DROP CONSTRAINT FKConstraint444998;
DROP TABLE IF EXISTS Survey CASCADE;
DROP TABLE IF EXISTS Project CASCADE;
DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Profession CASCADE;
DROP TABLE IF EXISTS Options CASCADE;
DROP TABLE IF EXISTS TypeOfQuestion CASCADE;
DROP TABLE IF EXISTS Question CASCADE;
DROP TABLE IF EXISTS QuestionOption CASCADE;
DROP TABLE IF EXISTS Constraints CASCADE;
CREATE TABLE Survey (id SERIAL NOT NULL, Projectid int4 NOT NULL, name varchar(255) NOT NULL, description text, objective varchar(255), startDate date NOT NULL, finalDate date NOT NULL, DBname varchar(30) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Project (id SERIAL NOT NULL, description text NOT NULL, Useremail varchar(50) NOT NULL, name varchar(20), PRIMARY KEY (id));
CREATE TABLE Users (email varchar(50) NOT NULL, idProfession int4 NOT NULL, name varchar(30) NOT NULL, lastName varchar(30) NOT NULL, password varchar(64) NOT NULL, birthDate date NOT NULL, nonce varchar(32), PRIMARY KEY (email));
CREATE TABLE Profession (id SERIAL NOT NULL, description varchar(100) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Options (id SERIAL NOT NULL, description varchar(255) NOT NULL, PRIMARY KEY (id));
CREATE TABLE TypeOfQuestion (id SERIAL NOT NULL, description varchar(20) NOT NULL, PRIMARY KEY (id));
CREATE TABLE Question (id int4 NOT NULL, idSurvey int4 NOT NULL, idType int4 NOT NULL, title varchar(255) NOT NULL, description text, PRIMARY KEY (id, idSurvey));
CREATE TABLE QuestionOption (idOption int4 NOT NULL, idQuestion int4 NOT NULL, idSurvey int4 NOT NULL);
CREATE TABLE Constraints (idQuestion int4 NOT NULL, idSurvey int4 NOT NULL, "constraint" varchar(50) NOT NULL, "column" int4 NOT NULL);
ALTER TABLE Project ADD CONSTRAINT FKProject159630 FOREIGN KEY (Useremail) REFERENCES Users (email);
ALTER TABLE Users ADD CONSTRAINT FKUsers257902 FOREIGN KEY (idProfession) REFERENCES Profession (id);
ALTER TABLE Survey ADD CONSTRAINT FKSurvey300467 FOREIGN KEY (Projectid) REFERENCES Project (id);
ALTER TABLE Question ADD CONSTRAINT FKQuestion216667 FOREIGN KEY (idType) REFERENCES TypeOfQuestion (id);
ALTER TABLE QuestionOption ADD CONSTRAINT FKQuestionOp817468 FOREIGN KEY (idQuestion, idSurvey) REFERENCES Question (id, idSurvey);
ALTER TABLE QuestionOption ADD CONSTRAINT FKQuestionOp299459 FOREIGN KEY (idOption) REFERENCES Options (id);
ALTER TABLE Question ADD CONSTRAINT FKQuestion893077 FOREIGN KEY (idSurvey) REFERENCES Survey (id);
ALTER TABLE Constraints ADD CONSTRAINT FKConstraint444998 FOREIGN KEY (idQuestion, idSurvey) REFERENCES Question (id, idSurvey);




INSERT INTO Profession(description) VALUES ('Teacher');