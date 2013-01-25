class primitive{
	private long l;
	public primitive(long n){
		l=n;
	}
	public boolean equals(primitive p){
		if(l==p.l)
			return true;
		else
			return false;
	}
}
public class ch6ex15{
	public static void main(String[]args){
		primitive p1=new primitive(12345);
		primitive p2=new primitive(23456);
		if (p1.equals(p2))
			System.out.println("p1 is equals p2");
		else
			System.out.println("p1 is not equals p2");
	}
}