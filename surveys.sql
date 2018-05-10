-- Database: "SGS"
-- DROP DATABASE "SGS";
CREATE DATABASE "SGS"
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'Spanish_Ecuador.1252'
       LC_CTYPE = 'Spanish_Ecuador.1252'
       CONNECTION LIMIT = -1;

COMMENT ON DATABASE "SGS"
  IS 'Survey Generator System';

-- Table: public."Option"
-- DROP TABLE public."Option";
CREATE TABLE public."Option"
(
  id integer NOT NULL, -- Identification of the option
  description character varying(80) NOT NULL, -- Name or description of the option
  CONSTRAINT "Option_pkey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);

-- Table: public."Question"
-- DROP TABLE public."Question";
CREATE TABLE public."Question"
(
  "idSurvey" integer NOT NULL, -- Identification of the survey
  id integer NOT NULL, -- Identification (unique) of the question inside the survey (ordered)
  title character varying(255) NOT NULL, -- The question itself
  description character varying(255), -- The description of the question
  "idType" character varying(5) NOT NULL, -- The identification of the type of the question
  "order" integer NOT NULL, -- The order of the question in the survey
  "shortName" character varying(20) NOT NULL, -- A short name for the question (to use in spreedsheets like tables)
  CONSTRAINT "Question_pkey" PRIMARY KEY ("idSurvey", id),
  CONSTRAINT "Question_idSurvey_fkey" FOREIGN KEY ("idSurvey")
      REFERENCES public."Survey" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT "Question_idType_fkey" FOREIGN KEY ("idType")
      REFERENCES public."TypeOfQuestion" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT "Question_order_check" CHECK ("order" > 0)
)
WITH (
  OIDS=FALSE
);

-- Table: public."QuestionOption"
-- DROP TABLE public."QuestionOption";
CREATE TABLE public."QuestionOption"
(
  "idSurvey" integer NOT NULL, -- Identification of the survey
  "idQuestion" integer NOT NULL, -- Identification of the question inside the survey
  "idOption" integer NOT NULL, -- Identification of the option
  "order" integer NOT NULL, -- The order of the option in the question
  CONSTRAINT "QuestionOption_pkey" PRIMARY KEY ("idSurvey", "idQuestion", "idOption"),
  CONSTRAINT "QuestionOption_idOption_fkey" FOREIGN KEY ("idOption")
      REFERENCES public."Option" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT "QuestionOption_idSurvey_fkey" FOREIGN KEY ("idSurvey", "idQuestion")
      REFERENCES public."Question" ("idSurvey", id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT "QuestionOption_order_check" CHECK ("order" > 0)
)
WITH (
  OIDS=FALSE
);

CREATE TABLE Profession (id SERIAL NOT NULL, description varchar(100) NOT NULL, PRIMARY KEY (id));
-- Table: public."Profession"
-- DROP TABLE public."Profession";
CREATE TABLE public."Profession"
(
  "id" integer NOT NULL, -- Identification of the profession
  "description" varchar(100) NOT NULL, -- Description de la profession
  CONSTRAINT "Profession_pkey" PRIMARY KEY ("id"),
  CONSTRAINT "User_idProfession_fkey" FOREIGN KEY ("idProfession")
      REFERENCES public."Profession" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
)
WITH (
  OIDS=FALSE
);


-- Table: public."User"
-- DROP TABLE public."User";
CREATE TABLE public."User"
(
  "email" varchar(50) NOT NULL, -- Identification of the user
  "idProfession" integer NOT NULL, -- Identification of the profession inside Profession
  "name" varchar(30) NOT NULL, -- Name of the user
  "lastName" varchar(30) NOT NULL, -- Last name of the user
  "password" varchar(64) NOT NULL, -- Password of the user
  "birthDate" date NOT NULL, -- birthdate
  "nonce" varchar(32), -- nonce
  CONSTRAINT "User_pkey" PRIMARY KEY ("email"),
  CONSTRAINT "User_idProfession_fkey" FOREIGN KEY ("idProfession")
      REFERENCES public."Profession" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
)
WITH (
  OIDS=FALSE
);


-- Table: public."Project"
-- DROP TABLE public."Project";
CREATE TABLE public."Project"
(
  "id" integer NOT NULL, -- Identification of the project
  "description" varchar(255) NOT NULL, -- Description of the project
  "userEmail" varchar(50) NOT NULL, -- Identification of the user email in User
  "name" varchar(20) NOT NULL, -- The name of the project
  CONSTRAINT "Project_pkey" PRIMARY KEY ("id"),
)
WITH (
  OIDS=FALSE
);


-- Table: public."Survey"
-- DROP TABLE public."Survey";
CREATE TABLE public."Survey"
(
  "id" integer NOT NULL, -- Identification (unique) for a survey
  "projectId" integer NOT NULL, -- Identification of a project inside Project
  "name" character varying(80) NOT NULL, -- Name of the survey
  "description" character varying(255), -- Description of the survey
  "objective" character varying(255), -- Objetive(s) of the survey
  "startDate" date, -- Starting date of the project
  "finalDate" date, -- Final date of the project
  "dbName" character varying(25) NOT NULL, -- The name of the database that will be created for the survey
  CONSTRAINT "Survey_pkey" PRIMARY KEY (id)
  CONSTRAINT "Survey_projectId_fkey" FOREIGN KEY ("projectId")
      REFERENCES public."Project" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE RESTRICT,
)
)
WITH (
  OIDS=FALSE
);

- Table: public."TypeOfQuestion"

-- DROP TABLE public."TypeOfQuestion";

CREATE TABLE public."TypeOfQuestion"
(
  id character varying(5) NOT NULL, -- Identification of the type of question
  description character varying(60) NOT NULL, -- Name or description of the type
  CONSTRAINT "TypeOfQuestion_pkey" PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);

INSERT INTO Profession(description) VALUES ('Teacher');
INSERT INTO TypeOfQuestion(description) VALUES ('Free');
INSERT INTO TypeOfQuestion(description) VALUES ('Option');
INSERT INTO TypeOfQuestion(description) VALUES ('Open Option');
INSERT INTO TypeOfQuestion(description) VALUES ('Multiple Option');
INSERT INTO TypeOfQuestion(description) VALUES ('Open Multiple Option');