import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import javax.swing.event.*;
class List extends JFrame{
	private JList images;
	private JTextField show;
	private JLabel label;
	private String names[]={"ͼƬ1.gif","ͼƬ2.gif","ͼƬ3.gif","ͼƬ4.gif","ͼƬ5.gif","ͼƬ6.gif","ͼƬ7.gif","ͼƬ8.gif"};
	private ImageIcon icon[]={new ImageIcon(names[0]),new ImageIcon(names[1]),new ImageIcon(names[2]),new ImageIcon(names[3]),new ImageIcon(names[4]),new ImageIcon(names[5]),new ImageIcon(names[6]),new ImageIcon(names[7])};
	public List(){
		setTitle("�б�����ʾͼƬ�ļ�");
		setSize(200,300);
		Container cp=getContentPane();
		cp.setLayout(new BorderLayout());
		images=new JList(names);
		show=new JTextField(10);
		images.setVisibleRowCount(4);
		images.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
		JPanel jp1=new JPanel();
		jp1.setLayout(new GridLayout(0,2));
		jp1.add(new JScrollPane(images));
		cp.add(jp1,BorderLayout.NORTH);
		label=new JLabel(icon[0]);
		cp.add(label,BorderLayout.CENTER);
		cp.add(show,BorderLayout.SOUTH);
		images.addListSelectionListener(new ImageSelection());
		addWindowListener(new WindowDestroyer());
	}
	class ImageSelection implements ListSelectionListener{
		public void valueChanged(ListSelectionEvent evt){
        	Object value=images.getSelectedValue();
        	show.setText(value.toString());
        	label.setIcon(icon[images.getSelectedIndex()]);
    	}
    }
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex15{
	public static void main(String args[]) {
		List win=new List();
		win.setVisible(true);
	}
}