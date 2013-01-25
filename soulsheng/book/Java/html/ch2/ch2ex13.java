public class ch2ex13{
	static final double pi=3.141592;
	public static void main(String[]args){
		double height,radius,volume;
		System.out.println("Calculate Volume of Cylinder");
		System.out.print("Enter height");
		height=Keyboard.readDouble();
		System.out.println();
		System.out.print("Enter radius");
		radius=Keyboard.readDouble();
		System.out.println();
		//Calculate volume
		volume=pi*radius*height;
		System.out.print("volume=");
		System.out.println(volume);
	}
}