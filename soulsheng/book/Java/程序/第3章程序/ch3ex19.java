public class ch3ex19{
	public static void main(String[]args){
		int sum=0,num;
		double average;
		for(int j=0;j<20;j++){
			System.out.print("Enter a number:");
			num=Keyboard.readInt();
			sum=sum+num;
		}
		System.out.println("The sum:"+sum);
		average=sum/20;
		System.out.println("The average:"+average);
	}
}