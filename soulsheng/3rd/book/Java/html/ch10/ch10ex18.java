import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;
class JoptionPaneExample extends JFrame {
  	private JButton b1,b2,b3,b4,b5,b6,b7,b8,b9,b10,b11;
  	private Container cp;
	private int index;
  	public JoptionPaneExample() {
    	super();setTitle("JOptionPane�Ի���ʾ������");
    	setSize(300,300);
    	cp=getContentPane();
    	cp.setLayout(new GridLayout(6,2,5,5));
		Font ft=new Font("����",Font.BOLD,14);
    	b1=new JButton("ʾ��һ");b1.setFont(ft);
    	b2=new JButton("ʾ����");b2.setFont(ft);
    	b3=new JButton("ʾ����");b3.setFont(ft);
    	b4=new JButton("ʾ����");b4.setFont(ft);
    	b5=new JButton("ʾ����");b5.setFont(ft);
    	b6=new JButton("ʾ����");b6.setFont(ft);
    	b7=new JButton("ʾ����");b7.setFont(ft);
    	b8=new JButton("ʾ����");b8.setFont(ft);
    	b9=new JButton("ʾ����");b9.setFont(ft);
    	b10=new JButton("ʾ��ʮ");b10.setFont(ft);
    	b11=new JButton("ʾ��ʮһ");b11.setFont(ft);
    	cp.add(b1);cp.add(b2);cp.add(b3);cp.add(b4);
    	cp.add(b5);cp.add(b6);cp.add(b7);cp.add(b8);
    	cp.add(b9);cp.add(b10);cp.add(b11);
  	    b1.addActionListener(new ButtonListener());
  	    b2.addActionListener(new ButtonListener());
  	    b3.addActionListener(new ButtonListener());
  	    b4.addActionListener(new ButtonListener());
  	    b5.addActionListener(new ButtonListener());
  	    b6.addActionListener(new ButtonListener());
  	    b7.addActionListener(new ButtonListener());
  	    b8.addActionListener(new ButtonListener());
  	    b9.addActionListener(new ButtonListener());
  	    b10.addActionListener(new ButtonListener());
   	    b11.addActionListener(new ButtonListener());
		addWindowListener(new WindowDestroyer());
	}
	class ButtonListener implements ActionListener{
		public void actionPerformed(ActionEvent e){
			if(e.getSource()==b1)//���ʹ�������ʽJOptionPane.showMessageDialog(cp,"��ťһ����ʾ��Ϣ���ݣ�"��������ʾ��INFORMATION_MESSAGE�Ի���
				JOptionPane.showMessageDialog(cp,"��ťһ����ʾ��Ϣ���ݣ�","INFORMATION MESSAGE",JOptionPane.INFORMATION_MESSAGE);
			if(e.getSource()==b2)
				JOptionPane.showMessageDialog(cp,"��ť������ʾ������Ϣ��","ERROR MESSAGE",JOptionPane.ERROR_MESSAGE);
			if(e.getSource()==b3)
				JOptionPane.showMessageDialog(cp,"��ť��","WARNING MESSAGE����ʾ������Ϣ��",JOptionPane.WARNING_MESSAGE);
			if(e.getSource()==b4)
				JOptionPane.showMessageDialog(cp,"��ť��","QUESTION MESSAGE����Ϣ������Ϣ",JOptionPane.QUESTION_MESSAGE);
			if(e.getSource()==b5){//��ָ��ͼ���滻ȱʡͼ��(PLAIN_MESSAGE��������ʾͼ��)
				ImageIcon icon=new ImageIcon("ͼƬ1.gif");
				JOptionPane.showMessageDialog(cp,"��ť��","PLAIN MESSAGE����Ϣһ����Ϣ��",JOptionPane.PLAIN_MESSAGE,icon);
			}
			if(e.getSource()==b6){
				String str="";//����Ի���Ҫ���������ݲ�ȷ���������ȡ����ť����null����֮������������
				str=JOptionPane.showInputDialog("��ť�����������ݣ�"/*,"INFORMATION MESSAGE",JOptionPane.INFORMATION_MESSAGE*/);
				System.out.println(str);
			}
			if(e.getSource()==b7){
				String opt[]={"�й�","����","������","����˹","Ӣ��","����"};
				String str1="";
				ImageIcon icon1=new ImageIcon("ͼƬ2.gif");
				str1=(String)JOptionPane.showInputDialog(cp,"��ť�ߣ������б��ѡ��","QUESTION MESSAGE",JOptionPane.QUESTION_MESSAGE,icon1,opt,opt[0]);
				System.out.println(str1);
			}
			if(e.getSource()==b8){
				int answer;
				answer=JOptionPane.showConfirmDialog(cp,"��ť��:ѯ��?","�Ի������",JOptionPane.YES_NO_CANCEL_OPTION,JOptionPane.QUESTION_MESSAGE);
				System.out.println("�ش���: "+answer+" YES/OK=0;NO=1;CANCEL=2;CLOSED=-1(ֱ�ӹرնԻ���)");
			}
			if(e.getSource()==b9){
				ImageIcon icon2=new ImageIcon("ͼƬ3.gif");
				JOptionPane.showConfirmDialog(cp,"��ť��:ѯ��?","�Ի������",JOptionPane.YES_NO_CANCEL_OPTION,JOptionPane.QUESTION_MESSAGE,icon2);
			}
			if(e.getSource()==b10){//�Լ�����ѡ��
				String opt1[]={"ȷ��","Ӧ��","ȡ��","��һ��","��һ��"};
				int answer1;
				answer1=JOptionPane.showOptionDialog(cp,"��ťʮ:ѯ��?","�Ի������",JOptionPane.PLAIN_MESSAGE,JOptionPane.DEFAULT_OPTION,null,opt1,opt1[0]);
				System.out.println("�ش���: "+answer1+"����˳�����η���0��1��2��3��4��CLOSED=-1(ֱ�ӹرնԻ���)");
			}
			if(e.getSource()==b11){//�Լ�����ѡ�񡢶���ѡ��ť���
				String opt2[]={"ȷ��","Ӧ��","ȡ��"};
				int answer2;
				ExchangePanel SelectionButton=new ExchangePanel();
				answer2=JOptionPane.showOptionDialog(cp,SelectionButton,"��ѡ�����",JOptionPane.PLAIN_MESSAGE,JOptionPane.DEFAULT_OPTION,null,opt2,opt2[0]);
				if(answer2!=-1 && answer2!=2){
					if(index==0)
						System.out.println("ѡ���й�");
					if(index==1)
						System.out.println("ѡ������");
					if(index==2)
						System.out.println("ѡ�񷨹�");
					if(index==3)
						System.out.println("ѡ��Ӣ��");
				}
			}

		}
		class ExchangePanel extends JPanel{
			private ButtonGroup btng=new ButtonGroup();
			private JRadioButton jrButton[]={new JRadioButton("�й�"),new JRadioButton("����"),new JRadioButton("����"),new JRadioButton("Ӣ��")};
			public ExchangePanel(){
				setBorder(BorderFactory.createTitledBorder("ѡ�����"));
				for(int j=0;j<jrButton.length;j++){
					if(j==0)
						jrButton[j].setSelected(true);
					add(jrButton[j]);
					btng.add(jrButton[j]);
					jrButton[j].addItemListener(new RadioListener());
				}
			}
			class RadioListener implements ItemListener{
				public void itemStateChanged(ItemEvent e){
					if(e.getSource()==jrButton[0]) index=0;
					if(e.getSource()==jrButton[1]) index=1;
					if(e.getSource()==jrButton[2]) index=2;
					if(e.getSource()==jrButton[3]) index=3;
				}
			}
		}
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex18{
    public static void main(String[] args) {
        JoptionPaneExample win = new JoptionPaneExample();
       	win.setVisible(true);;
   }
}