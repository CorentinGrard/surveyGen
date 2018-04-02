/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUIs;

import java.awt.Dimension;
import javax.swing.JPanel;
import javax.swing.text.AbstractDocument;
import GUIs.Question;
import java.awt.Component;
import java.util.ArrayList;
import java.util.Iterator;
import javax.swing.JTextField;

/**
 *
 * @author ferynando7
 */
public class Question extends javax.swing.JPanel {

    private int idSurvey;
    private int idQuestion;
    private String title; 
    private String description; //Ver donde colocamos la descripción
    private int type; //0 for concurrent, 1 for alternative, 2 for free
    private ArrayList<Option> options = new ArrayList<>();
    private int initialHeight;
    
    private int contOpt = 0;
    
    /*Constructor*/
     public Question(int type) {
        //Validate that type=0,1,2
        this.type = type;
        this.initComponents();
        if (type == 2){addTextBox();}
        
    }
    
     
     /*Getters and Setters*/
    public String getTitle(){return title;}
    
    public void setTitle(String title){this.title = title;}
    
    public int getidSurvey(){return idSurvey;}
    
    public void setIdSurvey(int idSvey){    this.idSurvey = idSvey;}
    
    public String getDescription(){return description;}
    
    public void setDescription(String descript){this.description = descript;}
    
    public int getType() {return type;}

    public void setType(int type) {this.type = type;}
    
    public int getId() {return idQuestion;}

    public void setId(int id) {this.idQuestion = id;}
  /////////////////////////////////////

    public void QuestionInit(JPanel panel){
        
        this.lbNumQuest.setText(String.valueOf(idQuestion+1));

       
        /*Calculo del size de la pregunta*/
        Dimension questionDim = this.getPreferredSize(); 
        int questionHeigth = (int) questionDim.height;
        initialHeight = questionHeigth;
        int questionWidth = (int) questionDim.width;
        
        
        /*Calculo del size del Question Container*/
        Dimension panelDim = panel.getPreferredSize();
        int panelHeigth = (int) panelDim.height;
        int panelWidth = (int) panelDim.width;

        /*Posicionamiento de la pregunta*/
        this.setBounds(0,panelHeigth,questionWidth,questionHeigth);
        
        /*Update of the container*/
        panel.setPreferredSize(new Dimension(panelWidth,panelHeigth+questionHeigth));
             
        panel.add(this);
        panel.revalidate();
        panel.repaint();   
    }


    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        lbNumQuest = new javax.swing.JLabel();
        lbTitleQuest = new javax.swing.JLabel();
        jTextField1 = new javax.swing.JTextField();
        btnEditQuest = new javax.swing.JButton();
        btnDeleteQuest = new javax.swing.JButton();
        cbMandatory = new javax.swing.JCheckBox();
        btnAddOption = new javax.swing.JButton();

        lbNumQuest.setText("1.");

        lbTitleQuest.setText("Title");

        jTextField1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                jTextField1ActionPerformed(evt);
            }
        });

        btnEditQuest.setText("Edit");

        btnDeleteQuest.setText("Delete");
        btnDeleteQuest.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnDeleteQuestActionPerformed(evt);
            }
        });

        cbMandatory.setText("Mandatory");

        btnAddOption.setText("+");
        btnAddOption.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                btnAddOptionActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(lbNumQuest)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(lbTitleQuest)
                        .addGap(133, 133, 133)
                        .addComponent(btnEditQuest)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(btnDeleteQuest))
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(jTextField1, javax.swing.GroupLayout.PREFERRED_SIZE, 171, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addComponent(btnAddOption)))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(cbMandatory)
                .addContainerGap(241, Short.MAX_VALUE))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(lbNumQuest)
                    .addComponent(lbTitleQuest)
                    .addComponent(btnEditQuest)
                    .addComponent(btnDeleteQuest)
                    .addComponent(cbMandatory))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                    .addComponent(jTextField1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                    .addComponent(btnAddOption))
                .addContainerGap(22, Short.MAX_VALUE))
        );
    }// </editor-fold>//GEN-END:initComponents

    private void btnDeleteQuestActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnDeleteQuestActionPerformed
        QuestionContainer panel = (QuestionContainer) this.getParent();
        //panel.updateQuestionsIndexes();
        panel.deleteQuestion(idQuestion);
    }//GEN-LAST:event_btnDeleteQuestActionPerformed

    private void btnAddOptionActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_btnAddOptionActionPerformed
        Option newOption = new Option();
        newOption.setType(this.getType());
        newOption.setIdOption(contOpt++);
        options.add(newOption);
        newOption.OptionInit(this);
        QuestionContainer questionContainer = (QuestionContainer) this.getParent();
        questionContainer.updateQuestion(this,idQuestion);
    }//GEN-LAST:event_btnAddOptionActionPerformed

     /*Method to deleteOptions from the Container*/
    public void deleteOption(int id){
        Dimension panelDim = this.getPreferredSize();
        int panelWidth = (int) panelDim.width;
        this.setPreferredSize(new Dimension(panelWidth,this.initialHeight));    
        options.remove(id);
        addAllOptions();
    }

    public void addAllOptions(){
    
        contOpt = 0;
        Dimension thisDim = this.getPreferredSize();
        this.setPreferredSize(new Dimension(thisDim.width,90));
        this.removeAllOptions();
        
        for (Iterator<Option> iterator = this.options.iterator(); iterator.hasNext();) {
            Option option = iterator.next();
            option.setIdOption(contOpt++);
            option.OptionInit(this);
        }
        
        
    }
    
    public void removeAllOptions(){
        Component[] components = this.getComponents();
        for(Component c : components){
        //Find the components you want to remove
            if(c instanceof Option){
                //Remove it
                this.remove(c);
            }
        }
        //IMPORTANT
        this.revalidate();
        this.repaint();
    }
    
    /*Just in case it is Free Answer Question*/
    public void addTextBox(){
        Dimension thisDim = this.getPreferredSize();
        JTextField tfAnswer = new JTextField();
        tfAnswer.setBounds(30, thisDim.height, 250, 250);
        this.setPreferredSize(new Dimension(thisDim.width,thisDim.height+250));
        this.add(tfAnswer);
        this.revalidate();
        this.repaint();
    }
    
    private void jTextField1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_jTextField1ActionPerformed
        // TODO add your handling code here:
    }//GEN-LAST:event_jTextField1ActionPerformed

    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton btnAddOption;
    private javax.swing.JButton btnDeleteQuest;
    private javax.swing.JButton btnEditQuest;
    private javax.swing.JCheckBox cbMandatory;
    private javax.swing.JTextField jTextField1;
    private javax.swing.JLabel lbNumQuest;
    private javax.swing.JLabel lbTitleQuest;
    // End of variables declaration//GEN-END:variables
}
