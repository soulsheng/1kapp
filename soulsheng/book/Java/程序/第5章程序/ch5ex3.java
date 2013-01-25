public class ch5ex3{
	static void sum(int n){
		int s=0;
		for(int j=1;j<=n;j++)
			s=j+s;
		System.out.println(s);
	}
	public static void main(String[]args){
		int num;
		System.out.print("Enter a number: ");
		num=Keyboard.readInt();
		sum(num);
	}
}