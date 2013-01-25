import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class RadioCheckBoxButton extends JFrame{
	private Container cp;
	private JTextField text,text1;
	private JRadioButton jb1,jb2,jb3,jb4,jb5;
	JCheckBox cb1,cb2;
	private Font font;
	private JLabel label;
	private ButtonGroup rbg;
	private String style[]={"Serif","SansSerif","Times New Roman","Monospaced","Arial"};
	boolean st1=true,st2=false;
	int index,sign;
	public RadioCheckBoxButton(){
		setTitle("字体变化");
		setSize(300,250);
		cp=getContentPane();
		cp.setLayout(new GridLayout(4,0));
		JPanel jp1=new JPanel();
		JPanel jp2=new JPanel();
		JPanel jp3=new JPanel();
		JPanel jp4=new JPanel();
		text=new JTextField("Font Test",25);
		jp1.add(text);
		label=new JLabel("项目事件来源");
		text1=new JTextField(18);
		jp2.add(label);jp2.add(text1);
		font=new Font(style[0],Font.BOLD,14);
		index=0;sign=Font.BOLD;
		text.setFont(font);
		text1.setText(style[0]);
		jb1=new JRadioButton(style[0],true);
		jb2=new JRadioButton(style[1],false);
		jb3=new JRadioButton(style[2],false);
		jb4=new JRadioButton(style[3],false);
		jb5=new JRadioButton(style[4],false);
		rbg=new ButtonGroup();
		rbg.add(jb1);rbg.add(jb2);rbg.add(jb3);
		rbg.add(jb4);rbg.add(jb5);
		jp3.setLayout(new GridLayout(3,3));
		jp4.setLayout(new GridLayout(0,2));
		jp3.add(jb1);jp3.add(jb2);jp3.add(jb3);
		jp3.add(jb4);jp3.add(jb5);
		cb1=new JCheckBox("粗体",true);
		cb2=new JCheckBox("斜体",false);
		jp4.add(cb1);jp4.add(cb2);
		cp.add(jp1);cp.add(jp3);cp.add(jp4);cp.add(jp2);
		cb1.addItemListener(new CheckListener());
		cb2.addItemListener(new CheckListener());
		jb1.addItemListener(new RadioListener());
		jb2.addItemListener(new RadioListener());
		jb3.addItemListener(new RadioListener());
		jb4.addItemListener(new RadioListener());
		jb5.addItemListener(new RadioListener());
		addWindowListener(new WindowDestroyer());
	}
	class CheckListener implements ItemListener{
		public void itemStateChanged(ItemEvent e){
			text1.setText(e.getItem().toString());
			int temp=0;
			if(e.getSource()==cb1){
				st1=!st1;
				if(st1==true && st2==true) temp=Font.ITALIC|Font.BOLD;
				else if(st1==true) temp=Font.BOLD;
					else if(st2==true) temp=Font.ITALIC|Font.PLAIN;
				font=new Font(style[index],temp,14);
				text.setFont(font);
			}else if(e.getSource()==cb2){
				st2=!st2;
				if(st1==true && st2==true) temp=Font.ITALIC|Font.BOLD;
				else if(st1==true) temp=Font.BOLD;
					else if(st2==true) temp=Font.ITALIC|Font.PLAIN;
				font=new Font(style[index],temp,14);
				text.setFont(font);
				}
			sign=temp;text.repaint();
		}
	}
	class RadioListener implements ItemListener{
		public void itemStateChanged(ItemEvent e){
			text1.setText(e.getItem().toString());
			if(e.getSource()==jb1) index=0;
			if(e.getSource()==jb2) index=1;
			if(e.getSource()==jb3) index=2;
			if(e.getSource()==jb4) index=3;
			if(e.getSource()==jb5) index=4;
			font=new Font(style[index],sign,14);
			text.setFont(font);
			text.repaint();
		}
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex14{
	public static void main(String args[]) {
		RadioCheckBoxButton win=new RadioCheckBoxButton();
		win.setVisible(true);
	}
}