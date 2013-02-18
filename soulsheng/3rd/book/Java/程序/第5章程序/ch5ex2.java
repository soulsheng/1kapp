public class ch5ex2{
	static void sum(){
		int s=0;
		for(int j=1;j<=1000;j++)
			s=j+s;
		System.out.println(s);
	}
	public static void main(String[]args){
		sum();
	}
}