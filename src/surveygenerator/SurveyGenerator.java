/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package surveygenerator;

import GUIs.StartingWIndow;
import java.awt.Frame;
import static java.awt.Frame.MAXIMIZED_BOTH;

/**
 *
 * @author ferynando7
 */
public class SurveyGenerator {

        public static void main(String[] args) {
        
            /*Start of the beginning window*/
            StartingWIndow startingWIndow = new StartingWIndow();
            startingWIndow.setTitle("Survey Generator");
            startingWIndow.setExtendedState(MAXIMIZED_BOTH);  
            startingWIndow.setVisible(true);
            
        }
    
}
