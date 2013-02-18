//ShowImage.java
import java.awt.*;
import javax.swing.*;

import java.awt.image.*;
import java.awt.event.*;

class ShowImage extends JFrame implements MouseListener{
//生成两个按钮,一个执行图象的载入功能,另一个执行图象的显示功能
  private JButton loadimg = new JButton("Load Image");
  private JButton showimg = new JButton("Show Image");

//生成一个Panel用来包容上述按钮
  private JPanel p=new JPanel();
//声明一个image引用
  private Image img = null;
 


  public ShowImage() {
 //设定窗口标题和大小
    setTitle("图片显示演示");
    setBounds(0,0,250,250);
 //设定窗口布局并添加组件
    getContentPane().setLayout(new BorderLayout());
    getContentPane().add(BorderLayout.NORTH,p);
    
    p.setLayout(new FlowLayout(FlowLayout.LEFT,1,2));
    p.add(loadimg);
    p.add(showimg);
 //设定组件鼠标事件监听   
    loadimg.addMouseListener(this);
    showimg.addMouseListener(this);
    
    p.addMouseListener(this);
    addMouseListener(this);
 //设定窗口监听,使窗口可执行退出功能     
    addWindowListener(new WindowAdapter() {
      public void windowClosing(WindowEvent evt) {
        System.exit(0);
      }
    });
  
  }
  
 //设定组件鼠标单击事件监听   
 public void mousePressed(MouseEvent evt) {{
 //loadimg按钮装载图片
 if (evt.getSource()== loadimg) {
       img = getToolkit().getImage("friendly.jpg");
          
  }
 //showimg按钮显示图片
 if (evt.getSource() == showimg) {
	  getGraphics().drawImage(img, 70, 70,this);
      
}
   
  }}
  
  public void mouseReleased(MouseEvent e){}
  public void mouseEntered(MouseEvent e){}
  public void mouseClicked(MouseEvent e){}
  public void mouseExited(MouseEvent e){}
  
  public static void main(String[] args){
 //生成图象显示窗口并显示
    ShowImage simg=new ShowImage();
    simg.show();
  }

}
