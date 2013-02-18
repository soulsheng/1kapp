public class ch4ex6{
	public static void main(String[]args){
		char ch1,ch2,ch3;
		System.out.print("Enter first character:");
		ch1=Keyboard.readChar();
		Keyboard.skipLine();
		System.out.println();
		System.out.print("Enter second character:");
		ch2=Keyboard.readChar();
		Keyboard.skipLine();
		System.out.println();
		System.out.print("Enter third character:");
		ch3=Keyboard.readChar();
		System.out.println();
		//sort value
		if(ch1>ch2)
			;
		else{
			char temp;
			temp=ch1;
			ch1=ch2;
			ch2=temp;
		}
		if(ch1>ch3)
			;
		else{
			char temp;
			temp=ch1;
			ch1=ch3;
			ch3=temp;
		}
		if(ch2>ch3)
			;
		else{
			char temp;
			temp=ch2;
			ch2=ch3;
			ch3=temp;
		}
		System.out.print("Sorted:");
		System.out.println(ch1);
		System.out.println(ch2);
		System.out.println(ch3);
	}
}
