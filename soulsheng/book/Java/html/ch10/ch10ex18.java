import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import javax.swing.event.*;
class JoptionPaneExample extends JFrame {
  	private JButton b1,b2,b3,b4,b5,b6,b7,b8,b9,b10,b11;
  	private Container cp;
	private int index;
  	public JoptionPaneExample() {
    	super();setTitle("JOptionPane对话框示例程序");
    	setSize(300,300);
    	cp=getContentPane();
    	cp.setLayout(new GridLayout(6,2,5,5));
		Font ft=new Font("宋体",Font.BOLD,14);
    	b1=new JButton("示范一");b1.setFont(ft);
    	b2=new JButton("示范二");b2.setFont(ft);
    	b3=new JButton("示范三");b3.setFont(ft);
    	b4=new JButton("示范四");b4.setFont(ft);
    	b5=new JButton("示范五");b5.setFont(ft);
    	b6=new JButton("示范六");b6.setFont(ft);
    	b7=new JButton("示范七");b7.setFont(ft);
    	b8=new JButton("示范八");b8.setFont(ft);
    	b9=new JButton("示范九");b9.setFont(ft);
    	b10=new JButton("示范十");b10.setFont(ft);
    	b11=new JButton("示范十一");b11.setFont(ft);
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
			if(e.getSource()==b1)//如果使用最简单形式JOptionPane.showMessageDialog(cp,"按钮一（显示信息内容）"），则显示的INFORMATION_MESSAGE对话框
				JOptionPane.showMessageDialog(cp,"按钮一（显示信息内容）","INFORMATION MESSAGE",JOptionPane.INFORMATION_MESSAGE);
			if(e.getSource()==b2)
				JOptionPane.showMessageDialog(cp,"按钮二（显示出错信息）","ERROR MESSAGE",JOptionPane.ERROR_MESSAGE);
			if(e.getSource()==b3)
				JOptionPane.showMessageDialog(cp,"按钮三","WARNING MESSAGE（显示警告信息）",JOptionPane.WARNING_MESSAGE);
			if(e.getSource()==b4)
				JOptionPane.showMessageDialog(cp,"按钮四","QUESTION MESSAGE（信息提问信息",JOptionPane.QUESTION_MESSAGE);
			if(e.getSource()==b5){//用指定图标替换缺省图标(PLAIN_MESSAGE本来不显示图标)
				ImageIcon icon=new ImageIcon("图片1.gif");
				JOptionPane.showMessageDialog(cp,"按钮五","PLAIN MESSAGE（信息一般信息）",JOptionPane.PLAIN_MESSAGE,icon);
			}
			if(e.getSource()==b6){
				String str="";//输入对话框要求输入内容并确定，如果按取消按钮返回null，反之返回输入内容
				str=JOptionPane.showInputDialog("按钮六（输入内容）"/*,"INFORMATION MESSAGE",JOptionPane.INFORMATION_MESSAGE*/);
				System.out.println(str);
			}
			if(e.getSource()==b7){
				String opt[]={"中国","美国","爱尔兰","俄罗斯","英国","法国"};
				String str1="";
				ImageIcon icon1=new ImageIcon("图片2.gif");
				str1=(String)JOptionPane.showInputDialog(cp,"按钮七（利用列表框选择）","QUESTION MESSAGE",JOptionPane.QUESTION_MESSAGE,icon1,opt,opt[0]);
				System.out.println(str1);
			}
			if(e.getSource()==b8){
				int answer;
				answer=JOptionPane.showConfirmDialog(cp,"按钮八:询问?","对话框标题",JOptionPane.YES_NO_CANCEL_OPTION,JOptionPane.QUESTION_MESSAGE);
				System.out.println("回答是: "+answer+" YES/OK=0;NO=1;CANCEL=2;CLOSED=-1(直接关闭对话框)");
			}
			if(e.getSource()==b9){
				ImageIcon icon2=new ImageIcon("图片3.gif");
				JOptionPane.showConfirmDialog(cp,"按钮九:询问?","对话框标题",JOptionPane.YES_NO_CANCEL_OPTION,JOptionPane.QUESTION_MESSAGE,icon2);
			}
			if(e.getSource()==b10){//自己定义选择
				String opt1[]={"确定","应用","取消","上一步","下一步"};
				int answer1;
				answer1=JOptionPane.showOptionDialog(cp,"按钮十:询问?","对话框标题",JOptionPane.PLAIN_MESSAGE,JOptionPane.DEFAULT_OPTION,null,opt1,opt1[0]);
				System.out.println("回答是: "+answer1+"按照顺序依次返回0、1、2、3、4；CLOSED=-1(直接关闭对话框)");
			}
			if(e.getSource()==b11){//自己定义选择、定义选择按钮组件
				String opt2[]={"确定","应用","取消"};
				int answer2;
				ExchangePanel SelectionButton=new ExchangePanel();
				answer2=JOptionPane.showOptionDialog(cp,SelectionButton,"请选择国家",JOptionPane.PLAIN_MESSAGE,JOptionPane.DEFAULT_OPTION,null,opt2,opt2[0]);
				if(answer2!=-1 && answer2!=2){
					if(index==0)
						System.out.println("选择中国");
					if(index==1)
						System.out.println("选择美国");
					if(index==2)
						System.out.println("选择法国");
					if(index==3)
						System.out.println("选择英国");
				}
			}

		}
		class ExchangePanel extends JPanel{
			private ButtonGroup btng=new ButtonGroup();
			private JRadioButton jrButton[]={new JRadioButton("中国"),new JRadioButton("美国"),new JRadioButton("法国"),new JRadioButton("英国")};
			public ExchangePanel(){
				setBorder(BorderFactory.createTitledBorder("选择国家"));
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