import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Frame6 extends JFrame{
	JTextField t1=new JTextField(8);
	JTextField t2=new JTextField(8);
	Container cp;
	public Frame6(){
		super();
		setTitle("Text Field Verify");
		cp=getContentPane();
		cp.setLayout(new FlowLayout());
		cp.add(t1);
		cp.add(t2);
		t1.requestFocus();
		t1.addActionListener(new ActionListenerT1());
		t2.addActionListener(new ActionListenerT2());
		setSize(300,150);
		setLocation(50,50);
		addWindowListener(new WindowDestroyer());
	}
	class ActionListenerT1 implements ActionListener{
		public void actionPerformed(ActionEvent e){
			if(validInteger(t1))
				t1.transferFocus();
			else{
				t1.requestFocus();
				t1.selectAll();
			}
		}
	}
	class ActionListenerT2 implements ActionListener{
		public void actionPerformed(ActionEvent e){
			if(validInteger(t2))
				t2.transferFocus();
			else{
				t2.requestFocus();
				t2.selectAll();
			}
		}
	}
	private boolean validInteger(JTextField in){
		try{
			Integer.parseInt(in.getText());
			return true;
		}catch(NumberFormatException e){
			return false;
		}
	}
}
public class ch10ex7{
	public static void main(String args[]){
		Frame6 win=new Frame6();
		win.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}