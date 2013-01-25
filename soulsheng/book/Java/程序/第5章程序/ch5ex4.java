public class ch5ex4{
	static void swap(int x,int y){
		System.out.print("Before swap: ");
		System.out.println("x= "+x+"   y= "+y);
		int temp=x;x=y;y=temp;
		System.out.print("After swap: ");
		System.out.println("x= "+x+"   y= "+y);
	}
	public static void main(String[]args){
		int num1,num2;
		System.out.print("Enter a num1: ");
		num1=Keyboard.readInt();
		System.out.print("Enter a num2: ");
		num2=Keyboard.readInt();
		System.out.print("Before calling: ");
		System.out.println("num1= "+num1+"   num2= "+num2);
		swap(num1,num2);
		System.out.print("After calling: ");
		System.out.println("num1= "+num1+"   num2= "+num2);
	}
}