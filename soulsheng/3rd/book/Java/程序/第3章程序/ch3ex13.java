public class ch3ex13{
	public static void main(String[]args){
		int n,fac,j;
		System.out.print("Enter a number");
		n=Keyboard.readInt();
		fac=1;
		j=0;
		while(j<n){
			j=j+1;
			fac=fac*j;
		}
		System.out.print(n);
		System.out.print("!=");
		System.out.println(fac);
	}
}