import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Frame2 extends JFrame{
	Container cp;
	public Frame2(){
		super();
		setTitle("Layout Demo");
		cp=getContentPane();
		cp.setLayout(new BorderLayout());
		JLabel myLabel1=new JLabel("North");
		JLabel myLabel2=new JLabel("South");
		JLabel myLabel3=new JLabel("East");
		JLabel myLabel4=new JLabel("West");
		JLabel myLabel5=new JLabel("Center");
		cp.add(myLabel1,"North");
		cp.add(myLabel2,"South");
		cp.add(myLabel3,"East");		
		cp.add(myLabel4,"West");
		cp.add(myLabel5,"Center");
		setSize(200,200);
		setLocation(50,50);
		addWindowListener(new WindowDestroyer());
	}
}
public class ch10ex3{
	public static void main(String args[]){
		Frame2 win=new Frame2();
		win.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}