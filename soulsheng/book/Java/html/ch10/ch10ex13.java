import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class IconButtonOrLabel extends JFrame{
	private Container cp;
	JButton b1,b2;
	JLabel l1,l2;
	public IconButtonOrLabel(){
		setTitle("图标标签和按钮");
		setSize(320,250);
		cp=getContentPane();
		cp.setLayout(new BorderLayout());
		JPanel jp1=new JPanel();
		JPanel jp2=new JPanel();
		Font ft=new Font("宋体",Font.PLAIN,14);
		ImageIcon catIcon=new ImageIcon("cat.gif");
		l1=new JLabel(catIcon);
		b1=new JButton(catIcon);
		ImageIcon dogIcon=new ImageIcon("tom.gif");
		l2=new JLabel("标签");
		b2=new JButton("按钮");
		l2.setIcon(dogIcon);
		b2.setIcon(dogIcon);
		jp1.add(l1);jp1.add(b1);
		l2.setFont(ft);b2.setFont(ft);
		jp2.add(l2);jp2.add(b2);
		jp1.setBackground(Color.pink);
		jp2.setBackground(Color.orange);
		cp.add(jp1,BorderLayout.NORTH);
		cp.add(jp2,BorderLayout.SOUTH);
		b2.addActionListener(new LabelButton());
		b1.setActionCommand("这是一个没有文字的按钮");
		b1.addActionListener(new LabelButton());
		addWindowListener(new WindowDestroyer());
	}
	class LabelButton implements ActionListener{
		public void actionPerformed(ActionEvent e){
			System.out.println(e.getActionCommand());
		}
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex13{
	public static void main(String args[]) {
		IconButtonOrLabel win=new IconButtonOrLabel();
		win.setVisible(true);
	}
}