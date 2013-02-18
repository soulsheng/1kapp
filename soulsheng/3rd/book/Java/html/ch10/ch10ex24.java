import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import javax.swing.border.*;
class BorderSet extends JFrame{
	private JToolBar tb=new JToolBar();
	public BorderSet(){
		super("¸÷ÖÖ±ß¿òÊ¾·¶");
		setSize(380,300);
		Container cp=getContentPane();
		cp.setLayout(new GridLayout(4,2));
		JButton bl=new JButton("Bevel Lowered");
		bl.setBorder(new BevelBorder(BevelBorder.LOWERED));
		JButton br=new JButton("Bevel Raised");
		br.setBorder(new BevelBorder(BevelBorder.RAISED));
		JButton el=new JButton("Etched Lowered");
		el.setBorder(new EtchedBorder(BevelBorder.LOWERED,Color.black,Color.blue));
		JButton er=new JButton("Etched Raised");
		er.setBorder(new EtchedBorder(BevelBorder.RAISED,Color.green,Color.red));
		JButton em=new JButton("Empty Border");
		em.setBorder(new EmptyBorder(2,2,2,2));
		JButton lb=new JButton("Line Border");
		lb.setBorder(new LineBorder(Color.pink,8));
		JButton mbc=new JButton("Matte Border With Color");
		mbc.setBorder(new MatteBorder(2,2,2,2,Color.white));
		JButton mbi=new JButton("Matte Border With Icon");
		mbi.setBorder(new MatteBorder(2,2,2,2,new ImageIcon("next.gif")));
		
		cp.add(bl);
		cp.add(br);
		cp.add(el);
		cp.add(er);
		cp.add(em);
		cp.add(lb);
		cp.add(mbc);
		cp.add(mbi);
		
		addWindowListener(new WindowDestroyer());
	}
}
class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex24{
	public static void main(String args[]) {
		BorderSet win=new BorderSet();
		win.setVisible(true);
	}
}