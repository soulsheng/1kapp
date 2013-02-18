//ShowImage.java
import java.awt.*;
import javax.swing.*;

import java.awt.image.*;
import java.awt.event.*;

class ShowImage extends JFrame implements MouseListener{
//����������ť,һ��ִ��ͼ������빦��,��һ��ִ��ͼ�����ʾ����
  private JButton loadimg = new JButton("Load Image");
  private JButton showimg = new JButton("Show Image");

//����һ��Panel��������������ť
  private JPanel p=new JPanel();
//����һ��image����
  private Image img = null;
 


  public ShowImage() {
 //�趨���ڱ���ʹ�С
    setTitle("ͼƬ��ʾ��ʾ");
    setBounds(0,0,250,250);
 //�趨���ڲ��ֲ�������
    getContentPane().setLayout(new BorderLayout());
    getContentPane().add(BorderLayout.NORTH,p);
    
    p.setLayout(new FlowLayout(FlowLayout.LEFT,1,2));
    p.add(loadimg);
    p.add(showimg);
 //�趨�������¼�����   
    loadimg.addMouseListener(this);
    showimg.addMouseListener(this);
    
    p.addMouseListener(this);
    addMouseListener(this);
 //�趨���ڼ���,ʹ���ڿ�ִ���˳�����     
    addWindowListener(new WindowAdapter() {
      public void windowClosing(WindowEvent evt) {
        System.exit(0);
      }
    });
  
  }
  
 //�趨�����굥���¼�����   
 public void mousePressed(MouseEvent evt) {{
 //loadimg��ťװ��ͼƬ
 if (evt.getSource()== loadimg) {
       img = getToolkit().getImage("friendly.jpg");
          
  }
 //showimg��ť��ʾͼƬ
 if (evt.getSource() == showimg) {
	  getGraphics().drawImage(img, 70, 70,this);
      
}
   
  }}
  
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mouseClicked(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
  
  public static void main(String[] args){
 //����ͼ����ʾ���ڲ���ʾ
    ShowImage simg=new ShowImage();
    simg.show();
  }

}
