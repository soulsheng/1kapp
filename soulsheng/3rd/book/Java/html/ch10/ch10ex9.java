import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Frame8 extends JFrame{
	JTextField t1=new JTextField(10);
	JTextField t2=new JTextField(10);
	JLabel label1=new JLabel("输入姓名");
	JLabel label2=new JLabel("输入口令");
	Container cp;
	String password="";
	public Frame8(){
		super();
		setTitle("登录窗口");
		cp=getContentPane();
		cp.setLayout(new FlowLayout());
		cp.add(label1);
		cp.add(t1);
		cp.add(label2);
		cp.add(t2);
		t1.requestFocus();
//		t1.addKeyListener(new keyListenerT1());
//		t2.addKeyListener(new keyListenerT2());
		t1.addFocusListener(new focusListenerT1());
		t2.addFocusListener(new focusListenerT2());
		setSize(200,100);
		setLocation(50,50);
		addWindowListener(new WindowDestroyer());
	}
/*	class keyListenerT1 implements KeyListener{
		public void keyPressed(KeyEvent e){}
		public void keyReleased(KeyEvent e){}
		public void keyTyped(KeyEvent e){
			char c=e.getKeyChar();
			if(!Character.isLetter(c))
				e.setKeyChar('\0');
		}
	}
	class keyListenerT2 implements KeyListener{
		public void keyPressed(KeyEvent e){}
		public void keyReleased(KeyEvent e){}
		public void keyTyped(KeyEvent e){
			char c=e.getKeyChar();
			password=password+c;
			e.setKeyChar('*');
		}
	}*/
	class focusListenerT1 implements FocusListener{
		public void focusLost(FocusEvent e){
			t1.setText("Focus lost");
		}
		public void focusGained(FocusEvent e){
			t1.setText("Foucs gained");
		}
	}
	class focusListenerT2 implements FocusListener{
		public void focusLost(FocusEvent e){
			t2.setText("Focus lost");
		}
		public void focusGained(FocusEvent e){
			t2.setText("Foucs gained");
		}
	}
}
public class ch10ex9{
	public static void main(String args[]){
		Frame8 win=new Frame8();
		win.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}