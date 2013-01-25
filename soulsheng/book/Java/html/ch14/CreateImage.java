//CreateImage.java
import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import java.awt.image.*;
import javax.swing.*;
public class CreateImage extends JFrame {
  Image img;
  public CreateImage(){
  setTitle("创建图象");
  //设置窗口起始大小  	
   setBounds(0,0,200,200);
   //获得窗口的宽和高
   int w=this.getWidth();
    int h=this.getHeight();
    //产生与窗口大小相同的像素点
    int pix[]=new int[w*h];
    int idx=0;
    //对不同像素点产生不同颜色
    for(int y=0;y<h;y++)
      for(int x=0;x<w;x++){
        int read=(x^y)&0xff;
        int green=(x*2^y*4)&0xff;
        int blue=(x*4^y*4)&0xff;
        pix[idx++]=(255<<24)|(read<<16)|(green<<8)|blue;
      }
     //创建图象
    img=createImage(new MemoryImageSource(w,h,pix,0,w));
    //窗口事件监听，使退出按钮可用
      addWindowListener(new WindowAdapter()
    {
        public void windowClosing(WindowEvent evt)
        {
           System.exit(0);
        }});
  
    }
   public void paint(Graphics g){
   	//显示所创建的图象
   	g.drawImage(img,0,0,this);
    }
   public static void main(String[] args){
   	//创建新窗口，并显示
   	CreateImage cimg=new CreateImage();
   	cimg.show();}
}
