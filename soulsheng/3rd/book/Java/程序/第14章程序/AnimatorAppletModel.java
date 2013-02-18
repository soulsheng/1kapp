//AnimatorAppletModel.java
import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import java.lang.*;
import javax.swing.*;
public class AnimatorAppletModel extends JApplet implements Runnable {
//��������
Graphics offGraphics;//��ǰͼ������
Dimension offDimension;//��ǰͼ�γߴ�
Image offImage;//��ǰͼ��
int frmNum=-1;//��¼����֡������
int delay;//�ӳ�ʱ��
 	int imgc=10;//��֡����
 	Thread aniThread;//�����߳�
  	Image allImg[];//����֡
MediaTracker tracker;//ý�����
 public void init(){
    String str;
   	int fps=10;
setSize(250,150);
//�û�������֡����ʾƵ��
   str=getParameter("fps");
   try{
     if(str!=null){
       fps=Integer.parseInt(str);
     }
     }catch(Exception e){
   }
   delay=(fps>0)?(1000/fps):100;
//��������֡����������֡�����ü��������
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
     aniThread.start();//�ж϶����߳��Ƿ�Ϊ�գ����Ϊ�����½�һ����������
  
   }
//ֹͣ�߳�
 public void stop(){
  offImage=null;
  offGraphics=null;
   aniThread=null;
 }
//ִ���߳�
public void run(){
//�����߳����ȼ�������֡��ʾ���ʱ��
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
//����֡
 public void paint(Graphics g){
  if(offImage!=null){
   g.drawImage(offImage,0,0,this);
 }
}
//��д����update������ʹ֮���ؽ��б������
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
