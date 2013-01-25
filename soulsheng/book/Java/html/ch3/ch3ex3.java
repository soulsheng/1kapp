public class ch3ex3{
	public static void main(String[]args){
		int x;
		System.out.print("Enter a number:");
		x=Keyboard.readInt();
		if(x>=60)
			System.out.println("you pass this exam");
		else
			System.out.println("you fail this exam");
	}
}