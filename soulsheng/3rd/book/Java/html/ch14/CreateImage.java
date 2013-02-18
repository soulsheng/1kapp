//CreateImage.java
import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import java.awt.image.*;
import javax.swing.*;
public class CreateImage extends JFrame {
  Image img;
  public CreateImage(){
  setTitle("����ͼ��");
  //���ô�����ʼ��С  	
   setBounds(0,0,200,200);
   //��ô��ڵĿ�͸�
   int w=this.getWidth();
    int h=this.getHeight();
    //�����봰�ڴ�С��ͬ�����ص�
    int pix[]=new int[w*h];
    int idx=0;
    //�Բ�ͬ���ص������ͬ��ɫ
    for(int y=0;y<h;y++)
      for(int x=0;x<w;x++){
        int read=(x^y)&0xff;
        int green=(x*2^y*4)&0xff;
        int blue=(x*4^y*4)&0xff;
        pix[idx++]=(255<<24)|(read<<16)|(green<<8)|blue;
      }
     //����ͼ��
    img=createImage(new MemoryImageSource(w,h,pix,0,w));
    //�����¼�������ʹ�˳���ť����
      addWindowListener(new WindowAdapter()
    {
        public void windowClosing(WindowEvent evt)
        {
           System.exit(0);
        }});
  
    }
   public void paint(Graphics g){
   	//��ʾ��������ͼ��
   	g.drawImage(img,0,0,this);
    }
   public static void main(String[] args){
   	//�����´��ڣ�����ʾ
   	CreateImage cimg=new CreateImage();
   	cimg.show();}
}
