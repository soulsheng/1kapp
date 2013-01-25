class stack{
	private int st[],pt;
	public stack(int len)throws RuntimeException{
		st=new int[len];pt=0;
	}
	public void putStack(int x)throws ArrayIndexOutOfBoundsException{
		st[pt++]=x;
	}
	public int getStack()throws ArrayIndexOutOfBoundsException{
		return st[--pt];
	}
}
public class ch7ex6{
	static int menu(){
		System.out.println("1. put value to stack");
		System.out.println("2. get value from stack");
		int t;
		t=Keyboard.readInt();
		return t;
	}
	public static void main(String[]args){
		boolean con=true;;
		System.out.print("Enter size of stack: ");
		int size=Keyboard.readInt();
		try{
			stack s=new stack(size);
			while(con){
				int opt;
				opt=menu();
				switch (opt){
					case 1:
						System.out.print("Enter a value: ");
						int x=Keyboard.readInt();
						System.out.println();
						s.putStack(x);break;
					case 2:System.out.println(s.getStack());break;
					case 3:con=false;break;
					default:System.out.println("Invalid input");
				}
			}
		}catch(ArrayIndexOutOfBoundsException e1){
			System.out.println("Stack is overflow or underflow");
			e1.printStackTrace();
		}catch(RuntimeException e2){
			System.out.println("The size of stack is not negative");
			e2.printStackTrace();
		}
	}
}		