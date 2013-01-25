//ExamThread1.java
import java.util.*; 
public class ExamThread2 implements Runnable{
	String threadName; 
	public ExamThread2(String threadName){ 
		this.threadName=threadName;
		System.out.println(threadName+ "created!");
	} 
	public void run(){
		System.out.println(threadName+"started!");
		try { 
			Thread.sleep(1000); 
		}catch(Exception e){
			e.printStackTrace(); 
		} 
		System.out.println(threadName+" finished!");
	}
	public static void main(String args[]){ 
		ExamThread2 target1 = new ExamThread2 ("first thread "); 
		ExamThread2 target2= new ExamThread2 ("second thread "); 
		ExamThread2 target3= new ExamThread2 ("third thread "); 
		Thread first,second, third;
		first=new Thread(target1);
		second=new Thread(target2);
		third=new Thread(target3);
		first.start( );
		second.start( );
		third.start( );
	}
}