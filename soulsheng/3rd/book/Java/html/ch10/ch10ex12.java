import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class Calculator1 extends JFrame{
	static String str="";
	private JTextField tf1;
	private JTextField tf2;
	private Container cp;
	private String btn[]={"0","1","2","3","4","5","6","7","8","9","+","-","*","/","=","."};
	JButton b[]=new JButton[16];
	public Calculator1(){
		setTitle("简易计算器");
		setSize(300,200);
		cp=getContentPane();
		cp.setLayout(new BorderLayout());
		JPanel jp1=new JPanel();
		JPanel jp2=new JPanel();
		JPanel jp3=new JPanel();
		Font ft1=new Font("Times",Font.PLAIN,20);
		Font ft2=new Font("宋体",Font.PLAIN,14);
		tf1=new JTextField(26);
		jp1.add(tf1);
		tf2=new JTextField(18);
		JLabel label=new JLabel("事件来源按钮");
		jp2.add(label);
		label.setFont(ft2);
		jp2.add(tf2);
		jp3.setLayout(new GridLayout(4,4));
		for(int j=0;j<btn.length;j++){
			b[j]=new JButton(btn[j]);
			jp3.add(b[j]);
			b[j].setFont(ft1);
			b[j].addActionListener(new CalButton());
		}
		cp.add(jp1,BorderLayout.NORTH);
		cp.add(jp2,BorderLayout.SOUTH);
		cp.add(jp3,BorderLayout.CENTER);
		addWindowListener(new WindowDestroyer());
	}
	class CalButton implements ActionListener{
		public void actionPerformed(ActionEvent e){
			str=str+e.getActionCommand();
			tf1.setText(str);
			tf2.setText(e.getActionCommand());
		}
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex12{
	public static void main(String args[]) {
		Calculator1 win=new Calculator1();
		win.setVisible(true);
	}
}