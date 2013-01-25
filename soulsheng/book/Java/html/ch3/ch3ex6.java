public class ch3ex6{
	public static void main(String[]args){
		int a,b,c;
		System.out.print("Enter first co-efficient:");
		a=Keyboard.readInt();
		System.out.println();
		System.out.print("Enter second co-efficient:");
		b=Keyboard.readInt();
		System.out.println();
		System.out.print("Enter third co-efficient:");
		c=Keyboard.readInt();
		System.out.println();
		if(a==0)
			System.out.println("Not quadratic equation");
		else{
			if(b*b-4*a*c==0)
				System.out.println("Roots equal");
			else if(b*b-4*a*c>0)
				System.out.println("Roots real");
			else
				System.out.println("Roots imaginary");
		}
	}
}