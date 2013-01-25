public class ch2ex8{
	//declare old salary and pecentage increase as contants
	static final double oldSalary=4000.0;
	//oldSalary is double, salary contant must write 4000.0
	static final double perIncrease=0.25;
	public static void main(String[]args){
		double newSalary;
		//calculate new salary
		newSalary=oldSalary+oldSalary*perIncrease;
		System.out.print("Old salary=");
		System.out.println(oldSalary);
		System.out.print("New salary=");
		System.out.println(newSalary);
	}
}