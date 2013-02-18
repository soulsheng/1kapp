public class ch5ex8{
	static void printArray(int a[]){
		for(int j=0;j<a.length;j++)
			System.out.print(a[j]+"  ");
	}
	public static void main(String[]args){
		int ar[]={2,3,4,5,67,89,2,34,56,78,90,12};
		printArray(ar);
		System.out.println();
	}
}
