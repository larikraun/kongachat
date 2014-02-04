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
import org.json.me.JSONArray;
import org.json.me.JSONException;
import org.json.me.JSONObject;


/**
 *
 * @author TOghenekohwo
 */
public class LoginForm extends Form implements ActionListener{

    private Label lblPassword,lblEmail;
    private Label lblMessage;
    private TextField password,email;
    private StartMidlet midlet;
    private Command login,signup;
    private Container container;
    String logged ="";
    JSONObject myParams;

    public LoginForm(StartMidlet midlet){
        setTitle("Login");
        
        this.midlet = midlet;
        lblEmail = new Label("Username");
        email = new TextField("");
        lblPassword = new Label("Password");
        password = new TextField();
        password.setConstraint(TextField.PASSWORD);
        lblMessage = new Label("");
        
        login = new Command("Login");
        
        signup = new Command("Sign Up");
        
        
        container = new Container(new FlowLayout(CENTER));
        container.addComponent(lblEmail);
        container.addComponent(email);
        container.addComponent(lblPassword);
        container.addComponent(password);
        container.addComponent(lblMessage);
        
        lblMessage.setVisible(false);
        
        setLayout(new BorderLayout());
        addComponent(BorderLayout.CENTER, container);
        addCommand(login);
        addCommand(signup);
        addCommandListener(this);
        show();
    }
    
    public void actionPerformed(ActionEvent ae) {
            if(ae.getCommand() == signup){
                new SignUp(midlet);
            }else if(ae.getCommand()==login){
                
                String em = email.getText();
                String pwd = password.getText();
            try {
                JSONObject val = new URLHelper("user/auth?email="+em+"&password="+pwd).get();
                    System.out.println(val);
                    JSONArray json = new JSONArray();
                    if(val.getBoolean("status")){
                        
                        JSONObject obj = val.getJSONObject("response");
                        this.myParams = obj.getJSONObject("user");
                        json = obj.getJSONArray("users");
                        System.out.println(json);
                    }else{
                        Report.report(val.getString("error_message"));
                    }
                    new UserSpaceForm(midlet,json,myParams);
                } catch (JSONException ex) {
                    ex.printStackTrace();
                }
            }
    }
}
