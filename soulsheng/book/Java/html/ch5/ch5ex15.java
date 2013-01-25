public class ch5ex15{
	static long fac(int n){
		if(n==0) 
			return 1; 
		else
			return(n*fac(n-1));
	}
	public static void main(String[]args){
		long k;
		int n;
		System.out.print("Enter value for n: ");
		n=Keyboard.readInt();
		k=fac(n);
		System.out.print(n+"!= ");
		System.out.println(k);
	}
}
