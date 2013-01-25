public class ch5ex17{
	static void moves(char a,char c){
		System.out.println("From "+a+" to "+c);
	}
	static void hanoi(int n,char a,char b,char c){
		if(n==1)
			moves(a,c);
		else{
			//将A柱上的上面n-1个圆盘借助C柱移动到B柱
			hanoi(n-1,a,c,b);
			//将A柱上剩下的一个圆盘移动到C柱
			moves(a,c);
			//将B柱上n-1个圆盘借助A柱由B柱移动到C柱
			hanoi(n-1,b,a,c);
		}
	}
	public static void main(String[]args){
		int n;
		System.out.print("Enter a number: ");
		n=Keyboard.readInt();
		hanoi(n,'A','B','C');
	}
}