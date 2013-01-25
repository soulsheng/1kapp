public class ch3ex20{
	final static int Sentinel=-1;
	public static void main(String[]args){
		int num,max;
		System.out.print("List:");
		max=Keyboard.readInt();
		num=Keyboard.readInt();
		while(num!=Sentinel){
			if(num>max)
				max=num;
			num=Keyboard.readInt();
		}
		System.out.println("The largest number:"+max);
	}
}