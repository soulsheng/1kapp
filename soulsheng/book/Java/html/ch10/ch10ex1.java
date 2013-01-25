import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
public class ch10ex1{
	public static void main(String args[]){
		JFrame win1=new JFrame("The First Window");
		win1.setSize(300,200);
		win1.setLocation(50,50);
		JLabel mylabel=new JLabel("This is a label");
		win1.getContentPane().add(mylabel);
		WindowDestroyer myListener=new WindowDestroyer();
		win1.addWindowListener(myListener);
		win1.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}