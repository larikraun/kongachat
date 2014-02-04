/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.kngachat.classes;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import javax.microedition.io.Connector;
import javax.microedition.io.HttpConnection;
import org.json.me.JSONException;
import org.json.me.JSONObject;


/**
 *
 * @author TOghenekohwo
 */
public class URLHelper {
    
    private String url;
    final String base_url = "http://192.168.1.3/core/";
    
    
    JSONObject ret = new JSONObject();
    
    public URLHelper(String myUrl) {
        setURL(base_url+myUrl);
    }
    
    private void setURL(String url){
        this.url = url;
    }
    
    private String getURl(){
        return this.url;
    }
    
    ////////////////////////////////////////////////////////////////
    
    public JSONObject get() throws JSONException{
        HttpConnection httpConn = null;
        String uri = getURl();
        InputStream is = null;
        OutputStream os = null; 
        try{
            // Open an HTTP Connection object
            httpConn = (HttpConnection)Connector.open(uri);
            // Setup HTTP Request
            httpConn.setRequestMethod(HttpConnection.GET);
            httpConn.setRequestProperty("User-Agent","Profile/MIDP-2.0 Confirguration/CLDC-1.1");
            
            // This function retrieves the information of this connection
            //getConnectionInformation(httpConn);
            
            
            
            int respCode = httpConn.getResponseCode();
            if (respCode == HttpConnection.HTTP_OK) {
                StringBuffer sb = new StringBuffer();
                os = httpConn.openOutputStream();
                is = httpConn.openDataInputStream();
                int chr;
                while ((chr = is.read()) != -1)
                    sb.append((char) chr);
                return new JSONObject(sb.toString());
            }else if(respCode==HttpConnection.HTTP_CLIENT_TIMEOUT){
                ret.put("fail", "timeout");
                return ret;
                //return new JSONObject;
            }
            else {
                ret.put("fail", "fail");
                return ret;
            }

        }catch(IOException e) {
            ret.put("fail", "timeout");
            return ret;
        }
        finally {
            try{
                if(is!= null)
                    is.close();
                if(os != null)
                    os.close();
                if(httpConn != null)
                    httpConn.close();
            }catch(IOException e) {
                ret.put("fail", "timeout");
                return ret;
            }
        }
    }

}
