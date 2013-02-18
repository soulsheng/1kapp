public class ch2ex16{
	public static void main(String[]args){
		double c;
		c=Math.random();
		System.out.print("Random value=");
		System.out.println(c);
		int x;
		//Convert to integer value
		x=(int)(c*1000000)%50;
		System.out.print("Random value in the range 0...49=");
		System.out.println(x);
	}
}