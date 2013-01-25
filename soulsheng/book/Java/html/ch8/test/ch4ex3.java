public class ch4ex3{
	public static void main(String[]args){
		int a[]={2,3,8,4,5,6,9,7,11,32,23,56,45,47,78,1};
		int t;
		for(int i=0;i<a.length;i++)
			for(int j=0;j<a.length-i-1;j++)
				if(a[j]>a[j+1]){
					t=a[j];a[j]=a[j+1];a[j+1]=t;
				}
		for(int k=0;k<a.length;k++)
			System.out.print(a[k]+"  ");
		System.out.println();
	}
}