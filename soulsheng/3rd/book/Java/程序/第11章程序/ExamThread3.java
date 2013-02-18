//ExamThread3.java
public class ExamThread3 {
	public static void main(String[] args){
		Thread cat=new Animal("cat");
		cat.setPriority(Thread.MIN_PRIORITY);
		cat.start();
		Thread dog=new Animal("dog");
		dog.setPriority(Thread.MAX_PRIORITY);
		dog.start();
		Thread mouse=new Animal("mouse");
		mouse.setPriority(Thread.NORM_PRIORITY );
		mouse.start();
	}
}
class Animal extends Thread{
	String name;
	Animal(String name){
		this.name=name;
	}
	public void run(){
		for(int i=0;i<3;i++)
			System.out.println(name+" "+getPriority());
	}
}
	