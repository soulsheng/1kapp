public class ch5ex5{
	public static void main(String[]args){
		double x,y;
		System.out.print("Enter a number: ");
		x=Keyboard.readDouble();
		y=square(x);
		System.out.println("cube of "+x+" is "+y);
	}
	static double square(double d){
		double s;
		s=d*d*d;
		return(s);
	}
}