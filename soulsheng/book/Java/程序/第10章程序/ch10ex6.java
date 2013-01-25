import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Frame5 extends JFrame{
	JTextField t1=new JTextField(15);
	JTextArea t2=new JTextArea(11,15);
	JLabel label=new JLabel("Enter text content");
	Container cp;
	public Frame5(){
		super();
		setTitle("Text/Area Field");
		cp=getContentPane();
		cp.setLayout(new FlowLayout());
		cp.add(label);
		cp.add(t1);
		cp.add(t2);
		t1.addActionListener(new ActionListenerT1());
		setSize(300,300);
		setLocation(50,50);
		addWindowListener(new WindowDestroyer());
	}
	class ActionListenerT1 implements ActionListener{
		public void actionPerformed(ActionEvent e){
			String s=t1.getText();
			if(t2.getLineCount()<10){
				t1.setText("");
				t2.append(s+"\n");
			}
		}
	}
}
public class ch10ex6{
	public static void main(String args[]){
		Frame5 win=new Frame5();
		win.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}