
package GUIs;

import java.awt.Dimension;
import java.awt.Rectangle;
import javax.swing.JCheckBox;
import javax.swing.JPanel;
import javax.swing.JRadioButton;


public class Option extends javax.swing.JPanel {
    
    private int id;
    private int tipo;
  
    /*Constructor*/
    public Option(int tipo, int cont) {
        initComponents();
        id = cont;
    }
    
    /*Getters and Setters*/

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
    
    
     public void OptionInit(JPanel panel, int idQuestion) {
         
         
        Rectangle r = new Rectangle(0, 0, 100, 25);
        
        if(tipo==0){
            JCheckBox cbOption = new JCheckBox("Option "+String.valueOf(id+1));
            cbOption.setBounds(r);
            this.add(cbOption);
        }else if(tipo==1){
            JRadioButton rbOption = new JRadioButton("Option "+String.valueOf(id+1));
            rbOption.setBounds(r);
            this.add(rbOption);
        }
        
        this.revalidate();
        this.repaint();
         
         
         
         
        Dimension questionDim = panel.getPreferredSize();
       // Option newOption = new Option(this.getType(),contOpt++);
        this.setBounds(20, questionDim.height, 450, 25);
        
        
        panel.setPreferredSize(new Dimension(questionDim.width,questionDim.height+25));
        panel.add(this);
        panel.revalidate();
        panel.repaint();
        
        QuestionContainer questionContainer = (QuestionContainer) panel.getParent();
        questionContainer.updateQuestion((Question) panel,idQuestion);
     }
   
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        btnDeleteQuestion = new javax.swing.JButton();

        setPreferredSize(new java.awt.Dimension(450, 25));

        btnDeleteQuestion.setText("-");
        btnDeleteQuestion.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnDeleteQuestionActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap(411, Short.MAX_VALUE)
                .addComponent(btnDeleteQuestion))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(btnDeleteQuestion)
        );
    }// </editor-fold>//GEN-END:initComponents

    private void btnDeleteQuestionActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnDeleteQuestionActionPerformed
        Question question = (Question) this.getParent();
        question.deleteOption(id);
        
        QuestionContainer questionContainer = (QuestionContainer) question.getParent();
        questionContainer.updateQuestion(question,question.getId());
    }//GEN-LAST:event_btnDeleteQuestionActionPerformed


    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnDeleteQuestion;
    // End of variables declaration//GEN-END:variables
}
