public class ch5ex10{
	static void initArray(int a[]){
		for(int j=0;j<a.length;j++)
			a[j]=(int)(Math.random()*1000000)%100;
		System.out.print("array of initarray procedure: ");
		printArray(a);
	}
	static void printArray(int b[]){		
		for(int j=0;j<b.length;j++)
			System.out.print(b[j]+"  ");
		System.out.println();
	}
	public static void main(String[]args){
		int ar[]=new int[10];
		initArray(ar);
		System.out.print("array of main function: ");
		printArray(ar);
	}
}