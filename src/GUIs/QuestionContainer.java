package GUIs;

import java.awt.Component;
import java.awt.Dimension;
import java.util.ArrayList;
import java.util.Iterator;

public class QuestionContainer extends javax.swing.JPanel {

    int cont = 0; //counter of existing questions
    ArrayList<Question> questions = new ArrayList<>(); //here we store questions

    
    /*Constructor*/
    public QuestionContainer() {
        initComponents();
    }

    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        setPreferredSize(new java.awt.Dimension(700, 0));

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 400, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 90, Short.MAX_VALUE)
        );
    }// </editor-fold>//GEN-END:initComponents

    /*Method to addQuestions in the Container*/
    public void addQuestion(int type){
            Question newQuestion = new Question(type);
            newQuestion.setId(cont++);
            questions.add(newQuestion);
            newQuestion.QuestionInit(this);
    }

    /*Method to deleteQuestions from the Container*/
    public void deleteQuestion(int id){
        Dimension panelDim = this.getPreferredSize();
        int panelWidth = (int) panelDim.width;
        this.setPreferredSize(new Dimension(panelWidth,0));    
        questions.remove(id);
        addAllQuestions();
    }

    public void addAllQuestions(){
    
        cont = 0;
        Dimension thisDim = this.getPreferredSize();
        this.setPreferredSize(new Dimension(thisDim.width,0));
        this.removeAll();
        this.revalidate();
        this.repaint();
       
        this.updateUI();
       

        for (Iterator<Question> iterator = this.questions.iterator(); iterator.hasNext();) {
            Question question = iterator.next();
            question.setId(cont++);
            question.QuestionInit(this);
        }
    }
      
    public void updateQuestion(Question question, int id){
        questions.set(id, question);
        addAllQuestions();
    }
    
    
    
    // Variables declaration - do not modify//GEN-BEGIN:variables
    // End of variables declaration//GEN-END:variables
}
