public class ch7ex31{
	public static void main(String[]args){
		int x=12;int y=0;
		try{
			x=x/y;
			System.out.println("you won't see this!");
		}catch(ArithmeticException e){
			System.out.println(e.getMessage());
		}	
	}
}