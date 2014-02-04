/**
 * This class contains generated code from the Codename One Designer, DO NOT MODIFY!
 * This class is designed for subclassing that way the code generator can overwrite it
 * anytime without erasing your changes which should exist in a subclass!
 * For details about this file and how it works please read this blog post:
 * http://codenameone.blogspot.com/2010/10/ui-builder-class-how-to-actually-use.html
*/
package generated;

import com.codename1.ui.*;
import com.codename1.ui.util.*;
import com.codename1.ui.plaf.*;
import com.codename1.ui.events.*;

public abstract class StateMachineBase extends UIBuilder {
    private Container aboutToShowThisContainer;
    /**
     * this method should be used to initialize variables instead of
     * the constructor/class scope to avoid race conditions
     */
    /**
    * @deprecated use the version that accepts a resource as an argument instead
    
**/
    protected void initVars() {}

    protected void initVars(Resources res) {}

    public StateMachineBase(Resources res, String resPath, boolean loadTheme) {
        startApp(res, resPath, loadTheme);
    }

    public Container startApp(Resources res, String resPath, boolean loadTheme) {
        initVars();
        UIBuilder.registerCustomComponent("Button", com.codename1.ui.Button.class);
        UIBuilder.registerCustomComponent("ComboBox", com.codename1.ui.ComboBox.class);
        UIBuilder.registerCustomComponent("Form", com.codename1.ui.Form.class);
        UIBuilder.registerCustomComponent("Label", com.codename1.ui.Label.class);
        UIBuilder.registerCustomComponent("TextArea", com.codename1.ui.TextArea.class);
        UIBuilder.registerCustomComponent("TextField", com.codename1.ui.TextField.class);
        UIBuilder.registerCustomComponent("Container", com.codename1.ui.Container.class);
        if(loadTheme) {
            if(res == null) {
                try {
                    if(resPath.endsWith(".res")) {
                        res = Resources.open(resPath);
                        System.out.println("Warning: you should construct the state machine without the .res extension to allow theme overlays");
                    } else {
                        res = Resources.openLayered(resPath);
                    }
                } catch(java.io.IOException err) { err.printStackTrace(); }
            }
            initTheme(res);
        }
        if(res != null) {
            setResourceFilePath(resPath);
            setResourceFile(res);
            initVars(res);
            return showForm(getFirstFormName(), null);
        } else {
            Form f = (Form)createContainer(resPath, getFirstFormName());
            initVars(fetchResourceFile());
            beforeShow(f);
            f.show();
            postShow(f);
            return f;
        }
    }

    protected String getFirstFormName() {
        return "Signup";
    }

    public Container createWidget(Resources res, String resPath, boolean loadTheme) {
        initVars();
        UIBuilder.registerCustomComponent("Button", com.codename1.ui.Button.class);
        UIBuilder.registerCustomComponent("ComboBox", com.codename1.ui.ComboBox.class);
        UIBuilder.registerCustomComponent("Form", com.codename1.ui.Form.class);
        UIBuilder.registerCustomComponent("Label", com.codename1.ui.Label.class);
        UIBuilder.registerCustomComponent("TextArea", com.codename1.ui.TextArea.class);
        UIBuilder.registerCustomComponent("TextField", com.codename1.ui.TextField.class);
        UIBuilder.registerCustomComponent("Container", com.codename1.ui.Container.class);
        if(loadTheme) {
            if(res == null) {
                try {
                    res = Resources.openLayered(resPath);
                } catch(java.io.IOException err) { err.printStackTrace(); }
            }
            initTheme(res);
        }
        return createContainer(resPath, "Signup");
    }

    protected void initTheme(Resources res) {
            String[] themes = res.getThemeResourceNames();
            if(themes != null && themes.length > 0) {
                UIManager.getInstance().setThemeProps(res.getTheme(themes[0]));
            }
    }

    public StateMachineBase() {
    }

    public StateMachineBase(String resPath) {
        this(null, resPath, true);
    }

    public StateMachineBase(Resources res) {
        this(res, null, true);
    }

    public StateMachineBase(String resPath, boolean loadTheme) {
        this(null, resPath, loadTheme);
    }

    public StateMachineBase(Resources res, boolean loadTheme) {
        this(res, null, loadTheme);
    }

