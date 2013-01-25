class counter{
	private int x;
	public counter(){
		x=0;
	}
	public int incCounter(){
		x++;
		return x;
	}
	public int incCounter(int k){
		x=x+k;
		return x;
	}
}
public class ch6ex11{
	public static void main(String[]args){
		counter c1=new counter();
		System.out.println(c1.incCounter());
		System.out.println(c1.incCounter(12));
	}
}
