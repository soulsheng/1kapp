//DemoFontMerics.java
import java.awt.*;
import java.awt.event.*;
import javax.swing.*;

public class DemoFontMetrics extends JFrame{
public DemoFontMetrics(){

this.setTitle("������ʾ��ʾ");
//�趨���ڳ�ʼ��С
setBounds(0,0,200,200);
//�˳����ڹ���
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
    FontMetrics fm = g.getFontMetrics();//��ȡ��ģ

    w = getSize().width;//��ȡ������
    h=getSize().height;//��ȡ����߶�
    
    x=(w-fm.stringWidth(inf))/2;//�����ַ���������ʼ�������
    y=h/2+(fm.getAscent()-fm.getDescent())/2;//�����ַ���������ʼ��������
    
    g.drawString(inf,x,y);//��ʾ�ַ���

  }
  public static void main(String[] args){
    DemoFontMetrics dfm=new DemoFontMetrics();
    dfm.show();
  }
  }

