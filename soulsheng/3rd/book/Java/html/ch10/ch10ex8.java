import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Frame7 extends JFrame{
	JTextField t1=new JTextField(10);
	JTextField t2=new JTextField(10);
	JLabel label1=new JLabel("输入姓名");
	JLabel label2=new JLabel("输入口令");
	Container cp;
	String password="";
	public Frame7(){
		super();
		setTitle("登录窗口");
		cp=getContentPane();
		cp.setLayout(new FlowLayout());
		cp.add(label1);
		cp.add(t1);
		cp.add(label2);
		cp.add(t2);
		t1.requestFocus();
		t1.addKeyListener(new keyListenerT1());
		t2.addKeyListener(new keyListenerT2());
		setSize(200,100);
		setLocation(50,50);
		addWindowListener(new WindowDestroyer());
	}
	class keyListenerT1 implements KeyListener{
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
	}
}
public class ch10ex8{
	public static void main(String args[]){
		Frame7 win=new Frame7();
		win.setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}