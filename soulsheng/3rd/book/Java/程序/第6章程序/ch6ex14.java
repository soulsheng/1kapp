class ob1{
	private int x;
	public ob1(int n){
		x=n;
	}
	public void display(){
		System.out.println(x);
	}
}
public class ch6ex13{
	public static void main(String[]args){
		int a[]=new int[4];
		int b[]=new int[4];
		ob1 o1=new ob1(1);
		ob1 o2=new ob1(10);
		int x1=1,x2=2;
		x1=x2;
		System.out.println("After assignment: x1= "+x1+"  x2= "+x2);
		for(int j=0;j<a.length;j++)
			a[j]=j+1;
		for(int j=0;j<b.length;j++)
			b[j]=100*(j+1);
		for(int j=0;j<a.length;j++)
			System.out.print(a[j]+" ");
		System.out.println();
		for(int j=0;j<b.length;j++)
			System.out.print(b[j]+" ");
		b=a;
		System.out.println();
		System.out.println("After array name assignment:a[]-b[]");
		for(int j=0;j<a.length;j++)
			System.out.print(a[j]+"-"+b[j]+" ");
		System.out.println();
		System.out.print("o1.x= ");
		o1.display();
		System.out.print("o2.x= ");
		o2.display();
		o1=o2;
		System.out.println("After object name assignment:");
		System.out.print("o1.x= ");
		o1.display();
		System.out.print("o2.x= ");
		o2.display();
	}
}