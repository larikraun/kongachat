/**
 * Your application code goes here
 */
package userclasses;

import com.codename1.components.InfiniteProgress;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkManager;
import com.codename1.io.Storage;
import generated.StateMachineBase;
import com.codename1.ui.*;
import com.codename1.ui.events.*;
import com.codename1.ui.util.Resources;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.Hashtable;
import java.util.Vector;
import org.json.me.*;

/**
 *
 * @author Your name here
 */
public class StateMachine extends StateMachineBase {

    public StateMachine(String resFile) {
        super(resFile);
        // do not modify, write code in initVars and initialize class members there,
        // the constructor might be invoked too late due to race conditions that might occur
    }
    Hashtable responseHash;
    Vector responseVec;
    JSONArray ja;
    String status, loginStatus;

    /**
     * this method should be used to initialize variables instead of the
     * constructor/class scope to avoid race conditions
     */
    protected void initVars(Resources res) {
    }

    //  @Override
    protected void onLogin_ButtonAction(Component c, ActionEvent event) {
    }

    public void connectDatabaseSignUp(String email , String password, String confirm) {
        final ConnectionRequest conn;
        conn = new ConnectionRequest() {
//           @Override
//            protected void buildRequestBody(OutputStream os) throws IOException {
//               os.write(json.getBytes("UTF-8"));
//           }
            @Override
            protected void readHeaders(Object connection) throws IOException {
                status = getHeader(connection, "status"); // if the status is in the headerrd
                // super.readHeaders(connection); //To change body of generated methods, choose Tools | Templates.
            }

            @Override
            protected void readResponse(InputStream input) throws IOException {
                JSONParser jp = new JSONParser();
                Hashtable h1 = jp.parse(new InputStreamReader(input));
                System.out.println("hujj" + h1.toString());
                try {
                    responseHash = jp.parse(new InputStreamReader(input));
                    responseVec = (Vector) responseHash.get("root");
                    loginStatus = responseHash.get("status").toString();
                    System.out.println("you have " + responseHash + "and the value is " + responseHash.get("status"));


                } catch (Exception e) {
                    System.out.println("exception " + e.getMessage());
                }

                // h = (Vector) h1.get("");
//                System.out.println(quesHash);
//                System.out.println(status1);
//                System.out.println(quesVector);

                //super.readResponse(input); //To change body of generated methods, choose Tools | Templates.
            }
        };
        final NetworkManager nm = NetworkManager.getInstance();
        Command c = new Command("Cancel") {
            @Override
            public void actionPerformed(ActionEvent evt) {

                ((Dialog) Display.getInstance().getCurrent()).dispose();
                nm.killAndWait(conn);
            }
        };
        InfiniteProgress ip = new InfiniteProgress();
        //Dialog dlg = ip.showInifiniteBlocking();


        Dialog d = new Dialog();
        d.setDialogUIID("Label");
        // d.setLayout(new BorderLayout());
        // Container cnt = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        Label l = new Label("Loading");
        l.getStyle().getBgTransparency();
        //cnt.addComponent(l);
        //  cnt.addComponent(ip);
        //   d.addComponent(BorderLayout.CENTER, cnt);
        //d.setTransitionInAnimator(CommonTransitions.createEmpty());
        ///d.setTransitionOutAnimator(CommonTransitions.createEmpty());
        //d.showPacked(BorderLayout.CENTER, false);
        //d.setBackCommand(c);


        String url = "http://192.168.1.3/core/user/signup?email=" + email + "&password=" + password + "&c_password=" + confirm;
        //String url = "http://google.com";
        conn.setUrl(url); //gets the url u want to talk to
        conn.setContentType("application/json");
        conn.setPost(false);
        conn.setHttpMethod("GET"); //could be put if put was set true
        conn.setFailSilently(true);
        conn.setDuplicateSupported(true);
        conn.setDisposeOnCompletion(d);
        // final NetworkManager nm = NetworkManager.getInstance();
        nm.start();
        nm.addToQueueAndWait(conn);
    }
public void connectDatabaseSend(String email, String password, String confirm) {
        final ConnectionRequest conn;
        conn = new ConnectionRequest() {
//           @Override
//            protected void buildRequestBody(OutputStream os) throws IOException {
//               os.write(json.getBytes("UTF-8"));
//           }
            @Override
            protected void readHeaders(Object connection) throws IOException {
                status = getHeader(connection, "status"); // if the status is in the headerrd
                // super.readHeaders(connection); //To change body of generated methods, choose Tools | Templates.
            }

            @Override
            protected void readResponse(InputStream input) throws IOException {
                JSONParser jp = new JSONParser();
                Hashtable h1 = jp.parse(new InputStreamReader(input));
                System.out.println("hujj" + h1.toString());
                try {
                    responseHash = jp.parse(new InputStreamReader(input));
                    responseVec = (Vector) responseHash.get("root");
                    loginStatus = responseHash.get("status").toString();
                    System.out.println("you have " + responseHash + "and the value is " + responseHash.get("status"));


                } catch (Exception e) {
                    System.out.println("exception " + e.getMessage());
                }

                // h = (Vector) h1.get("");
//                System.out.println(quesHash);
//                System.out.println(status1);
//                System.out.println(quesVector);

                //super.readResponse(input); //To change body of generated methods, choose Tools | Templates.
            }
        };
        final NetworkManager nm = NetworkManager.getInstance();
        Command c = new Command("Cancel") {
            @Override
            public void actionPerformed(ActionEvent evt) {

                ((Dialog) Display.getInstance().getCurrent()).dispose();
                nm.killAndWait(conn);
            }
        };
        InfiniteProgress ip = new InfiniteProgress();
        //Dialog dlg = ip.showInifiniteBlocking();


        Dialog d = new Dialog();
        d.setDialogUIID("Label");
        // d.setLayout(new BorderLayout());
        // Container cnt = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        Label l = new Label("Loading");
        l.getStyle().getBgTransparency();
        //cnt.addComponent(l);
        //  cnt.addComponent(ip);
        //   d.addComponent(BorderLayout.CENTER, cnt);
        //d.setTransitionInAnimator(CommonTransitions.createEmpty());
        ///d.setTransitionOutAnimator(CommonTransitions.createEmpty());
        //d.showPacked(BorderLayout.CENTER, false);
        //d.setBackCommand(c);


        String url = "http://192.168.1.3/core/user/signup?email=" + email + "&password=" + password + "&c_password=" + confirm;
        //String url = "http://google.com";
        conn.setUrl(url); //gets the url u want to talk to
        conn.setContentType("application/json");
        conn.setPost(false);
        conn.setHttpMethod("GET"); //could be put if put was set true
        conn.setFailSilently(true);
        conn.setDuplicateSupported(true);
        conn.setDisposeOnCompletion(d);
        // final NetworkManager nm = NetworkManager.getInstance();
        nm.start();
        nm.addToQueueAndWait(conn);
    }
    public void connectDatabase(String email, String password) {
        final ConnectionRequest conn;
        conn = new ConnectionRequest() {
//           @Override
//            protected void buildRequestBody(OutputStream os) throws IOException {
//               os.write(json.getBytes("UTF-8"));
//           }
            @Override
            protected void readHeaders(Object connection) throws IOException {
                status = getHeader(connection, "status"); // if the status is in the headerrd
                // super.readHeaders(connection); //To change body of generated methods, choose Tools | Templates.
            }

            @Override
            protected void readResponse(InputStream input) throws IOException {
                JSONParser jp = new JSONParser();
                // Hashtable h1 = jp.parse(new InputStreamReader(input));
                //  responseVec.add(h1);
                //    JSONArray ja = new JSONArray(responseVec);J
               
                try {
                    
                    responseHash = jp.parse(new InputStreamReader(input));
                   Hashtable h1 = (Hashtable)responseHash.get("response");
                    System.out.println("vector " + h1);
                    System.out.println("usrera ======" + h1.get("users"));
                    ja = new JSONArray(h1.get("users").toString());
                    //ja.put(h1.get("users"));
                    //Hashtable h2 = (Hashtable)h1.get("users");
                    System.out.println("tygdy===== " +ja.getJSONObject(0));
                    
                } catch (Exception e) {
                    System.out.println("exception==== " + e.toString());
                }
            }
        };
        final NetworkManager nm = NetworkManager.getInstance();
        Command c = new Command("Cancel") {
            @Override
            public void actionPerformed(ActionEvent evt) {

                ((Dialog) Display.getInstance().getCurrent()).dispose();
                nm.killAndWait(conn);
            }
        };
        InfiniteProgress ip = new InfiniteProgress();
        //Dialog dlg = ip.showInifiniteBlocking();


        Dialog d = new Dialog();
        d.setDialogUIID("Label");
        // d.setLayout(new BorderLayout());
        // Container cnt = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        Label l = new Label("Loading");
        l.getStyle().getBgTransparency();
        //cnt.addComponent(l);
        //  cnt.addComponent(ip);
        //   d.addComponent(BorderLayout.CENTER, cnt);
        //d.setTransitionInAnimator(CommonTransitions.createEmpty());
        ///d.setTransitionOutAnimator(CommonTransitions.createEmpty());
        //d.showPacked(BorderLayout.CENTER, false);
        //d.setBackCommand(c);


        String url = "http://192.168.1.3/core/user/auth?email=" + email + "&password=" + password;
        //String url = "http://google.com";
        conn.setUrl(url); //gets the url u want to talk to
        conn.setContentType("application/json");
        conn.setPost(false);
        conn.setHttpMethod("GET"); //could be put if put was set true
        conn.setFailSilently(true);
        conn.setDuplicateSupported(true);
        conn.setDisposeOnCompletion(d);
        // final NetworkManager nm = NetworkManager.getInstance();
        nm.start();
        nm.addToQueueAndWait(conn);
    }

