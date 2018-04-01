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
import java.util.ArrayList;
import java.util.Iterator;

/**
 *
 * @author ferynando7
 */
public class Question extends javax.swing.JPanel {

    private int idSurvey;
    private int idQuestion;
    private String title; 
    private String description; //Ver donde colocamos la descripción
    private int tipo;
    
    private int contOpt = 0;

    public String getTitle(){
        return title;
    }
    
    public void setTitle(String title){
        this.title = title;
    }
    
    public int getidSurvey(){
        return idSurvey;
    }
    
    public void setIdSurvey(int idSvey){
        this.idSurvey = idSvey;
    }
    
    public String getDescription(){
        return description;
    }
    
    public void setDescription(String descript){
        this.description = descript;
    }
    public int getTipo() {
        return tipo;
    }

    public void setTipo(int tipo) {
        this.tipo = tipo;
    }

    
    public int getId() {
        return idQuestion;
    }

    public void setId(int id) {
        this.idQuestion = id;
    }
  
    public Question() {
        this.initComponents();
    }
    
    public void QuestionInit(JPanel panel, int cont){
        
        this.lbNumQuest.setText(String.valueOf(idQuestion+1));

       
        /*Calculo del size de la pregunta*/
        Dimension questionDim = this.getPreferredSize();
        int questionHeigth = (int) questionDim.height;
        int questionWidth = (int) questionDim.width;
        
        
        /*Calculo del size del Question Container*/
        Dimension panelDim = panel.getPreferredSize();
        int panelHeigth = (int) panelDim.height;
        int panelWidth = (int) panelDim.width;

        /*Posicionamiento de la pregunta*/
//        this.setBounds(0,questionHeigth*cont,questionWidth,questionHeigth);
        this.setBounds(0,panelHeigth,questionWidth,questionHeigth);
        
        
        /*Update of the container*/
        panel.setPreferredSize(new Dimension(panelWidth,panelHeigth+questionHeigth));
             
        
        panel.add(this);
        panel.revalidate();
        panel.repaint();
//        panel.updateUI();
        
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

        lbTitleQuest.setText("Título:");

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
                .addContainerGap(227, Short.MAX_VALUE))
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
        Dimension questionDim = this.getPreferredSize();
        Option newOption = new Option();
        newOption.setBounds(20, questionDim.height, 450, 25);
        
        this.setPreferredSize(new Dimension(questionDim.width,questionDim.height+25));
        this.add(newOption);
        this.updateUI();
        
        QuestionContainer questionContainer = (QuestionContainer)this.getParent();
        questionContainer.updateQuestion(this,idQuestion);
        
    }//GEN-LAST:event_btnAddOptionActionPerformed

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
