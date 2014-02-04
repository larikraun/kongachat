/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.kongachat.forms;

import com.kongachat.midlet.StartMidlet;
import com.sun.lwuit.Command;
import com.sun.lwuit.Component;
import com.sun.lwuit.Form;
import com.sun.lwuit.List;
import com.sun.lwuit.events.ActionEvent;
import com.sun.lwuit.events.ActionListener;
import com.sun.lwuit.layouts.BorderLayout;
import com.sun.lwuit.list.DefaultListCellRenderer;
import org.json.me.JSONArray;
import org.json.me.JSONException;
import org.json.me.JSONObject;

/**
 *
 * @author phylyp
 */
public class UserSpaceForm extends Form implements ActionListener{
    
    private List userList;
    private StartMidlet midlet;
    private Command proceed,back;
    private String userDetails;
    
    private JSONArray globalList;
    private JSONObject myParams;
    
    public UserSpaceForm(StartMidlet m, JSONArray list,JSONObject myParams)
    {
        this.midlet = m;
        this.globalList = list;
        this.myParams = myParams;
        //this.userList = list
        setTitle("Users Online");
        
        
        String menuListItems [] = new String[list.length()];
        try{
            for(int i=0; i<list.length();i++){
                JSONObject x = list.getJSONObject(i);
                menuListItems[i] = x.getString("email");
            }
        }catch(Exception e){
            e.printStackTrace();
        }
        
        userList = new List(menuListItems);
        userList.setSelectedIndex(0);
        userList.setSmoothScrolling(true);
        userList.setFixedSelection(List.FIXED_NONE_CYCLIC);
        DefaultListCellRenderer listrenderer=new DefaultListCellRenderer(false);
        listrenderer.setAlignment(Component.CENTER);
        userList.setListCellRenderer(listrenderer);
        userList.addActionListener(this);
        setLayout(new BorderLayout());
        addComponent(BorderLayout.NORTH,userList);
        
        
        proceed = new Command("Proceed");
        
        addCommand(proceed);
        //addCommand(back);
        addCommandListener(this);
        show();
    }

    public void actionPerformed(ActionEvent ae) {
        JSONObject currUser = new JSONObject();
        if(ae.getSource()==userList || ae.getCommand()==proceed){
            int x = userList.getSelectedIndex();
            try {
                currUser = globalList.getJSONObject(x);
            } catch (JSONException ex) {
                ex.printStackTrace();
            }
            new ChatSpaceForm(midlet,currUser,myParams);
        }
    }
}
