/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Logic;

import GUIs.Question;
import java.util.ArrayList;
import java.util.Iterator;

/**
 *
 * @author ferynando7
 */
public class StoringManager {
    
    public void saveAllQuestions(ArrayList<Question> questions, int idSurvey){
        ConnectionPostgres c = new ConnectionPostgres();
        String parameters, values;
        for (Iterator<Question> iterator = questions.iterator(); iterator.hasNext();) {
            Question question = iterator.next();
            parameters = "";
            values = idSurvey + "," + question.getId() + "," + "'" + question.getTitle() + "'" + "," +  "''" + "," + question.getType();
            c.insert("question", parameters, values);
            
        }
    }
    
    // public void insert(String tableName,String parameters,String values){
}
