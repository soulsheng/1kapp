import java.awt.*;
import javax.swing.*;
//import java.applet.*;
import java.awt.image.*;
import java.net.URL;
//ʹ��ImageObserver�ӿ�
public class ShowImageApplet extends JApplet{
  Image img;
  String imgPath =null;
  int xpoint = 100, ypoint = 100;
  public void init() {
     imgPath = "com.gif"; //����ͼ���ļ�·��
  }

  public void paint(Graphics g) {
    URL imgURL = getDocumentBase();
    img = getImage(imgURL, imgPath);
    g.drawImage(img, 0,0, this);
  }
}