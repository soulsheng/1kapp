public class ch3ex4{
	public static void main(String[]args){
		int x,y;
		System.out.print("Enter first number:");
		x=Keyboard.readInt();
		System.out.println();
		System.out.print("Enter second number:");
		y=Keyboard.readInt();
		System.out.println();
		//sort value
		if(x<=y)
			;
		else{
			int temp;
			temp=x;
			x=y;
			y=temp;
		}
		System.out.print("Sorted:");
		System.out.println(x);
		System.out.println(y);
	}
}