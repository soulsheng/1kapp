import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class ToolBar extends JFrame{
	private JToolBar tb=new JToolBar();
	public ToolBar(){
		super("������ʾ��");
		setSize(380,300);
		Container cp=getContentPane();
		JComboBox font=new JComboBox();
		JComboBox fontSize=new JComboBox();
		JButton copyButton=new JButton(new ImageIcon("copy.gif"));
		JButton removeButton=new JButton(new ImageIcon("remove.gif"));
		JButton printerButton=new JButton(new ImageIcon("printer.gif"));
		JButton prevButton=new JButton(new ImageIcon("prev.gif"));
		JButton nextButton=new JButton(new ImageIcon("next.gif"));
		JButton searchButton=new JButton(new ImageIcon("search.gif"));
		font.addItem("����");
		font.addItem("����");
		font.addItem("����");
		font.addItem("Arial");
		font.addItem("Times");
		font.addItem("Courier");
		fontSize.addItem("һ��");
		fontSize.addItem("����");
		fontSize.addItem("����");
		fontSize.addItem("�ĺ�");
		fontSize.addItem("���");
		fontSize.addItem("����");
		tb.add(copyButton);
		tb.add(removeButton);
		tb.addSeparator();
		tb.add(printerButton);
		tb.addSeparator();
		tb.add(prevButton);
		tb.add(nextButton);
		tb.add(searchButton);
		tb.addSeparator();
		tb.add(font);
		tb.add(fontSize);
		cp.setLayout(new BorderLayout());
		cp.add(tb,BorderLayout.NORTH);
		addWindowListener(new WindowDestroyer());
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex23{
	public static void main(String args[]) {
		ToolBar win=new ToolBar();
		win.setVisible(true);
	}
}