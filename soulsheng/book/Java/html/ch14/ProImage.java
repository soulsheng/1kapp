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
  
  int x,y,w,h,c;//图片有关的位置信息
  public ProImage()  {
   setTitle("图片生成演示");
   setBounds(0,0,250,250);
//设定窗口布局并添加组件
   getContentPane().setLayout(new BorderLayout());
   getContentPane().add(BorderLayout.NORTH,p);
   p.add(clip);
  
//载入图象
   img=getToolkit().getImage("tree.jpg");
   cpyImg=img;

//设定组件鼠标事件监听   
   clip.addMouseListener(this);
    p.addMouseListener(this);
    addMouseListener(this);
 //设定窗口监听,使窗口可执行退出功能     
    addWindowListener(new WindowAdapter() {
      public void windowClosing(WindowEvent evt) {
        System.exit(0);
      }
    });	
  
 }

public void paint(Graphics g){
	super.paint(g);
	//获得图象的尺寸
    int w=cpyImg.getWidth(this);
    int h=cpyImg.getHeight(this);
 //设置图象的尺寸，使其和窗口尺寸相匹配
    Dimension d=getSize();
    if(w>d.width)w=d.width;
    if(h>d.height)h=d.height;
    //显示图象
    g.drawImage(cpyImg,0,60,w,h-60,this);//(d.width-2)/2,(d.height -h)/2, this);
}
 
//设定组件鼠标单击事件监听   
 public void mousePressed(MouseEvent evt) {
//实现图象剪切按钮的功能
 if(evt.getSource()==clip){
 	Graphics g=this.getGraphics();
     cpyImg=proc();
        repaint();
     }
}
 //其它鼠标事件 
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mouseClicked(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
//生成新的图象（是原始图象的大小的一半）
Image proc(){
        ImageFilter fil=new CropImageFilter(this.x,this.y,this.getWidth()/2, this.getHeight());
        ImageProducer prod=new FilteredImageSource(img.getSource(),fil);
        return this.createImage(prod);
    }
//生成窗体对象并显示
 public static void main(String[] args){
      ProImage pimg=new ProImage();
     
      pimg.show();
    }

}

