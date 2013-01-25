public class ch3ex16{
	final static int N=20;
	public static void main(String[]args){
		int num,j=1;
		System.out.println("Enter list of 20 numbers:");
		do{
			num=Keyboard.readInt();
			if(num%2==0)
				System.out.println(num);
			j++;
		}while(j<=N);
		System.out.println();
	}
}