public class ch5ex16{
	static int fbnc(int n){
		if(n==0||n==1)
			return 1;
		else
			return(fbnc(n-1)+fbnc(n-2));
	}
	public static void main(String[]args){
		int n,t;
		System.out.print("Enter a number: ");
		n=Keyboard.readInt();
		System.out.println();
		System.out.println("Fibonacci sequence ");
		for(int j=0;j<=n;j++){
			t=fbnc(j);
			System.out.print(t+"  ");
		}
		System.out.println();
	}
}
