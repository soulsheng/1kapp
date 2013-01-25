//ExamThread1.java
import java.util.*; 
public class ExamThread1 extends Thread{
	String threadName; 
	public ExamThread1(String threadName){ 
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
		ExamThread1 thread1 = new ExamThread1 ("first thread "); 
		thread1.start( );
		ExamThread1 thread2= new ExamThread1 ("second thread "); 
		thread2.start( );
		ExamThread1 thread3= new ExamThread1 ("third thread "); 
		thread3.start( );
	} 
} 
