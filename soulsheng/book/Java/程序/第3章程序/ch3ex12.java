public class ch3ex12{
	public static void main(String[]args){
		int n;
		boolean prime=true;
		System.out.print("Enter a positive integer value");
		n=Keyboard.readInt();
		for(int j=2;j<n&&prime;j++)
			if(n%j==0)
				prime=false;
		System.out.print(n);
		if(prime)
			System.out.println("is prime");
		else
			System.out.println("is not prime");
	}
}