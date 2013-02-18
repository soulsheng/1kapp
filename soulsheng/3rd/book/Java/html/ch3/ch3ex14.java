public class ch3ex14{
	public static void main(String[]args){
		int f1=1,f2=1;
		int f3;
		System.out.println(f1);
		System.out.println(f2);
		while ((f2+f1)<100){
			f3=f2+f1;
			System.out.println(f3);
			f1=f2;
			f2=f3;
		}
	}
}