    public com.codename1.ui.Component findLogin(Component root) {
        return (com.codename1.ui.Component)findByName("Login", root);
    }

    public com.codename1.ui.Component findLogin() {
        com.codename1.ui.Component cmp = (com.codename1.ui.Component)findByName("Login", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.Component)findByName("Login", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.Container findContainer1(Component root) {
        return (com.codename1.ui.Container)findByName("Container1", root);
    }

    public com.codename1.ui.Container findContainer1() {
        com.codename1.ui.Container cmp = (com.codename1.ui.Container)findByName("Container1", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.Container)findByName("Container1", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.TextField findPasswordField(Component root) {
        return (com.codename1.ui.TextField)findByName("passwordField", root);
    }

    public com.codename1.ui.TextField findPasswordField() {
        com.codename1.ui.TextField cmp = (com.codename1.ui.TextField)findByName("passwordField", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.TextField)findByName("passwordField", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.TextArea findTextArea(Component root) {
        return (com.codename1.ui.TextArea)findByName("TextArea", root);
    }

    public com.codename1.ui.TextArea findTextArea() {
        com.codename1.ui.TextArea cmp = (com.codename1.ui.TextArea)findByName("TextArea", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.TextArea)findByName("TextArea", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.Button findSignUp(Component root) {
        return (com.codename1.ui.Button)findByName("SignUp", root);
    }

    public com.codename1.ui.Button findSignUp() {
        com.codename1.ui.Button cmp = (com.codename1.ui.Button)findByName("SignUp", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.Button)findByName("SignUp", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.TextField findConfirmField(Component root) {
        return (com.codename1.ui.TextField)findByName("confirmField", root);
    }

    public com.codename1.ui.TextField findConfirmField() {
        com.codename1.ui.TextField cmp = (com.codename1.ui.TextField)findByName("confirmField", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.TextField)findByName("confirmField", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.Button findButton(Component root) {
        return (com.codename1.ui.Button)findByName("Button", root);
    }

    public com.codename1.ui.Button findButton() {
        com.codename1.ui.Button cmp = (com.codename1.ui.Button)findByName("Button", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.Button)findByName("Button", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.ComboBox findComboBox(Component root) {
        return (com.codename1.ui.ComboBox)findByName("ComboBox", root);
    }

    public com.codename1.ui.ComboBox findComboBox() {
        com.codename1.ui.ComboBox cmp = (com.codename1.ui.ComboBox)findByName("ComboBox", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.ComboBox)findByName("ComboBox", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.TextField findEmailField(Component root) {
        return (com.codename1.ui.TextField)findByName("emailField", root);
    }

    public com.codename1.ui.TextField findEmailField() {
        com.codename1.ui.TextField cmp = (com.codename1.ui.TextField)findByName("emailField", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.TextField)findByName("emailField", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.Label findLabel(Component root) {
        return (com.codename1.ui.Label)findByName("Label", root);
    }

    public com.codename1.ui.Label findLabel() {
        com.codename1.ui.Label cmp = (com.codename1.ui.Label)findByName("Label", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.Label)findByName("Label", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.TextField findPassWordSign(Component root) {
        return (com.codename1.ui.TextField)findByName("passWordSign", root);
    }

    public com.codename1.ui.TextField findPassWordSign() {
        com.codename1.ui.TextField cmp = (com.codename1.ui.TextField)findByName("passWordSign", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.TextField)findByName("passWordSign", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.TextField findEmailFieldSign(Component root) {
        return (com.codename1.ui.TextField)findByName("emailFieldSign", root);
    }

    public com.codename1.ui.TextField findEmailFieldSign() {
        com.codename1.ui.TextField cmp = (com.codename1.ui.TextField)findByName("emailFieldSign", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.TextField)findByName("emailFieldSign", aboutToShowThisContainer);
        }
        return cmp;
    }

    public com.codename1.ui.Container findContainer(Component root) {
        return (com.codename1.ui.Container)findByName("Container", root);
    }

    public com.codename1.ui.Container findContainer() {
        com.codename1.ui.Container cmp = (com.codename1.ui.Container)findByName("Container", Display.getInstance().getCurrent());
        if(cmp == null && aboutToShowThisContainer != null) {
            cmp = (com.codename1.ui.Container)findByName("Container", aboutToShowThisContainer);
        }
        return cmp;
    }

    protected void exitForm(Form f) {
        if("ChatForm".equals(f.getName())) {
            exitChatForm(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("UsersForm".equals(f.getName())) {
            exitUsersForm(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Main".equals(f.getName())) {
            exitMain(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Login".equals(f.getName())) {
            exitLogin(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Signup".equals(f.getName())) {
            exitSignup(f);
            aboutToShowThisContainer = null;
            return;
        }

    }


    protected void exitChatForm(Form f) {
    }


    protected void exitUsersForm(Form f) {
    }


    protected void exitMain(Form f) {
    }


    protected void exitLogin(Form f) {
    }


    protected void exitSignup(Form f) {
    }

    protected void beforeShow(Form f) {
    aboutToShowThisContainer = f;
        if("ChatForm".equals(f.getName())) {
            beforeChatForm(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("UsersForm".equals(f.getName())) {
            beforeUsersForm(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Main".equals(f.getName())) {
            beforeMain(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Login".equals(f.getName())) {
            beforeLogin(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Signup".equals(f.getName())) {
            beforeSignup(f);
            aboutToShowThisContainer = null;
            return;
        }

    }


    protected void beforeChatForm(Form f) {
    }


    protected void beforeUsersForm(Form f) {
    }


    protected void beforeMain(Form f) {
    }


    protected void beforeLogin(Form f) {
    }


    protected void beforeSignup(Form f) {
    }

    protected void beforeShowContainer(Container c) {
    aboutToShowThisContainer = c;
        if("ChatForm".equals(c.getName())) {
            beforeContainerChatForm(c);
            aboutToShowThisContainer = null;
            return;
        }

        if("UsersForm".equals(c.getName())) {
            beforeContainerUsersForm(c);
            aboutToShowThisContainer = null;
            return;
        }

        if("Main".equals(c.getName())) {
            beforeContainerMain(c);
            aboutToShowThisContainer = null;
            return;
        }

        if("Login".equals(c.getName())) {
            beforeContainerLogin(c);
            aboutToShowThisContainer = null;
            return;
        }

        if("Signup".equals(c.getName())) {
            beforeContainerSignup(c);
            aboutToShowThisContainer = null;
            return;
        }

    }


    protected void beforeContainerChatForm(Container c) {
    }


    protected void beforeContainerUsersForm(Container c) {
    }


    protected void beforeContainerMain(Container c) {
    }


    protected void beforeContainerLogin(Container c) {
    }


    protected void beforeContainerSignup(Container c) {
    }

    protected void postShow(Form f) {
        if("ChatForm".equals(f.getName())) {
            postChatForm(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("UsersForm".equals(f.getName())) {
            postUsersForm(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Main".equals(f.getName())) {
            postMain(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Login".equals(f.getName())) {
            postLogin(f);
            aboutToShowThisContainer = null;
            return;
        }

        if("Signup".equals(f.getName())) {
            postSignup(f);
            aboutToShowThisContainer = null;
            return;
        }

    }


    protected void postChatForm(Form f) {
    }


    protected void postUsersForm(Form f) {
    }


    protected void postMain(Form f) {
    }


    protected void postLogin(Form f) {
    }


    protected void postSignup(Form f) {
    }

    protected void postShowContainer(Container c) {
        if("ChatForm".equals(c.getName())) {
            postContainerChatForm(c);
            aboutToShowThisContainer = null;
            return;
        }

        if("UsersForm".equals(c.getName())) {
            postContainerUsersForm(c);
            aboutToShowThisContainer = null;
            return;
        }

        if("Main".equals(c.getName())) {
            postContainerMain(c);
            aboutToShowThisContainer = null;
            return;
        }

        if("Login".equals(c.getName())) {
            postContainerLogin(c);
            aboutToShowThisContainer = null;
            return;
        }

        if("Signup".equals(c.getName())) {
            postContainerSignup(c);
            aboutToShowThisContainer = null;
            return;
        }

    }


    protected void postContainerChatForm(Container c) {
    }


    protected void postContainerUsersForm(Container c) {
    }


    protected void postContainerMain(Container c) {
    }


    protected void postContainerLogin(Container c) {
    }


    protected void postContainerSignup(Container c) {
    }

    protected void onCreateRoot(String rootName) {
        if("ChatForm".equals(rootName)) {
            onCreateChatForm();
            aboutToShowThisContainer = null;
            return;
        }

        if("UsersForm".equals(rootName)) {
            onCreateUsersForm();
            aboutToShowThisContainer = null;
            return;
        }

        if("Main".equals(rootName)) {
            onCreateMain();
            aboutToShowThisContainer = null;
            return;
        }

        if("Login".equals(rootName)) {
            onCreateLogin();
            aboutToShowThisContainer = null;
            return;
        }

        if("Signup".equals(rootName)) {
            onCreateSignup();
            aboutToShowThisContainer = null;
            return;
        }

    }


    protected void onCreateChatForm() {
    }


    protected void onCreateUsersForm() {
    }


    protected void onCreateMain() {
    }


    protected void onCreateLogin() {
    }


    protected void onCreateSignup() {
    }

    protected boolean setListModel(List cmp) {
        String listName = cmp.getName();
        if("ComboBox".equals(listName)) {
            return initListModelComboBox(cmp);
        }
        return super.setListModel(cmp);
    }

    protected boolean initListModelComboBox(List cmp) {
        return false;
    }

    protected void handleComponentAction(Component c, ActionEvent event) {
        Container rootContainerAncestor = getRootAncestor(c);
        if(rootContainerAncestor == null) return;
        String rootContainerName = rootContainerAncestor.getName();
        Container leadParentContainer = c.getParent().getLeadParent();
        if(leadParentContainer != null && leadParentContainer.getClass() != Container.class) {
            c = c.getParent().getLeadParent();
        }
        if(rootContainerName == null) return;
        if(rootContainerName.equals("ChatForm")) {
            if("TextArea".equals(c.getName())) {
                onChatForm_TextAreaAction(c, event);
                return;
            }
            if("Button".equals(c.getName())) {
                onChatForm_ButtonAction(c, event);
                return;
            }
            if("ComboBox".equals(c.getName())) {
                onChatForm_ComboBoxAction(c, event);
                return;
            }
        }
        if(rootContainerName.equals("Login")) {
            if("emailField".equals(c.getName())) {
                onLogin_EmailFieldAction(c, event);
                return;
            }
            if("passwordField".equals(c.getName())) {
                onLogin_PasswordFieldAction(c, event);
                return;
            }
            if("confirmField".equals(c.getName())) {
                onLogin_ConfirmFieldAction(c, event);
                return;
            }
            if("SignUp".equals(c.getName())) {
                onLogin_SignUpAction(c, event);
                return;
            }
        }
        if(rootContainerName.equals("Signup")) {
            if("emailFieldSign".equals(c.getName())) {
                onSignup_EmailFieldSignAction(c, event);
                return;
            }
            if("passWordSign".equals(c.getName())) {
                onSignup_PassWordSignAction(c, event);
                return;
            }
            if("Login".equals(c.getName())) {
                onSignup_LoginAction(c, event);
                return;
            }
            if("SignUp".equals(c.getName())) {
                onSignup_SignUpAction(c, event);
                return;
            }
        }
    }

      protected void onChatForm_TextAreaAction(Component c, ActionEvent event) {
      }

      protected void onChatForm_ButtonAction(Component c, ActionEvent event) {
      }

      protected void onChatForm_ComboBoxAction(Component c, ActionEvent event) {
      }

      protected void onLogin_EmailFieldAction(Component c, ActionEvent event) {
      }

      protected void onLogin_PasswordFieldAction(Component c, ActionEvent event) {
      }

      protected void onLogin_ConfirmFieldAction(Component c, ActionEvent event) {
      }

      protected void onLogin_SignUpAction(Component c, ActionEvent event) {
      }

      protected void onSignup_EmailFieldSignAction(Component c, ActionEvent event) {
      }

      protected void onSignup_PassWordSignAction(Component c, ActionEvent event) {
      }

      protected void onSignup_LoginAction(Component c, ActionEvent event) {
      }

      protected void onSignup_SignUpAction(Component c, ActionEvent event) {
      }

}
