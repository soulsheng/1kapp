//ShowLifeCycleApplet.java
import java.awt.Graphics; 
import java.awt.Color; 
import javax.swing.*;
public class ShowLifeCycleApplet extends JApplet 
{ 
    String showString = ""; 
    public void paint(Graphics g) 
    { 
        g.setColor(Color.red); 
        g.drawString(showString, 5, 25); 
    } 
    public void init() 
    { 
        showString=showString + "initializing..."; 
        repaint(); 
    } 
    public void start() 
    { 
        showString = showString +"starting..."; 
        repaint(); 
    } 
    public void stop() 
    { 
        showString = showString + "stopping..."; 
        repaint(); 
    } 
    public void destroy() 
    { 
        showString=showString+"destroyed..."; 
        this.repaint();
    } 
}
