public class ch4ex1{
	public static void main(String[]args){
		int a[]=new int[20];
		for(int j=0;j<a.length;j++)
			a[j]=Keyboard.readInt();
		for(int j=a.length-1;j>=0;j--)
			System.out.println(a[j]);
	}
}