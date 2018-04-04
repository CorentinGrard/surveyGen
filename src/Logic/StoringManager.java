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
<<<<<<< HEAD
 * @author ferynando7
=======
 * @author ferz
>>>>>>> 9b7f1a4fa56d29405fde52ab1526531682cd083d
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
