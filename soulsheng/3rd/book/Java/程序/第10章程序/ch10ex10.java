import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class AnonymousClass extends JFrame{
	private JTextField tf;
	private Container cp;
	public AnonymousClass(){
		setTitle("Inner classes example");
		cp=getContentPane();
		tf=new JTextField(30);
		addWindowListener(new WindowDestroyer());
	}
	public void launchFrame(){
		JLabel label=new JLabel("Click and drag the mouse");
		cp.add(label,BorderLayout.NORTH);
		cp.add(tf,BorderLayout.SOUTH);
		cp.addMouseMotionListener(new MouseMotionAdapter(){//匿名类开始
			public void mouseDragged(MouseEvent e){
				String s="Mouse dragging: x=  "+e.getX()+"  Y=  "+e.getY();
				tf.setText(s);
			}
		});//匿名类结束 
		setSize(300,200);
		setVisible(true);
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex10{
	public static void main(String args[]) {
		AnonymousClass obj=new AnonymousClass();
		obj.launchFrame();
	}
}