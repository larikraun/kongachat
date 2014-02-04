package com.kongachat.forms;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//import com.resimao.classes.*;
//import com.resimao.midlet.ResimaoApp;
import com.kngachat.classes.Report;
import com.kngachat.classes.URLHelper;
import com.kongachat.midlet.StartMidlet;
import com.sun.lwuit.*;
import com.sun.lwuit.events.ActionEvent;
import com.sun.lwuit.events.ActionListener;
import com.sun.lwuit.layouts.BorderLayout;
import com.sun.lwuit.layouts.FlowLayout;
import javax.microedition.lcdui.Alert;
import org.json.me.JSONObject;


/**
 *
 * @author TOghenekohwo
 */
public class SignUp extends Form implements ActionListener{

    private Label lblEmail,lblPassword,lblPassword2;
    private Label lblMessage;
    private TextField email,password1,password2;
    private StartMidlet midlet;
    private Command signup,quit,back;
    private Container container;
    String logged ="";

    public SignUp(StartMidlet midlet){
        setTitle("Create an Account");
        
        this.midlet = midlet;
        lblEmail = new Label("Enter Email");
        lblPassword = new Label("Enter Password");
        lblPassword2 = new Label("Confirm Password");
        
        email = new TextField("");
        password1 = new TextField("");
        password2 = new TextField("");
        
        password1.setConstraint(TextField.PASSWORD);
        password2.setConstraint(TextField.PASSWORD);
       
        lblMessage = new Label("");
        
        signup = new Command("Sign Up");
        back = new Command("Back");
        
        
        container = new Container(new FlowLayout(CENTER));
        container.addComponent(lblEmail);
        container.addComponent(email);
        container.addComponent(lblPassword);
        container.addComponent(password1);
        container.addComponent(lblPassword2);
        container.addComponent(password2);
        
        lblMessage.setVisible(false);
        
        setLayout(new BorderLayout());
        addComponent(BorderLayout.CENTER, container);
        addCommand(signup);
        addCommand(back);
        addCommandListener(this);
        show();
    }
    
    public void actionPerformed(ActionEvent ae) {
        Alert alert = new Alert("Report");
        if(ae.getCommand() == signup){
            try{
                String em =  email.getText();
                String p1 = password1.getText();
                String p2 = password2.getText();
                JSONObject val = new URLHelper("user/signup?email="+em+"&password="+p1+"&c_password="+p2).get();
                
                String msg = "";
                
                if(val.getBoolean("status")){
                    msg = "Registration Successful";
                }else{
                    msg = val.getString("error_message");
                }
                Report.report(msg);
                System.out.println(val);
            }catch(Exception e){
                e.printStackTrace();
            }
            
        } else if(ae.getCommand()==back){
            new LoginForm(midlet);
        }
    }
}
