import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;
class List1 extends JFrame {
  	private DefaultListModel model=new DefaultListModel();
  	private DefaultListModel model1=new DefaultListModel();
  	private JButton btAdd,btRemove,btClear,btCopy;
  	private JList li1,li2;
  	private JTextField title;
  	private Container cp;
  	private int index=-1;
  	public List1() {
  		init(model);
    	setTitle("�б��Ĳ���ʾ������");
    	setSize(300,300);
    	cp=getContentPane();
    	cp.setLayout(new FlowLayout());
    	li1=new JList(model);
    	li1.setVisibleRowCount(8);
    	li1.setFixedCellWidth(100);
		li1.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
    	li2=new JList(model1);
    	li2.setVisibleRowCount(8);
    	li2.setFixedCellWidth(100);
    	JScrollPane pane1=new JScrollPane(li1);
    	JScrollPane pane2=new JScrollPane(li2);
    	title=new JTextField(15);
    	btAdd=new JButton("����ѡ����");
      	btRemove=new JButton("ɾ��ѡ����");
    	btClear=new JButton("���������");
    	btCopy=new JButton("����");
  	    btAdd.addActionListener(new ModifiedListener());
		btRemove.addActionListener(new ModifiedListener());
	    btClear.addActionListener(new ModifiedListener());
       	btCopy.addActionListener(new ModifiedListener());
       	li1.addListSelectionListener(new ListSelection());
		cp.add(title);cp.add(btAdd);cp.add(btRemove);
		cp.add(btClear);cp.add(pane1);cp.add(btCopy);cp.add(pane2);
		addWindowListener(new WindowDestroyer());
	}
	private static void init(DefaultListModel dlm){
		String[] array ={"�й�","����","����˹","Ӣ��","����","�¹�","�ձ�","���ô�"};
		for (int j=0;j<array.length;j++)
			dlm.addElement(array[j]);
	}
	class ListSelection implements ListSelectionListener{
		public void valueChanged(ListSelectionEvent evt){
        	index=li1.getSelectedIndex();
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
				if(model.size()>0 && index>=0){
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
public class ch10ex16{
    public static void main(String[] args) {
        List1 win = new List1();
       	win.setVisible(true);;
   }
}

