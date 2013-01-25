import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Frame4 extends JFrame{
	JTextField t1=new JTextField(25);
	JTextField t2=new JTextField(20);
	JTextField t3=new JTextField(10);
	Container cp;
	public Frame4(){
		super();
		setTitle("Text Field with enter key");
		cp=getContentPane();
		cp.setLayout(new FlowLayout());
		cp.add(t1);
		cp.add(t2);
		cp.add(t3);	
		t1.addActionListener(new ActionListenerT1());
		t2.addActionListener(new ActionListenerT2());
		t3.addActionListener(new ActionListenerT3());
		setSize(300,200);
		setLocation(50,50);
		addWindowListener(new WindowDestroyer());
	}
	class ActionListenerT1 implements ActionListener{
		public void actionPerformed(ActionEvent e){
			String s=t1.getText();
			t2.setText(s);
			t1.transferFocus();
		}
	}
	class ActionListenerT2 implements ActionListener{
		public void actionPerformed(ActionEvent e){
			String s=t2.getText();
			t3.setText(s);
			t2.transferFocus();
		}
	}
	class ActionListenerT3 implements ActionListener{
		public void actionPerformed(ActionEvent e){
			String s=t3.getText();
			t1.setText(s);
			t3.transferFocus();
		}
	}

}
public class ch10ex5{
	public static void main(String args[]){
		Frame4 win=new Frame4();
		win.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}