    @Override
    protected void onSignup_LoginAction(Component c, ActionEvent event) {
//        if (Storage.getInstance().exists("details")) {
//            Vector vect = new Vector<Hashtable>();
//            vect = (Vector<Hashtable>) Storage.getInstance().readObject("details");
//            System.out.println("vect contains " + vect.toString());
//            connectDatabase(status, status);
//        } else {
//            Dialog d = new Dialog();
//            TextField txt = new TextField("Details not found. Check your Login Details");
//            txt.setEditable(false);
//            d.addComponent(txt);
//            d.setTimeout(3000);
//            d.show();
//        }
        if (findEmailFieldSign(c.getComponentForm()).getText().length() != 0 && findPassWordSign(c.getComponentForm()).getText().length() != 0) {
            //   details.put("email", findEmailField(c.getComponentForm()).getText());
            //  details.put("password", findPasswordField(c.getComponentForm()).getText());
            //  vect.add(details);
            //    System.out.println("details " + details.toString());
            //     Storage.getInstance().writeObject("details", vect);
            //   System.out.println("details in storage " + details.toString());
            connectDatabase(findEmailFieldSign(c.getComponentForm()).getText(), findPassWordSign(c.getComponentForm()).getText());
            //    showForm("Login", null);
            showForm("ChatForm", null);
        } else {
            Dialog d = new Dialog();
            TextField txt = new TextField("Enter your details");
            txt.setEditable(false);
            d.addComponent(txt);
            d.setTimeout(3000);
            d.show();
        }
    }

