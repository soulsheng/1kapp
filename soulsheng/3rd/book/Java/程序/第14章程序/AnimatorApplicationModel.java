//AnimatorAppletModel.java
import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import java.lang.*;
import javax.swing.*;
public class AnimatorApplicationModel extends Frame implements Runnable {
//声明变量
Graphics offGraphics;//当前图形引用
Dimension offDimension;//当前图形尺寸
Image offImage;//当前图象

int frmNum=-1;//记录载入帧的数量
 	int delay;//延迟时间
 	int imgc=10;//帧的总数量
 	Thread aniThread;//动画线程

 Image allImg[];//载入所有帧
 MediaTracker tracker;//图象跟踪
 public AnimatorApplicationModel(int fps,String title){
//设置标题和大小
 	super(title);
 	setSize(300,200);
//设置延迟时间及载入帧
   delay=(fps>0)?(1000/fps):100;
   allImg=new Image[imgc];
   tracker=new MediaTracker(this);
   for(int i=1;i<=imgc;i++){
   	allImg[i-1]=getToolkit().getImage("cat"+i+".jpg");
   	tracker.addImage(allImg[i-1],0);
}
//使关闭窗口功能可能
	addWindowListener(new WindowAdapter() {
      public void windowClosing(WindowEvent evt) {
        System.exit(0);
      }
    });
}
//开始动画线程
 public void startAnimator(){
   if (aniThread == null) {
       aniThread = new Thread(this);
     }
     aniThread.start();
   
   }
//结束动画线程
 public void stopAnimatior(){
  offImage=null;
  offGraphics=null;
   aniThread=null;
 }
//执行动画线程
 public void run(){
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
//绘制动画
 public void paint(Graphics g){
  if(offImage!=null){
   g.drawImage(offImage,0,0,this);
 }
}
//重载update防止帧闪烁
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
                 offGraphics.drawImage(allImg[frmNum%imgc], 0, 0, null); 
                } 
                 g.drawImage(offImage,0,0,this);
                }

public static void main(String[]args){
AnimatorApplicationModel ani=null;
int fps=0;
if(args.length>0){
	try{
	fps=Integer.parseInt(args[0]);}catch(Exception e){}
}
ani=new AnimatorApplicationModel(fps,"Animator");
ani.show();
ani.startAnimator();
}
}
