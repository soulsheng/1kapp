import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Frame3 extends JFrame{
	JTextField t1=new JTextField(25);
	JTextField t2=new JTextField(20);
	JTextField t3=new JTextField(10);
	Container cp;
	public Frame3(){
		super();
		setTitle("Text Field Demo");
		cp=getContentPane();
		cp.setLayout(new FlowLayout());
		cp.add(t1);
		cp.add(t2);
		cp.add(t3);		
		setSize(300,200);
		setLocation(50,50);
		addWindowListener(new WindowDestroyer());
	}
}
public class ch10ex4{
	public static void main(String args[]){
		Frame3 win=new Frame3();
		win.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}