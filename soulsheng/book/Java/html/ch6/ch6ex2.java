class queue{
	private int q[]=new int[100];
	private int sloc,rloc;
	public queue(){
		rloc=0;sloc=0;
	}
	public void qput(int i){
		if(sloc==100)
			System.out.println("queue is overflow");
		else{
			sloc++;q[sloc]=i;
		}
	}
	public int qget(){
		if(rloc==sloc){
			System.out.println("queue is underflow");
			return -9999;
		}
		else{
			rloc++;return(q[rloc]);
		}
	}
}
public class ch6ex2{
	public static void main(String[]args){
		queue a=new queue();
		queue b=new queue();
		a.qput(10);b.qput(20);
		a.qput(30);b.qput(40);
		System.out.println(a.qget());
		System.out.println(a.qget());
		System.out.println(b.qget());
		System.out.println(b.qget());
		System.out.println(a.qget());
	}
}
			