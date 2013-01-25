public class ch7ex22{
	public static void main(String[]args){
		first();	
	}
	static void first(){
		second();
	}
	static void second(){
		third();
	}
	static void third(){
		int x=12;int y=0;
		try{
			x=x/y;
			System.out.println("you won't see this!");
		}catch(Exception e){
			e.printStackTrace();
		}
	}	
}
