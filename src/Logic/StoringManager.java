/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Logic;

import GUIs.Option;
import GUIs.Question;
import java.util.ArrayList;
import java.util.Iterator;

/**
 *
 * @author ferz
 */
public class StoringManager {
    
    public void saveAllQuestions(ArrayList<Question> questions, int idSurvey){
        ConnectionPostgres c = new ConnectionPostgres();
        String parameters;
        String values;
        for (Iterator<Question> iterator = questions.iterator(); iterator.hasNext();) {
            Question question = iterator.next();
            parameters = "*";
            values = idSurvey + "," + question.getIdQuestion() + "," + question.getTitle() + "" + question.getType();
            c.insert("question", parameters, values);
            
            saveAllOptions(question.getOptions(), question.getId(), c);
            
        }
    }
    
    public void saveAllOptions(ArrayList<Option> options, int idQuestion, ConnectionPostgres c){
        String parameters;
        String values;
        for (Iterator<Option> iterator = options.iterator(); iterator.hasNext();) {
            Option option = iterator.next();
            parameters = "*";
            values = idSurvey + "," + question.getIdQuestion() + "," + question.getTitle() + "" + question.getType();
            c.insert("question", parameters, values);
            
            saveAllOptions(questions.options);
            
        }
    }
    
    
    // public void insert(String tableName, String parameters, String values) {
}
