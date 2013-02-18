import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;
import java.io.*;
class ComboBox extends JFrame {
  	private DefaultComboBoxModel model=new DefaultComboBoxModel();
  	private DefaultListModel model1=new DefaultListModel();
  	private JButton btAdd,btRemove,btClear,btCopy;
  	private JComboBox jc1;
  	private JList li1;
  	private JTextField title;
  	private Container cp;
  	private int index=-1;
  	public ComboBox() {
  		init(model);
    	setTitle("��Ͽ��б�����ʾ������");
    	setSize(280,300);
    	cp=getContentPane();
    	cp.setLayout(new FlowLayout());
    	jc1=new JComboBox(model);
    	li1=new JList(model1);
    	li1.setVisibleRowCount(8);
    	li1.setFixedCellWidth(80);
    	JScrollPane pane1=new JScrollPane(jc1);
    	JScrollPane pane2=new JScrollPane(li1);
    	title=new JTextField(15);
    	btAdd=new JButton("����ѡ����");
      	btRemove=new JButton("ɾ��ѡ����");
    	btClear=new JButton("���������");
    	btCopy=new JButton("����");
  	    btAdd.addActionListener(new ModifiedListener());
		btRemove.addActionListener(new ModifiedListener());
	    btClear.addActionListener(new ModifiedListener());
       	btCopy.addActionListener(new ModifiedListener());
       	jc1.addActionListener(new ComboBoxSelection());
		cp.add(title);cp.add(btAdd);cp.add(btRemove);
		cp.add(btClear);cp.add(pane1);cp.add(btCopy);cp.add(pane2);
		addWindowListener(new WindowDestroyer());
	}
	private static void init(DefaultComboBoxModel dlm){
		String str="";
		try{
			File f1=new File("selecteditem.txt");
			FileReader fr=new FileReader(f1);
			BufferedReader fIn=new BufferedReader(fr);
			str=fIn.readLine();
			while(str!=null){
				dlm.addElement(str);
				str=fIn.readLine();
			}
			fIn.close();
		}catch(IOException e){
			System.out.println(e.getMessage());
		}
	}
	class ComboBoxSelection implements ActionListener{
		public void actionPerformed(ActionEvent evt){
        	index=jc1.getSelectedIndex();
    	}
    }
	class ModifiedListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			if(e.getActionCommand()=="����ѡ����"){
				if(title.getText().length()>0){
					model.addElement(title.getText());
					title.setText("");
				}
			}
			if(e.getActionCommand()=="ɾ��ѡ����"){
				if(index>=0){
					model.removeElementAt(index);
				}
			}
			if(e.getActionCommand()=="���������")
				model.removeAllElements();
			if(e.getActionCommand()=="����" && index>=0)
				model1.addElement(model.getElementAt(index));
		}
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex17{
    public static void main(String[] args) {
        ComboBox win = new ComboBox();
       	win.setVisible(true);;
   }
}