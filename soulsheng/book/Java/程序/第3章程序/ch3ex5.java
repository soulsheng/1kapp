public class ch3ex5{
	public static void main(String[]args){
		int x,y,z;
		System.out.print("Enter first number:");
		x=Keyboard.readInt();
		System.out.println();
		System.out.print("Enter second number:");
		y=Keyboard.readInt();
		System.out.println();
		System.out.print("Enter third number:");
		z=Keyboard.readInt();
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
		if(x<=z)
			;
		else{
			int temp;
			temp=x;
			x=z;
			z=temp;
		}
		//x<=y and x<=z
		if(y<=z)
			;
		else{
			int temp;
			temp=y;
			y=z;
			z=temp;
		}
		//x<=y<=z
		System.out.print("Sorted:");
		System.out.println(x);
		System.out.println(y);
		System.out.println(z);
	}
}