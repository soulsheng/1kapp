class queue{
	private int q[]=new int[100];
	private int sloc,rloc;
	public queue(){
		this.rloc=0;this.sloc=0;
	}
	public void qput(int i){
		if(this.sloc==100)
			System.out.println("queue is overflow");
		else{
			this.sloc++;this.q[sloc]=i;
		}
	}
	public int qget(){
		if(this.rloc==this.sloc){
			System.out.println("queue is underflow");
			return -9999;
		}
		else{
			this.rloc++;return(this.q[rloc]);
		}
	}
}
public class ch6ex18{
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
