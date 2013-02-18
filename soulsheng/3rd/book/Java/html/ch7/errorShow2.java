public class errorShow2{
	public static void main(String[]args){
		int j;
		j=Keyboard.readInt();
		if(j>0)
			System.out.println("j is greater than zero");
		else if(j<0)
				//程序的逻辑不正确
				System.out.println("j is equals to zero");
			else
				System.out.println("j is less than zero");
		int x=120/j;
		System.out.println(x);
	}
}
