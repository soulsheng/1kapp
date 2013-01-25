class timer{
	private long seconds;
	public timer(int t){
		seconds=(long)t;
	}
	public timer(int min,int sec){
		seconds=(long)(min*60+sec);
	}
	public timer(int hour,int min,int sec){
		seconds=(long)(hour*3600+min*60+sec);
	}
	public void display(){
		System.out.println(seconds);
	}
}
public class ch6ex12{
	public static void main(String[]args){
		timer a=new timer(10);
		timer b=new timer(1,10);
		timer c=new timer(1,10,20);
		a.display();
		b.display();
		c.display();
	}
}	