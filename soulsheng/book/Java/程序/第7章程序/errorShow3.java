public class errorShow3{
	public static void main(String[]args){
		int j;
		j=Keyboard.readInt();
		if(j>0)
			System.out.println("j is greater than zero");
		else if(j<0)
				System.out.println("j is less than zero");
			else
				System.out.println("j is equals to zero");
		//可能出现异常情况
		int x=120/j;
		System.out.println(x);
	}
}
		
	