import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.io.*;
class SimpleMenu1 extends JFrame{
	private JTextArea editText;
	File fOpen=null;
	String clipBoard="";
	public SimpleMenu1(){
		super("һ���򵥵��ı�������");
		setSize(510,428);
		Container cp=getContentPane();
		cp.setLayout(new FlowLayout());
		JMenuBar mb=new JMenuBar();
		setJMenuBar(mb);
		editText=new JTextArea(20,45);
		editText.setTabSize(2);
		editText.setEditable(true);
		
		JScrollPane scroll=new JScrollPane(editText);
		scroll.setAutoscrolls(true);
		cp.add(scroll);
		
		JMenu fileMenu=new JMenu("�ļ�");
		JMenu editMenu=new JMenu("�༭");
		JMenu helpMenu=new JMenu("����");
		mb.add(fileMenu);
		mb.add(editMenu);
		mb.add(helpMenu);
		
		JMenuItem mFile1=new JMenuItem("��");
		JMenuItem mFile2=new JMenuItem("����");
		JMenuItem mFile3=new JMenuItem("���Ϊ");
		JMenuItem mFile4=new JMenuItem("�˳�");
		
		JMenuItem mEdit1=new JMenuItem("����");
		JMenuItem mEdit2=new JMenuItem("����");
		JMenuItem mEdit3=new JMenuItem("ճ��");
		JMenu mEdit4=new JMenu("��ɫ");
		
		JMenuItem mColor1=new JMenuItem("��ɫ");
		JMenuItem mColor2=new JMenuItem("��ɫ");
		JMenuItem mColor3=new JMenuItem("��ɫ");
		JMenuItem mColor4=new JMenuItem("��ɫ");
		
		mEdit4.add(mColor1);
		mEdit4.add(mColor2);
		mEdit4.add(mColor3);
		mEdit4.add(mColor4);

		KeyStroke ks=KeyStroke.getKeyStroke(KeyEvent.VK_X,Event.ALT_MASK);
		mFile4.setAccelerator(ks);
		
		fileMenu.add(mFile1);
		fileMenu.add(mFile2);
		fileMenu.add(mFile3);
		fileMenu.add(mFile4);
		
		editMenu.add(mEdit1);
		editMenu.add(mEdit2);
		editMenu.add(mEdit3);
		editMenu.add(mEdit4);
		
		mColor1.addActionListener(new ColorListener());
		mColor2.addActionListener(new ColorListener());
		mColor3.addActionListener(new ColorListener());
		mColor4.addActionListener(new ColorListener());
		
		mFile1.addActionListener(new OpenListener());
		mFile2.addActionListener(new SaveListener());
		mFile3.addActionListener(new SaveAsListener());
		mFile4.addActionListener(new ExitListener());
		
		mEdit1.addActionListener(new CutListener());
		mEdit2.addActionListener(new CopyListener());
		mEdit3.addActionListener(new PasteListener());
		addWindowListener(new WindowDestroyer());
	}
	class OpenListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			JFileChooser fileSelection=new JFileChooser();
			int res=fileSelection.showOpenDialog(null);
			if(res==JFileChooser.CANCEL_OPTION)
				return;
			else{
				try{
					fOpen=fileSelection.getSelectedFile();
					FileReader fr=new FileReader(fOpen);
					BufferedReader in=new BufferedReader(fr);
					String str;
					editText.setText("");
					str=in.readLine();
					while(str!=null){
						editText.append(str+"\n");
						str=in.readLine();
					}
					in.close();
				}catch(IOException event1){
					event1.printStackTrace();
				}
			}				
		}
	}
	class SaveAsListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			JFileChooser fileSelection=new JFileChooser();
			int res=fileSelection.showSaveDialog(null);
			if(res==JFileChooser.CANCEL_OPTION)
				return;
			else{
				try{
					File fSaveAs=fileSelection.getSelectedFile();
					FileWriter fw=new FileWriter(fSaveAs);
					PrintWriter out=new PrintWriter(fw);
					editText.selectAll();
					String str=editText.getSelectedText();
					out.print(str);
					fOpen=fSaveAs;
					out.close();
				}catch(Exception event2){
					event2.printStackTrace();
				}
			}
		}
	}
	class SaveListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			if(fOpen!=null){
				try{
					FileWriter fw=new FileWriter(fOpen);
					PrintWriter out=new PrintWriter(fw);
					editText.selectAll();
					String str=editText.getSelectedText();
					out.print(str);
					out.close();
				}catch(Exception event3){
					event3.printStackTrace();
				}
			}
		}	
	}
	class ExitListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			System.exit(0);
		}
	}
	class CutListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			int st=editText.getSelectionStart();
			int end=editText.getSelectionEnd();
			editText.replaceRange("",st,end);
		}
	}
	class CopyListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			clipBoard=editText.getSelectedText();
		}
	}
	class PasteListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			int pos=editText.getSelectionStart();
			editText.insert(clipBoard,pos);
		}
	}
	class ColorListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			if(e.getActionCommand()=="��ɫ")
				editText.setBackground(Color.red);
			if(e.getActionCommand()=="��ɫ")
				editText.setBackground(Color.black);
			if(e.getActionCommand()=="��ɫ")
				editText.setBackground(Color.green);
			if(e.getActionCommand()=="��ɫ")
				editText.setBackground(Color.blue);
		}
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex21{
	public static void main(String args[]) {
		SimpleMenu1 win=new SimpleMenu1();
		win.setVisible(true);
	}
}