import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
class PopupMenu extends JFrame{
	private JPopupMenu popup=new JPopupMenu();
	public PopupMenu(){
		super("一个弹出式菜单");
		setSize(400,300);
		Container cp=getContentPane();
		
		JMenuItem mEdit1=new JMenuItem("剪切");
		JMenuItem mEdit2=new JMenuItem("复制");
		JMenuItem mEdit3=new JMenuItem("粘帖");
		
		popup.add(mEdit1);
		popup.add(mEdit2);
		popup.add(mEdit3);
		
		addWindowListener(new WindowDestroyer());

		cp.addMouseListener(new MouseAdapter(){
			public void mousePressed(MouseEvent e){
				showPopup(e);
			}
			public void mouseClicked(MouseEvent e){
				showPopup(e);
			}
			public void mouseReleased(MouseEvent e){
				showPopup(e);
			}
		});
	}
	private void showPopup(MouseEvent e){
		if(e.isPopupTrigger())
			popup.show(this,e.getX(),e.getY());
	}
}

class WindowDestroyer extends WindowAdapter{
	public void windowClosing(WindowEvent e){
		System.exit(0);
	}
}
public class ch10ex22{
	public static void main(String args[]) {
		PopupMenu win=new PopupMenu();
		win.setVisible(true);
	}
}