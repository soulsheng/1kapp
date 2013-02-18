//DemoFontMerics.java
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

public class DemoFontMetrics extends JFrame{
public DemoFontMetrics(){

this.setTitle("文字显示演示");
//设定窗口初始大小
setBounds(0,0,200,200);
//退出窗口功能
addWindowListener(new WindowAdapter()
 {
 public void windowClosing(WindowEvent evt)
 {
      System.exit(0);
     }});
  }
  
public void paint(Graphics g){

    int w, h;
    int x, y;
    String inf= "This is the Center";
    FontMetrics fm = g.getFontMetrics();//获取字模

    w = getSize().width;//获取窗体宽度
    h=getSize().height;//获取窗体高度
    
    x=(w-fm.stringWidth(inf))/2;//设置字符串基线起始点横坐标
    y=h/2+(fm.getAscent()-fm.getDescent())/2;//设置字符串基线起始点纵坐标
    
    g.drawString(inf,x,y);//显示字符串

  }
  public static void main(String[] args){
    DemoFontMetrics dfm=new DemoFontMetrics();
    dfm.show();
  }
  }

