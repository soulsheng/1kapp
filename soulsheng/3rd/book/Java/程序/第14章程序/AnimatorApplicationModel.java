//AnimatorAppletModel.java
import java.awt.*;
import java.awt.event.*;
import java.applet.*;
import java.lang.*;
import javax.swing.*;
public class AnimatorApplicationModel extends Frame implements Runnable {
//��������
Graphics offGraphics;//��ǰͼ������
Dimension offDimension;//��ǰͼ�γߴ�
Image offImage;//��ǰͼ��

int frmNum=-1;//��¼����֡������
 	int delay;//�ӳ�ʱ��
 	int imgc=10;//֡��������
 	Thread aniThread;//�����߳�

 Image allImg[];//��������֡
 MediaTracker tracker;//ͼ�����
 public AnimatorApplicationModel(int fps,String title){
//���ñ���ʹ�С
 	super(title);
 	setSize(300,200);
//�����ӳ�ʱ�估����֡
   delay=(fps>0)?(1000/fps):100;
   allImg=new Image[imgc];
   tracker=new MediaTracker(this);
   for(int i=1;i<=imgc;i++){
   	allImg[i-1]=getToolkit().getImage("cat"+i+".jpg");
   	tracker.addImage(allImg[i-1],0);
}
//ʹ�رմ��ڹ��ܿ���
	addWindowListener(new WindowAdapter() {
      public void windowClosing(WindowEvent evt) {
        System.exit(0);
      }
    });
}
//��ʼ�����߳�
 public void startAnimator(){
   if (aniThread == null) {
       aniThread = new Thread(this);
     }
     aniThread.start();
   
   }
//���������߳�
 public void stopAnimatior(){
  offImage=null;
  offGraphics=null;
   aniThread=null;
 }
//ִ�ж����߳�
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
//���ƶ���
 public void paint(Graphics g){
  if(offImage!=null){
   g.drawImage(offImage,0,0,this);
 }
}
//����update��ֹ֡��˸
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
