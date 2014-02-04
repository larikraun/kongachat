package com.kongachat.midlet;


import com.kongachat.forms.LoginForm;
import com.sun.lwuit.Display;
import javax.microedition.midlet.MIDlet;

/**
 * @author TOghenekohwo
 */
public class StartMidlet extends MIDlet {

    public void startApp() {
        Display.init(this);
        try {
            Thread.sleep(000);
        } catch(InterruptedException e) { }
        try{
            new LoginForm(this);
            
        }catch(Exception e) {
            e.printStackTrace();
        } 
    }
    
    public void pauseApp() {
    }
    
    public void destroyApp(boolean unconditional) {
    }
    
    public void quit(){
        destroyApp(true);
        notifyDestroyed();
    }
}
