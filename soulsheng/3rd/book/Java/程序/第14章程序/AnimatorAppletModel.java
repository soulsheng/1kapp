//AnimatorAppletModel.java
import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import java.lang.*;
import javax.swing.*;
public class AnimatorAppletModel extends JApplet implements Runnable {
//声明变量
Graphics offGraphics;//当前图形引用
Dimension offDimension;//当前图形尺寸
Image offImage;//当前图象
int frmNum=-1;//记录载入帧的数量
int delay;//延迟时间
 	int imgc=10;//总帧数量
 	Thread aniThread;//动画线程
  	Image allImg[];//所有帧
MediaTracker tracker;//媒体跟踪
 public void init(){
    String str;
   	int fps=10;
setSize(250,150);
//用户可设置帧的显示频率
   str=getParameter("fps");
   try{
     if(str!=null){
       fps=Integer.parseInt(str);
     }
     }catch(Exception e){
   }
   delay=(fps>0)?(1000/fps):100;
//载入所有帧，并将所有帧的引用加入跟踪器
   allImg=new Image[imgc];
   tracker=new MediaTracker(this);
   for(int i=1;i<=imgc;i++){
   	allImg[i-1]=getImage(getCodeBase(),"cat"+i+".jpg");
   	tracker.addImage(allImg[i-1],0);
}}

 public void start(){
  
     if (aniThread == null) {
       aniThread = new Thread(this);
     }
     aniThread.start();//判断动画线程是否为空，如果为空则新建一个，并启动
  
   }
//停止线程
 public void stop(){
  offImage=null;
  offGraphics=null;
   aniThread=null;
 }
//执行线程
public void run(){
//设置线程优先级并设置帧显示间隔时间
   Thread.currentThread().setPriority(Thread.MIN_PRIORITY);
   long sTime=System.currentTimeMillis();
   while(Thread.currentThread()==aniThread){
     frmNum++;
     repaint();
    try{
      sTime+=delay;
      Thread.sleep(Math.max(0,sTime-System.currentTimeMillis()));
      }catch(InterruptedException e){break;}
   }
 }
//绘制帧
 public void paint(Graphics g){
  if(offImage!=null){
   g.drawImage(offImage,0,0,this);
 }
}
//重写方法update（），使之不必进行背景清除
public void update(Graphics g) { 
    Dimension d = getSize(); 
	if ((offGraphics == null) 
 		|| (d.width != offDimension.width) 
 		|| (d.height != offDimension.height)) { 
		 offDimension = d; 
 		 offImage = createImage(d.width, d.height); 
                 offGraphics = offImage.getGraphics(); 
 		 } 
                offGraphics.setColor(getBackground()); 
                 offGraphics.fillRect(0, 0, d.width, d.height); 
                 offGraphics.setColor(Color.BLACK); 
                 if(tracker.statusID(0,true)==MediaTracker.COMPLETE){
                 offGraphics.drawImage(allImg[frmNum%imgc], 0, 0, null); } 
                 g.drawImage(offImage,0,0,this);
                }
}
