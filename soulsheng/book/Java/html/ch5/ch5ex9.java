public class ch5ex9{
	static void initArray(int a[]){
		for(int j=0;j<a.length;j++)
			a[j]=(int)(Math.random()*1000000)%100;
		System.out.print("array of initarray procedure: ");
		for(int j=0;j<a.length;j++)
			System.out.print(a[j]+"  ");
		System.out.println();
	}
	public static void main(String[]args){
		int ar[]=new int[10];
		initArray(ar);
		System.out.print("array of main function: ");
		for(int j=0;j<ar.length;j++)
			System.out.print(ar[j]+"  ");
		System.out.println();
	}
}