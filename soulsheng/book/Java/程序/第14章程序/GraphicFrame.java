//GraphicFrame.java
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

public class GraphicFrame extends JFrame {
private JPanel p1=new JPanel();
private JPanel p2=new JPanel();
private JPanel p3=new JPanel();
private JPanel p4=new JPanel();
private JPanel p5=new JPanel();
private JPanel p6=new JPanel();
private JPanel p7=new JPanel();
private JPanel p8=new JPanel();

public GraphicFrame() {
	
   setTitle("Java图形演示");
   setBounds(0,0,400,400);
   getContentPane().setLayout(new GridLayout(2,4));
   getContentPane().add(p1);
   getContentPane().add(p2);
   getContentPane().add(p3);
   getContentPane().add(p4);
   getContentPane().add(p5);
   getContentPane().add(p6);
   getContentPane().add(p7);
   getContentPane().add(p8);

  //以下代码退出窗口的退出钮功能
  addWindowListener(new WindowAdapter()
  {
    public void windowClosing(WindowEvent evt)
    {
      System.exit(0);
    }});

   }

public void draw( ){
Graphics g;
Color c;

//画直线
g=p1.getGraphics();
g.drawLine(0,p1.getHeight()/4,p1.getWidth(),p1.getHeight()/4);
//画弧线
c=new Color(255,0,0);
g.setColor(c);
g=p2.getGraphics();
g.drawArc(0, 0,80,80,0,360);
//画多边形
g=p3.getGraphics();
c=new Color(0,255,0);
g.setColor(c);
int x[]={0,p3.getWidth()/3,p3.getWidth(),p2.getWidth()/3};
int y[]={p3.getHeight()/3,0,p3.getHeight()/3,p3.getHeight()/2};
g.drawPolygon(x,y,4);

//画充填椭圆
g=p4.getGraphics();
c=new Color(0,0,255);
g.setColor(c);
g.fillOval(0,0,p4.getWidth(),p4.getHeight()/3);

//画充填矩形
g=p5.getGraphics();
c=new Color(255,0,255);
g.setColor(c);
g.fillRect(0,0,p5.getWidth()/2,p5.getHeight()/2);
//画充填圆形
g=p6.getGraphics();
c=new Color(255,155,0);
g.setColor(c);
g.fillOval(0,0,p6.getWidth()/2,p6.getHeight()/2);
//画充填弧形
g=p7.getGraphics();
c=new Color(0,255,255);
g.setColor(c);
g.fillArc(0,0,p7.getWidth()/2,p7.getHeight()/2,0,180);
//画三维充填矩形
g=p8.getGraphics();
c=new Color(100,90,255);
g.setColor(c);
g.fill3DRect(0,0,p8.getWidth()/2,p8.getHeight()/2,true);

   }

public static void main(String[] args){

    GraphicFrame gf=new GraphicFrame();
    gf.show();
    gf.draw();

  }


}