    @Override
    protected void onSignup_SignUpAction(Component c, ActionEvent event) {
        showForm("Login", null);

    }

    @Override
    protected void beforeSignup(Form f) {
        Storage.getInstance().clearStorage();
    }

    @Override
    protected void onLogin_SignUpAction(Component c, ActionEvent event) {
        Hashtable details = new Hashtable();
        Vector<Hashtable> vect = new Vector<Hashtable>();
        if (findEmailField(c.getComponentForm()).getText().length() != 0 && findPasswordField(c.getComponentForm()).getText().length() != 0 && findConfirmField(c.getComponentForm()).getText().length() != 0) {
            if (findPasswordField(c.getComponentForm()).getText().equals(findConfirmField(c.getComponentForm()).getText())) {
                details.put("email", findEmailField(c.getComponentForm()).getText());
                details.put("password", findPasswordField(c.getComponentForm()).getText());
                vect.add(details);
                System.out.println("details " + details.toString());
                Storage.getInstance().writeObject("details", vect);
                System.out.println("details in storage " + details.toString());
                connectDatabaseSignUp(findEmailField(c.getComponentForm()).getText(), findPasswordField(c.getComponentForm()).getText(), findConfirmField(c.getComponentForm()).getText());
                showForm("ChatForm", null);
            } else {
                Dialog d = new Dialog();
                TextField txt = new TextField("Passwords don't match");
                txt.setEditable(false);
                d.addComponent(txt);
                d.setTimeout(3000);
                d.show();
            }
        } else {
            Dialog d = new Dialog();
            TextField txt = new TextField("Enter your details");
            txt.setEditable(false);
            d.addComponent(txt);
            d.setTimeout(3000);
            d.show();
        }
    }

    @Override
    protected void beforeUsersForm(Form f) {
    }

    @Override
    protected void beforeChatForm(Form f) {
       
        for(int i=0;i<ja.length();i++){
             
            try {
                JSONObject jb = (JSONObject)ja.get(i);
                findComboBox(f).addItem(jb.get("email"));
            } catch (JSONException ex) {
              
            }
        }
    }

    @Override
    protected void onChatForm_ButtonAction(Component c, ActionEvent event) {

    
    }
}
