
package GUIs;

import java.awt.Dimension;
import java.awt.Rectangle;
import javax.swing.JCheckBox;
import javax.swing.JPanel;
import javax.swing.JRadioButton;


public class Option extends javax.swing.JPanel {
    
    private int idOption;
    private int type;
  
    /*Constructor*/
    public Option() {
       
    }
    
    /*Getters and Setters*/

    public int getIdOption() {
        return idOption;
    }

    public void setIdOption(int idOption) {
        this.idOption = idOption;
    }

    public int getType() {
        return type;
    }

    public void setType(int type) {
        this.type = type;
    }
    
    
    ////////////////
    
     public void OptionInit(JPanel panel) {
         
        Rectangle r = new Rectangle(0, 0, 100, 25);
        
        if(type==1){
            //It is neccessary to remove all components in order to have an updated CheckBox
            this.removeAll();
            initComponents();
            JCheckBox cbOption = new JCheckBox("Option "+String.valueOf(this.idOption+1));
            cbOption.setBounds(r);
            this.add(cbOption);
        }else if(type==2){
            //It is neccessary to remove all components in order to have an updated RadioButton

            this.removeAll();
            initComponents();
            JRadioButton rbOption = new JRadioButton("Option "+String.valueOf(idOption+1));
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
        question.deleteOption(idOption);
        
        QuestionContainer questionContainer = (QuestionContainer) question.getParent();
        questionContainer.updateQuestion(question,question.getId());
    }//GEN-LAST:event_btnDeleteQuestionActionPerformed


    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnDeleteQuestion;
    // End of variables declaration//GEN-END:variables
}
