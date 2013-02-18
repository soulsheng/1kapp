public class ch5ex17{
	static void moves(char a,char c){
		System.out.println("From "+a+" to "+c);
	}
	static void hanoi(int n,char a,char b,char c){
		if(n==1)
			moves(a,c);
		else{
			//��A���ϵ�����n-1��Բ�̽���C���ƶ���B��
			hanoi(n-1,a,c,b);
			//��A����ʣ�µ�һ��Բ���ƶ���C��
			moves(a,c);
			//��B����n-1��Բ�̽���A����B���ƶ���C��
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