CREATE TABLE optionAnswer (idSurveyAnswered int4 NOT NULL, idQuestion int4 NOT NULL, answer int4, PRIMARY KEY (idSurveyAnswered, idQuestion));
CREATE TABLE extraOption (idSurveyAnswered int4 NOT NULL, idQuestion int4 NOT NULL, answer varchar(255), PRIMARY KEY (idSurveyAnswered, idQuestion));
CREATE TABLE explanation (idSurveyAnswered int4 NOT NULL, idQuestion int4 NOT NULL, answer varchar(255), PRIMARY KEY (idSurveyAnswered, idQuestion));
CREATE TABLE surveyAnwered (id SERIAL NOT NULL, idUser int4, PRIMARY KEY (id));
CREATE TABLE freeAnswer (id int4 NOT NULL, idSurveyAnswered int4 NOT NULL, idQuestion int4 NOT NULL, answer varchar(255), PRIMARY KEY (id, idSurveyAnswered, idQuestion));
ALTER TABLE optionAnswer ADD CONSTRAINT FKoptionAnsw67149 FOREIGN KEY (idSurveyAnswered) REFERENCES surveyAnwered (id);
ALTER TABLE freeAnswer ADD CONSTRAINT FKfreeAnswer879579 FOREIGN KEY (idSurveyAnswered) REFERENCES surveyAnwered (id);
ALTER TABLE extraOption ADD CONSTRAINT FKextraOptio186811 FOREIGN KEY (idSurveyAnswered, idQuestion) REFERENCES optionAnswer (idSurveyAnswered, idQuestion);
ALTER TABLE explanation ADD CONSTRAINT FKexplanatio389134 FOREIGN KEY (idSurveyAnswered, idQuestion) REFERENCES optionAnswer (idSurveyAnswered, idQuestion);
