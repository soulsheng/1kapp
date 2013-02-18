import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Frame1 extends JFrame{
	public Frame1(){
		super();
		setSize(300,200);
		setLocation(50,50);
		Container contentPane=getContentPane();
		JLabel myLabel=new JLabel("This is a label");
		setTitle("First Window");
		contentPane.add(myLabel);
		addWindowListener(new WindowDestroyer());
	}
	public Frame1(Color c){
		super();
		setSize(300,200);
		setLocation(200,200);
		Container contentPane=getContentPane();
		JLabel myLabel=new JLabel("This is a label");
		setTitle("Second Window");
		contentPane.add(myLabel);
		contentPane.setBackground(c);
		addWindowListener(new WindowDestroyer());
	}
}
public class ch10ex2{
	public static void main(String args[]){
		Frame1 win1=new Frame1();
		win1.setVisible(true);
		Frame1 win2=new Frame1(Color.orange);
		win2.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}