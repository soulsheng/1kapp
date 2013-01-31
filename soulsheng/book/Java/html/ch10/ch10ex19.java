import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import javax.swing.event.*;
import javax.swing.Timer.*;
class HelpAboutDialog extends JFrame{
	private JDialog helpAbout;
	private JButton okButton,frameButton;;
	private Container contentPanel;
	private JFrame frame;
	private Timer myTimer;
	private int Counter=0;
	public HelpAboutDialog(){
		super("JDialog示范");
		setSize(400,300);
		contentPanel=getContentPane();
		contentPanel.setLayout(new BorderLayout());
		Font ft=new Font("宋体",Font.BOLD,30);
		frameButton=new JButton("测试系统");
		frameButton.setFont(ft);
		contentPanel.add(frameButton,BorderLayout.CENTER); 
		frameButton.addActionListener(new CalButton());
		addWindowListener(new WindowDestroyer());
		
		Font ft1=new Font("宋体",Font.PLAIN,14);
		frame=new JFrame("对话框");
		helpAbout=new JDialog(frame,"parent container",true);
		Container dialogcp=helpAbout.getContentPane();
		dialogcp.setLayout(new BorderLayout());
		
		JLabel imageLabel=new JLabel(new ImageIcon("javalogo.gif"));
		dialogcp.add(imageLabel,BorderLayout.WEST);
				
		JPanel authorInfoPane=new JPanel();
		authorInfoPane.setLayout(new GridLayout(1,1));
		JTextArea aboutContent=new JTextArea("高等教育出版社,2005年5月,丁岳伟、彭登陆编著");
		aboutContent.setFont(ft1);
		authorInfoPane.add(aboutContent);
		dialogcp.add(authorInfoPane,BorderLayout.NORTH);
		
		JPanel OKPane=new JPanel();
		okButton=new JButton("确定",new ImageIcon("animal.gif"));
		okButton.setFont(ft1);
		ImageIcon rollover = new ImageIcon("tom.gif");
		ImageIcon general = new ImageIcon("animal.gif");
		ImageIcon press = new ImageIcon("cat.gif");
		okButton.setRolloverEnabled(true);
		okButton.setIcon(general); 
		okButton.setRolloverIcon(rollover); 
		okButton.setPressedIcon(press);
		okButton.addActionListener(new TimerAction());
		OKPane.add(okButton);
		dialogcp.add(OKPane,BorderLayout.SOUTH);
		
		JPanel sysInfoPane=new JPanel();
		sysInfoPane.setLayout(new GridLayout(5,1));
		sysInfoPane.setBorder(BorderFactory.createLoweredBevelBorder());
		sysInfoPane.setBackground(Color.white);
		JLabel userName=new JLabel("用户名："+System.getProperty("user.name"));
		JLabel osName=new JLabel("操作系统："+System.getProperty("os.name"));
		JLabel javaVersion=new JLabel("安装的Java SDK的版本号："+System.getProperty("java.version"));
		JLabel totalMemory=new JLabel("Java虚拟机可能使用的总内存数："+Runtime.getRuntime().totalMemory()+"字节数" );
		JLabel freeMemory=new JLabel("Java虚拟机所剩余的内存数"+Runtime.getRuntime().freeMemory()+"字节数" ); 
		userName.setFont(ft1);
		osName.setFont(ft1);
		javaVersion.setFont(ft1);
		totalMemory.setFont(ft1);
		freeMemory.setFont(ft1);
		sysInfoPane.add(userName);
		sysInfoPane.add(osName);
		sysInfoPane.add(javaVersion);
		sysInfoPane.add(totalMemory);
		sysInfoPane.add(freeMemory);
		dialogcp.add(sysInfoPane,BorderLayout.CENTER);
		
		myTimer=new Timer(1000,new TimerAction());
		myTimer.start();
		addWindowListener(new WindowDestroyer());
	}
	class TimerAction implements ActionListener{
		public void actionPerformed(ActionEvent e){
			if(e.getSource()==okButton)
				helpAbout.dispose();
			else if(e.getSource()==myTimer){
				Counter++;
				helpAbout.setTitle("当前的定时器的值为:"+Counter+"秒");
			}
		}
	}
	class CalButton implements ActionListener{
		public void actionPerformed(ActionEvent e){
			helpAbout.setSize(400,300);
			helpAbout.setLocation(100,100);
			helpAbout.setVisible(true);
		}
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex19{
	public static void main(String args[]) {
		HelpAboutDialog win=new HelpAboutDialog();
		win.setVisible(true);
	}
}