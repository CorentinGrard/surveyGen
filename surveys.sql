---Create Table
CREATE TABLE Survey (id serial NOT NULL, name varchar(255) NOT NULL, description varchar(255), objective varchar(255), startDate date, finalDate date, PRIMARY KEY (id));
CREATE TABLE Question (idSurvey int4 NOT NULL, id int4 NOT NULL, title varchar(255) NOT NULL, description varchar(255), type int NOT NULL, PRIMARY KEY (id, idSurvey));
CREATE TABLE TypeOfQuestion (idType serial NOT NULL,type varchar(15) NOT NULL, description varchar(255), PRIMARY KEY (idType));
CREATE TABLE QuestionOption (idSurvey int4 NOT NULL, idQuestion int4 NOT NULL, idOption int4 NOT NULL);
CREATE TABLE Option (idOption serial NOT NULL, description varchar(255), PRIMARY KEY (idOption));

---Constraints
ALTER TABLE Question ADD CONSTRAINT fk_idSurvey FOREIGN KEY (idSurvey) REFERENCES Survey (id);
ALTER TABLE Question ADD CONSTRAINT fk_type FOREIGN KEY (type) REFERENCES TypeOfQuestion (idType);
ALTER TABLE QuestionOption ADD CONSTRAINT fk_idQuestion_idSurvey FOREIGN KEY (idQuestion, idSurvey) REFERENCES Question (id, idSurvey);
ALTER TABLE QuestionOption ADD CONSTRAINT fk_idOption FOREIGN KEY (idOption) REFERENCES Option (idOption);
ALTER TABLE Option ADD CONSTRAINT un_Description UNIQUE (description);

---Create Sequence
CREATE SEQUENCE oneByone MINVALUE 1 INCREMENT 1;

---Insert Type of Question
INSERT INTO TypeOfQuestion (type,description)VALUES
('Free Answer','A question that is open to the surveyed person'),
('Concurrent','A question which accepts multiple answer of a set of answers'),
('Alternative','A question which accepts a unique answer of a set of answers');

---Selects
select * from survey;
select * from question;
select * from questionOption;
select * from typeOfQuestion;
select * from option;
---Drop tables
drop table question cascade;
drop table survey;
drop table typeOfQuestion;
drop table QuestionOption;
drop table Option;
