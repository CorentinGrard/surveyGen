/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Logic;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

/**
 *
 * @author zoso
 */
public class ConnectionPostgres {

    public ConnectionPostgres() {
    }

    //Create a method to establish de connection with the database
    public Connection connectDB() {
        String user = "postgres";
        String password = "1234";
        Connection c = null;
        try {
            Class.forName("org.postgresql.Driver");
            c = DriverManager
                    .getConnection("jdbc:postgresql://localhost:5432/surveys",
                            user, password);
        } catch (Exception e) {
            e.printStackTrace();
            System.err.println(e.getClass().getName() + ": " + e.getMessage());
            System.exit(0);
        }

        System.out.println("Opened database successfully");
        return c;
    }

    //Method to insert any value in tables
    //Values can have different formats according with the type of table
    //survey -> (name,description,objective,startDate,finalDate)
    //question ->(id,idSurvey,title,description,type)
    //Option -> (id,description)
    //QuestionOptin -> (idSurvey,idQuestion,idOption)
    public void insert(String tableName, String parameters, String values) {

        try {
            Connection c = connectDB();
            Statement st = c.createStatement();
            String sql = "INSERT INTO " + tableName + " " + parameters + " VALUES (" + values + ");";
            System.out.println(sql);
            st.executeUpdate(sql);
            st.close();
            c.setAutoCommit(false);
            c.commit();
            c.close();
        } catch (Exception e) {
            System.err.println(e.getClass().getName() + ": " + e.getMessage());
            System.exit(0);
        }
    }

    //Esta clase queda en duda estaba pensando usarla 
    public ResultSet returnLastRow(String tableName) {
        ResultSet result = null;
        try {
            Connection c = connectDB();
            Statement st = c.createStatement();
            String sql = "SELECT * from " + tableName;
            result = st.executeQuery(sql);
            result.last();

        } catch (Exception e) {
            System.err.println(e.getClass().getName() + ": " + e.getMessage());
        }
        return result;
    }

    public int getId(String tableName){
        int surveyId = -1;
        try {
            surveyId = returnLastRow(tableName).getInt("id");

        } catch (Exception e) {
            System.err.println(e.getClass().getName() + ": " + e.getMessage());
        }
        
        return surveyId;
    }
    
//    public void insertOption(String valuesQuestionOption, String parameters, String descriptionNewOption){
//
//        try {
//            Connection c = connectDB();
//            Statement stm = c.createStatement();
//            String sql = "SELECT * FROM idOption,description WHERE description = "+descriptionNewOption+";";
//            ResultSet result = stm.executeQuery(sql);
//            String idOption = result.getString("idOption");
//            String description = result.getString("description");
//            
//            result.close();
//            stm.close();
//            c.close();
//            
//            if(description != descriptionNewOption){
//                insert("option",parameters,idNewOption+","+descriptionNewOption);
//                insert("QuestionOption",parameters,valuesQuestionOption+","+idNewOption);
//            }else{
//                insert("QuestionOnOption",parameters,valuesQuestionOption+","+idOption);
//            }
//            
//        } catch (Exception e) {
//            System.err.println( e.getClass().getName()+": "+ e.getMessage() );
//            System.exit(0);
//        }       
//    }
//    //Method to insert a new Survey
//    public void insertSurvey(String values){
//        Connection c;
//        Statement st;
//        try {
//            c = connectDB();
//            st = c.createStatement();
//            String sql = "INSERT INTO survey (id,name,description,objective,startDate,finalDate)"
//                    + "VALUES ("+values+");";
//            st.executeUpdate(sql);
//            st.close();
//            c.setAutoCommit(false);
//            c.commit();
//            c.close();
//        } catch (Exception e) {
//            System.err.println( e.getClass().getName()+": "+ e.getMessage() );
//            System.exit(0);
//        }    
//    }
//    
//    //Method to insert a new Question
//    public void insertQuestion(String values){
//        /**
//         values debe estar en el formato correspondiente SQL
//         
//         **/
//        
//        Connection c;
//        Statement stmt = null;
//        try {
//            c = connectDB();
//            stmt = c.createStatement();
//            String sql = "INSERT INTO question (id,idSurvey,title,description,type) "
//            + "VALUES ("+values+");";
//            stmt.executeUpdate(sql);
//            stmt.close();
//            c.setAutoCommit(false);
//            c.commit();
//            c.close();
//        } catch (Exception e) {
//            System.err.println( e.getClass().getName()+": "+ e.getMessage() );
//            System.exit(0);
//        }
//        System.out.println("Records created successfully");
//    }
//    
//    public void insertOptionQuestion(String values){
//        //Values must be composed of the idSurvey,idQuestion,idOption
//        Connection c;
//        Statement st;
//        try {
//            c = connectDB();
//            st = c.createStatement();
//            String sql = "INSERT INTO questionOption (idSurvey,idQuestion,idOption)"
//                    + "VALUES ("+values+");";
//            st.executeUpdate(sql);
//            st.close();
//            c.setAutoCommit(false);
//            c.commit();
//            c.close();
//        } catch (Exception e) {
//            System.err.println( e.getClass().getName()+": "+ e.getMessage() );
//            System.exit(0);
//        }   
//    }
//        
//    public void insertOption(String values){
//        Connection c;
//        Statement st;
//        try {
//            c = connectDB();
//            st = c.createStatement();
//            String sql = "INSERT INTO option (id,description)"
//                    + "VALUES ("+values+");";
//            st.executeUpdate(sql);
//            st.close();
//            c.setAutoCommit(false);
//            c.commit();
//            c.close();
//        } catch (Exception e) {
//            System.err.println( e.getClass().getName()+": "+ e.getMessage() );
//            System.exit(0);
//        }    
//    }
//    
}
