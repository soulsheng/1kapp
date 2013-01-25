public class ch7ex23{
		public static void main(String[]args){
		int x=12;int y=0;
		try{
			x=x/y;
			System.out.println("you won't see this!");
		}catch(Exception e){
			e.printStackTrace();
		}	
		System.out.println("program continuing to run");
	}
}
