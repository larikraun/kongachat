/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.kongachat.forms;

import com.kngachat.classes.URLHelper;
import com.kongachat.midlet.StartMidlet;
import com.sun.lwuit.*;
import com.sun.lwuit.events.ActionEvent;
import com.sun.lwuit.events.ActionListener;
import com.sun.lwuit.layouts.BorderLayout;
import com.sun.lwuit.layouts.FlowLayout;
import org.json.me.JSONException;
import org.json.me.JSONObject;

/**
 *
 * @author phylyp
 */
public class ChatSpaceForm extends Form implements ActionListener{
    
    private Label lblPassword,lblEmail;
    private Label lblMessage;
    private TextField password,email;
    private StartMidlet midlet;
    private TextArea chatArea;
    private TextArea messageArea;
    
    private Command send,quit;
    private Container container;
    private JSONObject myParams;
    private JSONObject currUser;
    String logged ="";
    
    public ChatSpaceForm(StartMidlet midlet,JSONObject user,JSONObject myParams){
        this.myParams = myParams;
        this.currUser = user;
        try {
            setTitle("Chat WIth -- "+user.getString("email"));
        } catch (JSONException ex) {
            setTitle("Chat WIth -- ");
            ex.printStackTrace();
        }
        
        this.midlet = midlet;
        chatArea = new TextArea(10, 20);
        lblMessage = new Label("Type Message");
        messageArea = new TextArea(3,20);
                
        
        send = new Command("Send");
        
        quit = new Command("Quit");
        
        
        container = new Container(new FlowLayout(CENTER));
        container.addComponent(chatArea);
        container.addComponent(lblMessage);
        container.addComponent(messageArea);
        
        
        setLayout(new BorderLayout());
        addComponent(BorderLayout.CENTER, container);
        addCommand(send);
        //addCommand(quit);
        addCommandListener(this);
        show();
    }

    public void actionPerformed(ActionEvent ae) {
        try{
            if(ae.getCommand()==send)
            {
                String sender = myParams.getString("user_id");
                String recipient = currUser.getString("user_id");
                
                System.out.println(sender + "-" + recipient);
                String message = messageArea.getText();
                
                JSONObject mes = new URLHelper("message/send?sender="+sender+"&recipient="
                        +recipient+"&text="+message).get();
                
                messageArea.setText("");
                
                System.out.println(mes);
                
            }
        }catch(Exception e){
            e.printStackTrace();
        }
    }
    
}
