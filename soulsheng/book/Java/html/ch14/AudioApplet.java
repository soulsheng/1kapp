//AudioApplet.java
import java.awt.event.*;
import java.applet.*;
import javax.swing.*;
//import java.lang.Object;
import java.awt.*;


public class AudioApplet extends JApplet implements MouseListener{
  private boolean isStandalone = false;
  private JButton load=new JButton("load_AudioClip");
  private JButton play=new JButton("play_AudioClip");
  private JButton loop=new JButton("loop_AudioClip");
  private JButton stop=new JButton("stop_AudioClip");
  private JButton play2=new JButton("play_Applet");
 
 
  AudioClip au=null;
  //Get a parameter value
  //Construct the applet
  public AudioApplet() {
  }
  //Initialize the applet
  public void init() {
  	setSize(300,150);
     getContentPane().setLayout(new FlowLayout(FlowLayout.CENTER,2,2));
     getContentPane().add(load);
    getContentPane().add(play);
    getContentPane().add(loop);
    getContentPane().add(stop);
    getContentPane().add(play2);
 
    load.addMouseListener(this);
    play.addMouseListener(this);
	play2.addMouseListener(this);
	loop.addMouseListener(this);
	stop.addMouseListener(this);
	addMouseListener(this);

  }

  public void mousePressed(MouseEvent evt) {
  if(evt.getSource()==load){
  	System.out.println("OK!");
    au=getAudioClip(getCodeBase(),"pinball.mid");
    }
  if(evt.getSource()==play&&au!=null){
    au.play();
    }
  if(evt.getSource()==loop&&au!=null){
        au.loop();
     }
  if(evt.getSource()==stop){
        au.stop();
     }
  if(evt.getSource()==play2){
  	play(getCodeBase(),"bird.au");}
  	}
  
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mouseClicked(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
 }
