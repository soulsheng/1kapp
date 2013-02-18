public class ch3ex7{
	public static void main(String[]args){
		boolean leap;
		int year;
		System.out.print("Enter year number:");
		year=Keyboard.readInt();
		leap=year%4==0 && (year%100!=0 || year%400==0);
		System.out.println();
		System.out.print(year);
		System.out.print("is a leap year=");
		System.out.println(leap);
	}
}