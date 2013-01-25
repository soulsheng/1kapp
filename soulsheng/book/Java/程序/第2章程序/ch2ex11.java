public class ch2ex11{
	public static void main(String[]args){
		int x=10;
		{
			int y=7;
			System.out.println(y);
		}
		{
			int y=9;
			System.out.println(y);
			System.out.println(x);
		}
	}
}
		