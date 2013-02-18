import java.awt.*;
import javax.swing.*;
//import java.applet.*;
import java.awt.image.*;
import java.net.URL;
//使用ImageObserver接口
public class ShowImageApplet extends JApplet{
  Image img;
  String imgPath =null;
  int xpoint = 100, ypoint = 100;
  public void init() {
     imgPath = "com.gif"; //设置图象文件路径
  }

  public void paint(Graphics g) {
    URL imgURL = getDocumentBase();
    img = getImage(imgURL, imgPath);
    g.drawImage(img, 0,0, this);
  }
}