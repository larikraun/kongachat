/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.kngachat.classes;

import com.sun.lwuit.Dialog;
import com.sun.lwuit.TextArea;

/**
 *
 * @author phylyp
 */
public class Report {
    
    public static void report(String val){
        Dialog validDialog = new Dialog("Alert");
            validDialog.setScrollable(false);
            validDialog.setIsScrollVisible(false);
            validDialog.setTimeout(2000); // set timeout milliseconds
            TextArea textArea = new TextArea(val); //pass the alert text here
            textArea.setFocusable(false);
            textArea.setIsScrollVisible(false);
            validDialog.addComponent(textArea);
            validDialog.show(0, 100, 10, 10, true);
            //lblMessage.setVisible(true);
    }
    
}
