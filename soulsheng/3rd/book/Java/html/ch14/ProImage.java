//ProImage.java;
import java.awt.Window.*;
import java.awt.image.*;
import java.awt.event.*;
import java.awt.*;
import javax.swing.*;

class ProImage extends JFrame implements MouseListener{
  private JButton clip=new JButton("Image Clip");
  private JPanel p=new JPanel();
  Image img;
  Image cpyImg;
  
  int x,y,w,h,c;//ͼƬ�йص�λ����Ϣ
  public ProImage()  {
   setTitle("ͼƬ������ʾ");
   setBounds(0,0,250,250);
//�趨���ڲ��ֲ�������
   getContentPane().setLayout(new BorderLayout());
   getContentPane().add(BorderLayout.NORTH,p);
   p.add(clip);
  
//����ͼ��
   img=getToolkit().getImage("tree.jpg");
   cpyImg=img;

//�趨�������¼�����   
   clip.addMouseListener(this);
    p.addMouseListener(this);
    addMouseListener(this);
 //�趨���ڼ���,ʹ���ڿ�ִ���˳�����     
    addWindowListener(new WindowAdapter() {
      public void windowClosing(WindowEvent evt) {
        System.exit(0);
      }
    });	
  
 }

public void paint(Graphics g){
	super.paint(g);
	//���ͼ��ĳߴ�
    int w=cpyImg.getWidth(this);
    int h=cpyImg.getHeight(this);
 //����ͼ��ĳߴ磬ʹ��ʹ��ڳߴ���ƥ��
    Dimension d=getSize();
    if(w>d.width)w=d.width;
    if(h>d.height)h=d.height;
    //��ʾͼ��
    g.drawImage(cpyImg,0,60,w,h-60,this);//(d.width-2)/2,(d.height -h)/2, this);
}
 
//�趨�����굥���¼�����   
 public void mousePressed(MouseEvent evt) {
//ʵ��ͼ����а�ť�Ĺ���
 if(evt.getSource()==clip){
 	Graphics g=this.getGraphics();
     cpyImg=proc();
        repaint();
     }
}
 //��������¼� 
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mouseClicked(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
//�����µ�ͼ����ԭʼͼ��Ĵ�С��һ�룩
Image proc(){
        ImageFilter fil=new CropImageFilter(this.x,this.y,this.getWidth()/2, this.getHeight());
        ImageProducer prod=new FilteredImageSource(img.getSource(),fil);
        return this.createImage(prod);
    }
//���ɴ��������ʾ
 public static void main(String[] args){
      ProImage pimg=new ProImage();
     
      pimg.show();
    }

}

